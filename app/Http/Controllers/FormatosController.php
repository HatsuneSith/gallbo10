<?php namespace App\Http\Controllers;
use View;
use Auth;
use DB;
use DateTime;
use Request;
use Response;
use ZipArchive;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use App\Models\Siniestro;

class FormatosController extends Controller {


    public function FechaFormateada2($FechaStamp)
    { 
        $ano = date('Y',$FechaStamp);
        $mes = date('n',$FechaStamp);
        $dia = date('d',$FechaStamp);
        $diasemana = date('w',$FechaStamp);

        $diassemanaN= array("Domingo","Lunes","Martes","Miércoles","Jueves","Viernes","Sábado"); 
        $mesesN=array(1=>"Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
        return $diassemanaN[$diasemana].", ".$dia." de ". $mesesN[$mes] ." de ".$ano;
    }

    public function FechaFormateada3($FechaStamp)
    { 
        $ano = date('Y',$FechaStamp);
        $mes = date('n',$FechaStamp);
        $dia = date('d',$FechaStamp);
        $diasemana = date('w',$FechaStamp);

        $diassemanaN= array("Domingo","Lunes","Martes","Miércoles",
        "Jueves","Viernes","Sábado"); $mesesN=array(1=>"Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio",
        "Agosto","Septiembre","Octubre","Noviembre","Diciembre");
        return "$dia de ". $mesesN[$mes] ." del $ano";
    }

    public function contrato($id){
        if(Request::ajax()){
            $siniestro = Siniestro::find($id);
            //$contrato = $siniestro->contrato;
            // if (isset($contrato)) {
            //     return Response::json(array('success' =>true));
            // }
            // $coberturas = false;
            // if (isset($siniestro->id_poliza)) {
            //     if (count($siniestro->poliza->coberturas) != 0) {
            //         $coberturas = true;
            //     }
            // }

            $variables = array('Fecha Siniestro'        => isset($siniestro->fecha),
                                'Tipo Siniestro'        => isset($siniestro->tipo_siniestro),
                                'Domicilio Siniestro'   => isset($siniestro->domicilio),
                                'Estado Siniestro'      => isset($siniestro->estado),
                                'Ciudad Siniestro'      => isset($siniestro->ciudad),
                                'Asegurado'             => isset($siniestro->asegurado->nombre),
                                'Domicilio Asegurado'   => isset($siniestro->asegurado->domicilio),
                                'Estado Asegurado'      => isset($siniestro->asegurado->estado),
                                'Ciudad Asegurado'      => isset($siniestro->asegurado->ciudad),
                                'Caracter Asegurado'    => (count($siniestro->asegurado->caracteres) == 0) ? false : true,
                                'Aseguradora'           => isset($siniestro->aseguradora->nombre),
                                'Numero Poliza'         => isset($siniestro->poliza->num_poliza),
                                'Coberturas Afectadas'  => (isset($siniestro->id_poliza)) ? ((count($siniestro->poliza->coberturas) != 0) ? true : false) : false,
                                'Tipo de Persona'       => isset($siniestro->asegurado->tipo_persona)
                            );
            if ($siniestro->asegurado->tipo_persona != 2) {
                $variables = array_add($variables, 'Apoderado Legal', isset($siniestro->asegurado->id_apoderado_legal));
            }
            if (count($variables) > count(array_filter($variables))) {
                $variables = array_diff($variables, array_filter($variables));
                $variables = array_keys($variables);
                return Response::json(array('success' => false, 'variables' => $variables));
            }
            else{
                return Response::json(array('success' => true, 'variables' => $variables));
            }
        }
    }

    public function imprimirContrato(){
        $siniestro = Siniestro::find(Input::get('id_siniestro'));
        $fecha_siniestro = new DateTime($siniestro->fecha);
        $fecha_siniestro = $fecha_siniestro->getTimestamp();
        $fecha_siniestro = $this->FechaFormateada3($fecha_siniestro);
        $estado_propuesta = DB::table('estados')->where('id', Input::get('estado_propuesta'))->pluck('nombre');
        $ciudad_propuesta = Input::get('ciudad_propuesta').", ".$estado_propuesta;
        $array_coberturas = array_pluck($siniestro->poliza->coberturas, 'cobertura');
        $coberturas = implode(", ", $array_coberturas);
        $array_caracter= array_pluck($siniestro->asegurado->caracteres, 'caracter');
        $caracter_asegurado = implode(", ", $array_caracter);
        $dia_contrato = date("d");
        $año_contrato = date("Y");
        $mes = date('n');
        $mesesN=array(1=>"Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
        $mes_contrato = $mesesN[$mes];

        require_once 'src/PhpWord/Autoloader.php';
        \PhpOffice\PhpWord\Autoloader::register();

        if ($siniestro->asegurado->tipo_persona == 1) {
            $templateWord = new \PhpOffice\PhpWord\TemplateProcessor('formatos/contratos/pm.docx');
        }
        elseif ($siniestro->asegurado->tipo_persona == 2) {
            $templateWord = new \PhpOffice\PhpWord\TemplateProcessor('formatos/contratos/pfd.docx');
        }
        elseif ($siniestro->asegurado->tipo_persona == 3) {
            $templateWord = new \PhpOffice\PhpWord\TemplateProcessor('formatos/contratos/pfrl.docx');
        }

        $templateWord->setValue('nombre_asegurado',$siniestro->asegurado->nombre);
        $templateWord->setValue('caracter_asegurado',$caracter_asegurado);
        $templateWord->setValue('num_poliza',$siniestro->poliza->num_poliza);
        $templateWord->setValue('aseguradora',$siniestro->aseguradora->nombre);
        $templateWord->setValue('coberturas',$coberturas);
        $templateWord->setValue('domicilio_siniestro',$siniestro->domicilio);
        $templateWord->setValue('fecha_siniestro',$fecha_siniestro);
        $templateWord->setValue('tipo_siniestro',$siniestro->tipo_siniestro()->first()->tipo);
        $templateWord->setValue('ciudad_siniestro',$siniestro->ciudad);
        $templateWord->setValue('domicilio_asegurado',$siniestro->asegurado->domicilio);
        $templateWord->setValue('porcentaje_honorarios',Input::get('honorarios_porcentaje'));
        $templateWord->setValue('porcentaje_honorarios_letra',Input::get('honorarios_porcentaje_letra'));
        $templateWord->setValue('cantidad_anticipo',Input::get('anticipo_cantidad'));
        $templateWord->setValue('cantidad_anticipo_letra',Input::get('anticipo_cantidad_letra'));
        $templateWord->setValue('num_personas_atencion',Input::get('num_personas_atencion'));
        $templateWord->setValue('ciudad_contrato',$ciudad_propuesta);
        $templateWord->setValue('dia_contrato',$dia_contrato);
        $templateWord->setValue('mes_contrato',$mes_contrato);
        $templateWord->setValue('año_contrato',$año_contrato);
        if ($siniestro->asegurado->tipo_persona != 2) {
            $templateWord->setValue('apoderado_legal',$siniestro->asegurado->apoderado_legal()->first()->nombre);
        }
        $nombre_archivo = 'Contrato - '.$siniestro->asegurado->nombre.'.docx';
        $nombre_archivo = str_replace(",", "", $nombre_archivo);
        $nombre_archivo = str_replace(" ", "_", $nombre_archivo);
        $templateWord->saveAs($nombre_archivo);
        header("Content-Disposition: attachment; filename=".$nombre_archivo."; charset=iso-8859-1");
        echo file_get_contents($nombre_archivo);
        unlink($nombre_archivo);

    }

    //Remocion Escombros
    public function remocionEscombros ($id){
        if(Request::ajax()){
            $siniestro = Siniestro::find($id);
            $variables = array('Asegurado'              => isset($siniestro->asegurado->nombre),
                                'Fecha del Siniestro'   => isset($siniestro->fecha),
                                'Ramo Poliza'           => isset($siniestro->poliza->ramo_poliza),
                                'Numero de Poliza'      => isset($siniestro->poliza->num_poliza),
                                'Numero de Siniestro'   => isset($siniestro->num_siniestro),
                                'Ajustadores'           => isset($siniestro->ajustadora->nombre),
                                'Aseguradora'           => isset($siniestro->aseguradora->nombre),
                                'Ajustador Designado'   => isset($siniestro->id_ajustador_designado),
                                'Caracter Asegurado'    => (count($siniestro->asegurado->caracteres) == 0) ? false : true,
                                'Ciudad del Siniestro'  => isset($siniestro->ciudad),
                                'Estado del Siniestro'  => isset($siniestro->estado),
                                'Tipo de Persona'       => isset($siniestro->asegurado->tipo_persona)
                                );
            if ($siniestro->asegurado->tipo_persona != 2) {
                $variables = array_add($variables, 'Apoderado Legal', isset($siniestro->asegurado->id_apoderado_legal));
            }
            if (count($variables) > count(array_filter($variables))) {
                $variables = array_diff($variables, array_filter($variables));
                $variables = array_keys($variables);
                return Response::json(array('success' => false, 'variables' => $variables));
            }
            else{
                return Response::json(array('success' => true, 'variables' => $variables));
            }
        }
    }


    public function descargarRemocionEscombros ($id){
        $siniestro = Siniestro::find($id);
        try {
            require_once 'src/PhpWord/Autoloader.php';
            \PhpOffice\PhpWord\Autoloader::register();

            if ($siniestro->asegurado->tipo_persona == 1) {
                $templateWord = new \PhpOffice\PhpWord\TemplateProcessor('formatos/solicitud_remover_escombros_aseguradora/pm.docx');
            }
            elseif ($siniestro->asegurado->tipo_persona == 2) {
                $templateWord = new \PhpOffice\PhpWord\TemplateProcessor('formatos/solicitud_remover_escombros_aseguradora/pfd.docx');
            }
            elseif ($siniestro->asegurado->tipo_persona == 3) {
                $templateWord = new \PhpOffice\PhpWord\TemplateProcessor('formatos/solicitud_remover_escombros_aseguradora/pfrl.docx');
            }

            $array_caracter= array_pluck($siniestro->asegurado->caracteres, 'caracter');
            $caracter_asegurado = implode(", ", $array_caracter);

            $templateWord->setValue('ciudad_siniestro',$siniestro->ciudad);
            $templateWord->setValue('estado_siniestro',DB::table('estados')->where('id', $siniestro->estado)->pluck('nombre'));
            $templateWord->setValue('fecha',$this->FechaFormateada3(time(new DateTime())));
            $templateWord->setValue('fecha_siniestro',$this->FechaFormateada3((new DateTime($siniestro->fecha))->getTimestamp()));
            $templateWord->setValue('nombre_asegurado',$siniestro->asegurado->nombre);
            $templateWord->setValue('ramo_poliza',$siniestro->poliza->ramo_poliza()->first()->ramo);
            $templateWord->setValue('num_poliza',$siniestro->poliza->num_poliza);
            $templateWord->setValue('num_siniestro',$siniestro->num_siniestro);
            $templateWord->setValue('ajustadores',$siniestro->ajustadora->nombre);
            $templateWord->setValue('aseguradora',$siniestro->aseguradora->nombre);
            $templateWord->setValue('ajustador_designado',$siniestro->ajustador_designado()->first()->ajustador()->first()->nombre);
            $templateWord->setValue('caracter_asegurado',$caracter_asegurado);
            if ($siniestro->asegurado->tipo_persona != 2) {
                $templateWord->setValue('apoderado_legal',$siniestro->asegurado->apoderado_legal()->first()->nombre);
            }
            $nombre_archivo = 'Solicitud Remocion Escombros - '.$siniestro->asegurado->nombre.'.docx';
            $nombre_archivo = str_replace(",", "", $nombre_archivo);
            $nombre_archivo = str_replace(" ", "_", $nombre_archivo);
            $templateWord->saveAs($nombre_archivo);
            header("Content-Disposition: attachment; filename=".$nombre_archivo."; charset=iso-8859-1");
            echo file_get_contents($nombre_archivo);
            unlink($nombre_archivo);
        } 
        catch (Exception $e) {
            echo "Error archivo dañado  --  <br>" . $e;
            //return Response::json(array('success' => false, 'error' => $e, 'variables' => $variables));
        }
    }

    //Anticipo Indemnizacion
    public function anticipoIndemnizacion ($id){
        if(Request::ajax()){
            $siniestro = Siniestro::find($id);
            $variables = array('Fecha Siniestro'        => isset($siniestro->fecha),
                                    'Numero Siniestro'      => isset($siniestro->num_siniestro),
                                    'Estado Siniestro'      => isset($siniestro->estado),
                                    'Ciudad Siniestro'      => isset($siniestro->ciudad),
                                    'Asegurado'             => isset($siniestro->asegurado->nombre),
                                    'Caracter Asegurado'    => (count($siniestro->asegurado->caracteres) == 0) ? false : true,
                                    'Aseguradora'           => isset($siniestro->aseguradora->nombre),
                                    'Ajustadores'           => isset($siniestro->id_ajustadora),
                                    'Ajustador Designado'   => isset($siniestro->id_ajustador_designado),
                                    'Numero Poliza'         => isset($siniestro->poliza->num_poliza),
                                    'Ramo Poliza'           => isset($siniestro->poliza->ramo_poliza),
                                    'Tipo de Persona'       => isset($siniestro->asegurado->tipo_persona)
                                );
            if ($siniestro->asegurado->tipo_persona != 2) {
                $variables = array_add($variables, 'Apoderado Legal', isset($siniestro->asegurado->id_apoderado_legal));
            }
            if (count($variables) > count(array_filter($variables))) {
                $variables = array_diff($variables, array_filter($variables));
                $variables = array_keys($variables);
                return Response::json(array('success' => false, 'variables' => $variables));
            }
            else{
                return Response::json(array('success' => true, 'variables' => $variables));
            }
        }
    }


    public function descargarAnticipoIndemnizacion (){
        $siniestro = Siniestro::find(Input::get('id_siniestro'));
        try {
            require_once 'src/PhpWord/Autoloader.php';
            \PhpOffice\PhpWord\Autoloader::register();

            if ($siniestro->asegurado->tipo_persona == 1) {
                $templateWord = new \PhpOffice\PhpWord\TemplateProcessor('formatos/solicitud_anticipo_indemnizacion/pm.docx');
            }
            elseif ($siniestro->asegurado->tipo_persona == 2) {
                $templateWord = new \PhpOffice\PhpWord\TemplateProcessor('formatos/solicitud_anticipo_indemnizacion/pfd.docx');
            }
            elseif ($siniestro->asegurado->tipo_persona == 3) {
                $templateWord = new \PhpOffice\PhpWord\TemplateProcessor('formatos/solicitud_anticipo_indemnizacion/pfrl.docx');
            }

            $array_caracter= array_pluck($siniestro->asegurado->caracteres, 'caracter');
            $caracter_asegurado = implode(", ", $array_caracter);

            $templateWord->setValue('ciudad_siniestro',$siniestro->ciudad);
            $templateWord->setValue('estado_siniestro',DB::table('estados')->where('id', $siniestro->estado)->pluck('nombre'));
            $templateWord->setValue('nombre_asegurado',$siniestro->asegurado->nombre);
            $templateWord->setValue('fecha',$this->FechaFormateada3(time(new DateTime())));
            $templateWord->setValue('fecha_siniestro',$this->FechaFormateada3((new DateTime($siniestro->fecha))->getTimestamp()));
            $templateWord->setValue('ramo_poliza',$siniestro->poliza->ramo_poliza()->first()->ramo);
            $templateWord->setValue('num_poliza',$siniestro->poliza->num_poliza);
            $templateWord->setValue('num_siniestro',$siniestro->num_siniestro);
            $templateWord->setValue('ajustadores',$siniestro->ajustadora->nombre);
            $templateWord->setValue('aseguradora',$siniestro->aseguradora->nombre);
            $templateWord->setValue('ajustador_designado',$siniestro->ajustador_designado()->first()->ajustador()->first()->nombre);
            $templateWord->setValue('caracter_asegurado',$caracter_asegurado);
            $templateWord->setValue('cantidad_anticipo',Input::get('cantidad_anticipo'));
            $templateWord->setValue('cantidad_anticipo_letra',Input::get('cantidad_anticipo_letra'));
            if ($siniestro->asegurado->tipo_persona != 2) {
                $templateWord->setValue('apoderado_legal',$siniestro->asegurado->apoderado_legal()->first()->nombre);
            }
            $nombre_archivo = 'Solicitud Anticipo de Indemnizacion - '.$siniestro->asegurado->nombre.'.docx';
            $nombre_archivo = str_replace(",", "", $nombre_archivo);
            $nombre_archivo = str_replace(" ", "_", $nombre_archivo);
            $templateWord->saveAs($nombre_archivo);
            header("Content-Disposition: attachment; filename=".$nombre_archivo."; charset=iso-8859-1");
            echo file_get_contents($nombre_archivo);
            unlink($nombre_archivo);
        } 
        catch (Exception $e) {
            echo "Error archivo dañado  --  <br>" . $e;
            //return Response::json(array('success' => false, 'error' => $e, 'variables' => $variables));
        }
    }

    //Nombramiento Asesores
    public function nombramientoAsesores ($id){
        if(Request::ajax()){
            $siniestro = Siniestro::find($id);
            $variables = array('Fecha Siniestro'            => isset($siniestro->fecha),
                                    'Estado Siniestro'      => isset($siniestro->estado),
                                    'Ciudad Siniestro'      => isset($siniestro->ciudad),
                                    'Ejecutivos Asignados'  => (count($siniestro->ejecutivo_asignado()->get()) == 0) ? false : true,
                                    'Asegurado'             => isset($siniestro->asegurado->nombre),
                                    'Tipo de Persona'       => isset($siniestro->asegurado->tipo_persona),
                                    'Caracter Asegurado'    => (count($siniestro->asegurado->caracteres) == 0) ? false : true,
                                    'Aseguradora'           => isset($siniestro->aseguradora->nombre),
                                    'Numero Poliza'         => isset($siniestro->poliza->num_poliza),
                                    'Coberturas Afectadas'  => (isset($siniestro->id_poliza)) ? ((count($siniestro->poliza->coberturas) != 0) ? true : false) : false
                                );
            if ($siniestro->asegurado->tipo_persona != 2) {
                $variables = array_add($variables, 'Apoderado Legal', isset($siniestro->asegurado->id_apoderado_legal));
            }
            if (count($variables) > count(array_filter($variables))) {
                $variables = array_diff($variables, array_filter($variables));
                $variables = array_keys($variables);
                return Response::json(array('success' => false, 'variables' => $variables));
            }
            else{
                return Response::json(array('success' => true, 'variables' => $variables));
            }
        }
    }

    public function descargarNombramientoAsesores ($id){
        $siniestro = Siniestro::find($id);
        try {
            require_once 'src/PhpWord/Autoloader.php';
            \PhpOffice\PhpWord\Autoloader::register();

            if ($siniestro->asegurado->tipo_persona == 1) {
                $templateWord = new \PhpOffice\PhpWord\TemplateProcessor('formatos/nombramiento_asesores/pm.docx');
            }
            elseif ($siniestro->asegurado->tipo_persona == 2) {
                $templateWord = new \PhpOffice\PhpWord\TemplateProcessor('formatos/nombramiento_asesores/pfd.docx');
            }
            elseif ($siniestro->asegurado->tipo_persona == 3) {
                $templateWord = new \PhpOffice\PhpWord\TemplateProcessor('formatos/nombramiento_asesores/pfrl.docx');
            }

            $array_caracter= array_pluck($siniestro->asegurado->caracteres, 'caracter');
            $caracter_asegurado = implode(", ", $array_caracter);
            $array_coberturas = array_pluck($siniestro->poliza->coberturas, 'cobertura');
            $coberturas = implode(", ", $array_coberturas);
            $ejecutivos_reclamacion = "";
            foreach ($siniestro->ejecutivo_asignado()->get() as $ejecutivos) {
                $ejecutivos_reclamacion .= $ejecutivos->nombre . " " . $ejecutivos->apellido .", ";
            }

            $templateWord->setValue('ciudad_siniestro',$siniestro->ciudad);
            $templateWord->setValue('estado_siniestro',DB::table('estados')->where('id', $siniestro->estado)->pluck('nombre'));
            $templateWord->setValue('nombre_asegurado',$siniestro->asegurado->nombre);
            $templateWord->setValue('fecha',$this->FechaFormateada3(time(new DateTime())));
            $templateWord->setValue('fecha_siniestro',$this->FechaFormateada3((new DateTime($siniestro->fecha))->getTimestamp()));
            $templateWord->setValue('ramo_poliza',$siniestro->poliza->ramo_poliza()->first()->ramo);
            $templateWord->setValue('num_poliza',$siniestro->poliza->num_poliza);
            $templateWord->setValue('num_siniestro',$siniestro->num_siniestro);
            $templateWord->setValue('ajustadores',$siniestro->ajustadora->nombre);
            $templateWord->setValue('aseguradora',$siniestro->aseguradora->nombre);
            $templateWord->setValue('caracter_asegurado',$caracter_asegurado);
            $templateWord->setValue('coberturas',$coberturas);
            $templateWord->setValue('ejecutivos_reclamacion',$ejecutivos_reclamacion);
            if ($siniestro->asegurado->tipo_persona != 2) {
                $templateWord->setValue('apoderado_legal',$siniestro->asegurado->apoderado_legal()->first()->nombre);
            }
            $nombre_archivo = 'Nombramiento de Asesores - '.$siniestro->asegurado->nombre.'.docx';
            $nombre_archivo = str_replace(",", "", $nombre_archivo);
            $nombre_archivo = str_replace(" ", "_", $nombre_archivo);
            $templateWord->saveAs($nombre_archivo);
            header("Content-Disposition: attachment; filename=".$nombre_archivo."; charset=iso-8859-1");
            echo file_get_contents($nombre_archivo);
            unlink($nombre_archivo);
        } 
        catch (Exception $e) {
            echo "Error archivo dañado  --  <br>" . $e;
            //return Response::json(array('success' => false, 'error' => $e, 'variables' => $variables));
        }
    }

    //Duplicado Poliza
    public function duplicadoPoliza ($id){
        if(Request::ajax()){
            $siniestro = Siniestro::find($id);
            $variables = array('Fecha Siniestro'        => isset($siniestro->fecha),
                                'Numero Siniestro'      => isset($siniestro->num_siniestro),
                                'Estado Siniestro'      => isset($siniestro->estado),
                                'Ciudad Siniestro'      => isset($siniestro->ciudad),
                                'Asegurado'             => isset($siniestro->asegurado->nombre),
                                'Tipo de Persona'       => isset($siniestro->asegurado->tipo_persona),
                                'Caracter Asegurado'    => (count($siniestro->asegurado->caracteres) == 0) ? false : true,
                                'Aseguradora'           => isset($siniestro->aseguradora->nombre),
                                'Ajustadores'           => isset($siniestro->id_ajustadora),
                                'Numero Poliza'         => isset($siniestro->poliza->num_poliza),
                                'Ramo Poliza'           => isset($siniestro->poliza->ramo_poliza),
                                'Coberturas Afectadas'  => (isset($siniestro->id_poliza)) ? ((count($siniestro->poliza->coberturas) != 0) ? true : false) : false
                                );
            if ($siniestro->asegurado->tipo_persona != 2) {
                $variables = array_add($variables, 'Apoderado Legal', isset($siniestro->asegurado->id_apoderado_legal));
            }
            if (count($variables) > count(array_filter($variables))) {
                $variables = array_diff($variables, array_filter($variables));
                $variables = array_keys($variables);
                return Response::json(array('success' => false, 'variables' => $variables));
            }
            else{
                return Response::json(array('success' => true, 'variables' => $variables));
            }
        }
    }


    public function descargarDuplicadoPoliza ($id){
        $siniestro = Siniestro::find($id);
        try {
            require_once 'src/PhpWord/Autoloader.php';
            \PhpOffice\PhpWord\Autoloader::register();

            if ($siniestro->asegurado->tipo_persona == 1) {
                $templateWord = new \PhpOffice\PhpWord\TemplateProcessor('formatos/solicitud_duplicado_poliza/pm.docx');
            }
            elseif ($siniestro->asegurado->tipo_persona == 2) {
                $templateWord = new \PhpOffice\PhpWord\TemplateProcessor('formatos/solicitud_duplicado_poliza/pfd.docx');
            }
            elseif ($siniestro->asegurado->tipo_persona == 3) {
                $templateWord = new \PhpOffice\PhpWord\TemplateProcessor('formatos/solicitud_duplicado_poliza/pfrl.docx');
            }

            $array_caracter= array_pluck($siniestro->asegurado->caracteres, 'caracter');
            $caracter_asegurado = implode(", ", $array_caracter);
            $array_coberturas = array_pluck($siniestro->poliza->coberturas, 'cobertura');
            $coberturas = implode(", ", $array_coberturas);

            $templateWord->setValue('ciudad_siniestro',$siniestro->ciudad);
            $templateWord->setValue('estado_siniestro',DB::table('estados')->where('id', $siniestro->estado)->pluck('nombre'));
            $templateWord->setValue('fecha',$this->FechaFormateada3(time(new DateTime())));
            $templateWord->setValue('fecha_siniestro',$this->FechaFormateada3((new DateTime($siniestro->fecha))->getTimestamp()));
            $templateWord->setValue('nombre_asegurado',$siniestro->asegurado->nombre);
            $templateWord->setValue('ramo_poliza',$siniestro->poliza->ramo_poliza()->first()->ramo);
            $templateWord->setValue('num_poliza',$siniestro->poliza->num_poliza);
            $templateWord->setValue('num_siniestro',$siniestro->num_siniestro);
            $templateWord->setValue('ajustadores',$siniestro->ajustadora->nombre);
            $templateWord->setValue('aseguradora',$siniestro->aseguradora->nombre);
            $templateWord->setValue('caracter_asegurado',$caracter_asegurado);
            $templateWord->setValue('coberturas',$coberturas);
            if ($siniestro->asegurado->tipo_persona != 2) {
                $templateWord->setValue('apoderado_legal',$siniestro->asegurado->apoderado_legal()->first()->nombre);
            }
            $nombre_archivo = 'Solicitud Duplicado de Poliza - '.$siniestro->asegurado->nombre.'.docx';
            $nombre_archivo = str_replace(",", "", $nombre_archivo);
            $nombre_archivo = str_replace(" ", "_", $nombre_archivo);
            $templateWord->saveAs($nombre_archivo);
            header("Content-Disposition: attachment; filename=".$nombre_archivo."; charset=iso-8859-1");
            echo file_get_contents($nombre_archivo);
            unlink($nombre_archivo);
        } 
        catch (Exception $e) {
            echo "Error archivo dañado  --  <br>" . $e;
            //return Response::json(array('success' => false, 'error' => $e, 'variables' => $variables));
        }
    }

    //Asignacion Ajustadores
    public function asignacionAjustadores ($id){
        if(Request::ajax()){
            $siniestro = Siniestro::find($id);
            $variables = array('Fecha Siniestro'        => isset($siniestro->fecha),
                                'Estado Siniestro'      => isset($siniestro->estado),
                                'Ciudad Siniestro'      => isset($siniestro->ciudad),
                                'Asegurado'             => isset($siniestro->asegurado->nombre),
                                'Tipo de Persona'       => isset($siniestro->asegurado->tipo_persona),
                                'Caracter Asegurado'    => (count($siniestro->asegurado->caracteres) == 0) ? false : true,
                                'Aseguradora'           => isset($siniestro->aseguradora->nombre),
                                'Numero Poliza'         => isset($siniestro->poliza->num_poliza),
                                'Coberturas Afectadas'  => (isset($siniestro->id_poliza)) ? ((count($siniestro->poliza->coberturas) != 0) ? true : false) : false
                                );
            if ($siniestro->asegurado->tipo_persona != 2) {
                $variables = array_add($variables, 'Apoderado Legal', isset($siniestro->asegurado->id_apoderado_legal));
            }
            if (count($variables) > count(array_filter($variables))) {
                $variables = array_diff($variables, array_filter($variables));
                $variables = array_keys($variables);
                return Response::json(array('success' => false, 'variables' => $variables));
            }
            else{
                return Response::json(array('success' => true, 'variables' => $variables));
            }
        }
    }


    public function descargarAsignacionAjustadores ($id){
        $siniestro = Siniestro::find($id);
        try {
            require_once 'src/PhpWord/Autoloader.php';
            \PhpOffice\PhpWord\Autoloader::register();

            if ($siniestro->asegurado->tipo_persona == 1) {
                $templateWord = new \PhpOffice\PhpWord\TemplateProcessor('formatos/asignacion_ajustadores/pm.docx');
            }
            elseif ($siniestro->asegurado->tipo_persona == 2) {
                $templateWord = new \PhpOffice\PhpWord\TemplateProcessor('formatos/asignacion_ajustadores/pfd.docx');
            }
            elseif ($siniestro->asegurado->tipo_persona == 3) {
                $templateWord = new \PhpOffice\PhpWord\TemplateProcessor('formatos/asignacion_ajustadores/pfrl.docx');
            }

            $array_caracter= array_pluck($siniestro->asegurado->caracteres, 'caracter');
            $caracter_asegurado = implode(", ", $array_caracter);
            $array_coberturas = array_pluck($siniestro->poliza->coberturas, 'cobertura');
            $coberturas = implode(", ", $array_coberturas);

            $templateWord->setValue('ciudad_siniestro',$siniestro->ciudad);
            $templateWord->setValue('estado_siniestro',DB::table('estados')->where('id', $siniestro->estado)->pluck('nombre'));
            $templateWord->setValue('fecha',$this->FechaFormateada3(time(new DateTime())));
            $templateWord->setValue('fecha_siniestro',$this->FechaFormateada3((new DateTime($siniestro->fecha))->getTimestamp()));
            $templateWord->setValue('nombre_asegurado',$siniestro->asegurado->nombre);
            $templateWord->setValue('num_poliza',$siniestro->poliza->num_poliza);
            $templateWord->setValue('aseguradora',$siniestro->aseguradora->nombre);
            $templateWord->setValue('caracter_asegurado',$caracter_asegurado);
            $templateWord->setValue('coberturas',$coberturas);
            if ($siniestro->asegurado->tipo_persona != 2) {
                $templateWord->setValue('apoderado_legal',$siniestro->asegurado->apoderado_legal()->first()->nombre);
            }
            $nombre_archivo = 'Asignacion de Ajustadores - '.$siniestro->asegurado->nombre.'.docx';
            $nombre_archivo = str_replace(",", "", $nombre_archivo);
            $nombre_archivo = str_replace(" ", "_", $nombre_archivo);
            $templateWord->saveAs($nombre_archivo);
            header("Content-Disposition: attachment; filename=".$nombre_archivo."; charset=iso-8859-1");
            echo file_get_contents($nombre_archivo);
            unlink($nombre_archivo);
        } 
        catch (Exception $e) {
            echo "Error archivo dañado  --  <br>" . $e;
            //return Response::json(array('success' => false, 'error' => $e, 'variables' => $variables));
        }
    }

    //Solcitud Prorroga
    public function solicitudProrroga ($id){
        if(Request::ajax()){
            $siniestro = Siniestro::find($id);
            $variables = array('Fecha Siniestro'        => isset($siniestro->fecha),
                                'Numero Siniestro'      => isset($siniestro->num_siniestro),
                                'Estado Siniestro'      => isset($siniestro->estado),
                                'Ciudad Siniestro'      => isset($siniestro->ciudad),
                                'Asegurado'             => isset($siniestro->asegurado->nombre),
                                'Tipo de Persona'       => isset($siniestro->asegurado->tipo_persona),
                                'Caracter Asegurado'    => (count($siniestro->asegurado->caracteres) == 0) ? false : true,
                                'Aseguradora'           => isset($siniestro->aseguradora->nombre),
                                'Ajustadores'           => isset($siniestro->id_ajustadora),
                                'Ajustador Designado'   => isset($siniestro->id_ajustador_designado),
                                'Numero Poliza'         => isset($siniestro->poliza->num_poliza),
                                'Ramo Poliza'           => isset($siniestro->poliza->ramo_poliza),
                                'Coberturas Afectadas'  => (isset($siniestro->id_poliza)) ? ((count($siniestro->poliza->coberturas) != 0) ? true : false) : false
                                );
            if ($siniestro->asegurado->tipo_persona != 2) {
                $variables = array_add($variables, 'Apoderado Legal', isset($siniestro->asegurado->id_apoderado_legal));
            }
            if (count($variables) > count(array_filter($variables))) {
                $variables = array_diff($variables, array_filter($variables));
                $variables = array_keys($variables);
                return Response::json(array('success' => false, 'variables' => $variables));
            }
            else{
                return Response::json(array('success' => true, 'variables' => $variables));
            }
        }
    }


    public function descargarSolicitudProrroga (){
        $siniestro = Siniestro::find(Input::get('id_siniestro'));
        try {
            require_once 'src/PhpWord/Autoloader.php';
            \PhpOffice\PhpWord\Autoloader::register();

            if ($siniestro->asegurado->tipo_persona == 1) {
                $templateWord = new \PhpOffice\PhpWord\TemplateProcessor('formatos/solicitud_prorroga/pm.docx');
            }
            elseif ($siniestro->asegurado->tipo_persona == 2) {
                $templateWord = new \PhpOffice\PhpWord\TemplateProcessor('formatos/solicitud_prorroga/pfd.docx');
            }
            elseif ($siniestro->asegurado->tipo_persona == 3) {
                $templateWord = new \PhpOffice\PhpWord\TemplateProcessor('formatos/solicitud_prorroga/pfrl.docx');
            }

            $array_caracter= array_pluck($siniestro->asegurado->caracteres, 'caracter');
            $caracter_asegurado = implode(", ", $array_caracter);
            $array_coberturas = array_pluck($siniestro->poliza->coberturas, 'cobertura');
            $coberturas = implode(", ", $array_coberturas);

            $templateWord->setValue('ciudad_siniestro',$siniestro->ciudad);
            $templateWord->setValue('estado_siniestro',DB::table('estados')->where('id', $siniestro->estado)->pluck('nombre'));
            $templateWord->setValue('fecha',$this->FechaFormateada3(time(new DateTime())));
            $templateWord->setValue('fecha_siniestro',$this->FechaFormateada3((new DateTime($siniestro->fecha))->getTimestamp()));
            $templateWord->setValue('nombre_asegurado',$siniestro->asegurado->nombre);
            $templateWord->setValue('num_poliza',$siniestro->poliza->num_poliza);
            $templateWord->setValue('ramo_poliza',$siniestro->poliza->ramo_poliza()->first()->ramo);
            $templateWord->setValue('num_siniestro',$siniestro->num_siniestro);
            $templateWord->setValue('ajustadores',$siniestro->ajustadora->nombre);
            $templateWord->setValue('ajustador_designado',$siniestro->ajustador_designado()->first()->ajustador()->first()->nombre);
            $templateWord->setValue('aseguradora',$siniestro->aseguradora->nombre);
            $templateWord->setValue('caracter_asegurado',$caracter_asegurado);
            $templateWord->setValue('coberturas',$coberturas);
            $templateWord->setValue('fecha_carta',(new DateTime(Input::get('fecha_carta')))->format('d-m-Y'));
            $templateWord->setValue('dias_prorroga',Input::get('dias_prorroga'));
            if ($siniestro->asegurado->tipo_persona != 2) {
                $templateWord->setValue('apoderado_legal',$siniestro->asegurado->apoderado_legal()->first()->nombre);
            }
            $nombre_archivo = 'Solicitud de Prorroga - '.$siniestro->asegurado->nombre.'.docx';
            $nombre_archivo = str_replace(",", "", $nombre_archivo);
            $nombre_archivo = str_replace(" ", "_", $nombre_archivo);
            $templateWord->saveAs($nombre_archivo);
            header("Content-Disposition: attachment; filename=".$nombre_archivo."; charset=iso-8859-1");
            echo file_get_contents($nombre_archivo);
            unlink($nombre_archivo);
        } 
        catch (Exception $e) {
            echo "Error archivo dañado  --  <br>" . $e;
            //return Response::json(array('success' => false, 'error' => $e, 'variables' => $variables));
        }
    }

    // Aviso Siniestro
    public function avisoSiniestro ($id){
        if(Request::ajax()){
            $siniestro = Siniestro::find($id);
            $variables = array('Fecha Siniestro'        => isset($siniestro->fecha),
                                'Tipo Siniestro'        => isset($siniestro->tipo_siniestro),
                                'Domicilio Siniestro'   => isset($siniestro->domicilio),
                                'Estado Siniestro'      => isset($siniestro->estado),
                                'Ciudad Siniestro'      => isset($siniestro->ciudad),
                                'Asegurado'             => isset($siniestro->asegurado->nombre),
                                'Tipo de Persona'       => isset($siniestro->asegurado->tipo_persona),
                                'Caracter Asegurado'    => (count($siniestro->asegurado->caracteres) == 0) ? false : true,
                                'Aseguradora'           => isset($siniestro->aseguradora->nombre),
                                'Numero Poliza'         => isset($siniestro->poliza->num_poliza),
                                'Ramo Poliza'           => isset($siniestro->poliza->ramo_poliza),
                                'Coberturas Afectadas'  => (isset($siniestro->id_poliza)) ? ((count($siniestro->poliza->coberturas) != 0) ? true : false) : false
                                );
            if ($siniestro->asegurado->tipo_persona != 2) {
                $variables = array_add($variables, 'Apoderado Legal', isset($siniestro->asegurado->id_apoderado_legal));
            }
            if (count($variables) > count(array_filter($variables))) {
                $variables = array_diff($variables, array_filter($variables));
                $variables = array_keys($variables);
                return Response::json(array('success' => false, 'variables' => $variables));
            }
            else{
                return Response::json(array('success' => true, 'variables' => $variables));
            }
        }
    }


    public function descargarAvisoSiniestro ($id){
        $siniestro = Siniestro::find($id);
        try {
            require_once 'src/PhpWord/Autoloader.php';
            \PhpOffice\PhpWord\Autoloader::register();

            if ($siniestro->asegurado->tipo_persona == 1) {
                $templateWord = new \PhpOffice\PhpWord\TemplateProcessor('formatos/aviso_siniestro/pm.docx');
            }
            elseif ($siniestro->asegurado->tipo_persona == 2) {
                $templateWord = new \PhpOffice\PhpWord\TemplateProcessor('formatos/aviso_siniestro/pfd.docx');
            }
            elseif ($siniestro->asegurado->tipo_persona == 3) {
                $templateWord = new \PhpOffice\PhpWord\TemplateProcessor('formatos/aviso_siniestro/pfrl.docx');
            }

            $array_caracter= array_pluck($siniestro->asegurado->caracteres, 'caracter');
            $caracter_asegurado = implode(", ", $array_caracter);
            $array_coberturas = array_pluck($siniestro->poliza->coberturas, 'cobertura');
            $coberturas = implode(", ", $array_coberturas);

            $templateWord->setValue('ciudad_siniestro',$siniestro->ciudad);
            $templateWord->setValue('estado_siniestro',DB::table('estados')->where('id', $siniestro->estado)->pluck('nombre'));
            $templateWord->setValue('fecha',$this->FechaFormateada3(time(new DateTime())));
            $templateWord->setValue('fecha_siniestro',$this->FechaFormateada3((new DateTime($siniestro->fecha))->getTimestamp()));
            $templateWord->setValue('domicilio_siniestro',$siniestro->domicilio.", ".$siniestro->ciudad.", ".DB::table('estados')->where('id', $siniestro->estado)->pluck('nombre'));
            $templateWord->setValue('nombre_asegurado',$siniestro->asegurado->nombre);
            $templateWord->setValue('ramo_poliza',$siniestro->poliza->ramo_poliza()->first()->ramo);
            $templateWord->setValue('num_poliza',$siniestro->poliza->num_poliza);
            $templateWord->setValue('aseguradora',$siniestro->aseguradora->nombre);
            $templateWord->setValue('caracter_asegurado',$caracter_asegurado);
            $templateWord->setValue('coberturas',$coberturas);
            $templateWord->setValue('tipo_siniestro',$siniestro->tipo_siniestro()->first()->tipo);
            if ($siniestro->asegurado->tipo_persona != 2) {
                $templateWord->setValue('apoderado_legal',$siniestro->asegurado->apoderado_legal()->first()->nombre);
            }
            $nombre_archivo = 'Aviso Siniestro - '.$siniestro->asegurado->nombre.'.docx';
            $nombre_archivo = str_replace(",", "", $nombre_archivo);
            $nombre_archivo = str_replace(" ", "_", $nombre_archivo);
            $templateWord->saveAs($nombre_archivo);
            header("Content-Disposition: attachment; filename=".$nombre_archivo."; charset=iso-8859-1");
            echo file_get_contents($nombre_archivo);
            unlink($nombre_archivo);
        } 
        catch (Exception $e) {
            echo "Error archivo dañado  --  <br>" . $e;
            //return Response::json(array('success' => false, 'error' => $e, 'variables' => $variables));
        }
    }

    // Solicitud Documentos
    public function solicitudDocumentos ($id){
        if(Request::ajax()){
            $siniestro = Siniestro::find($id);
            $variables = array('Fecha Siniestro'        => isset($siniestro->fecha),
                                'Estado Siniestro'      => isset($siniestro->estado),
                                'Ciudad Siniestro'      => isset($siniestro->ciudad),
                                'Asegurado'             => isset($siniestro->asegurado->nombre),
                                'Tipo de Persona'       => isset($siniestro->asegurado->tipo_persona),
                                'Ajustadores'           => isset($siniestro->id_ajustadora),
                                'Numero Poliza'         => isset($siniestro->poliza->num_poliza),
                                'Ramo Poliza'           => isset($siniestro->poliza->ramo_poliza),
                                'Coberturas Afectadas'  => (isset($siniestro->id_poliza)) ? ((count($siniestro->poliza->coberturas) != 0) ? true : false) : false,
                                'Documentacion'         => (count($siniestro->documentos()->get()) == 0) ? false : true,
                                );
            if ($siniestro->asegurado->tipo_persona != 2) {
                $variables = array_add($variables, 'Apoderado Legal', isset($siniestro->asegurado->id_apoderado_legal));
            }
            if (count($variables) > count(array_filter($variables))) {
                $variables = array_diff($variables, array_filter($variables));
                $variables = array_keys($variables);
                return Response::json(array('success' => false, 'variables' => $variables));
            }
            else{
                return Response::json(array('success' => true, 'variables' => $variables));
            }
        }
    }


    public function descargarSolicitudDocumentos ($id){
        $siniestro = Siniestro::find($id);
        try {
            require_once 'src/PhpWord/Autoloader.php';
            \PhpOffice\PhpWord\Autoloader::register();
            $templateWord = new \PhpOffice\PhpWord\TemplateProcessor('formatos/solicitud_documentos/solicitud.docx');

            $array_caracter= array_pluck($siniestro->asegurado->caracteres, 'caracter');
            $caracter_asegurado = implode(", ", $array_caracter);
            $array_coberturas = array_pluck($siniestro->poliza->coberturas, 'cobertura');
            $coberturas = implode(", ", $array_coberturas);
            $documentacion = "";

            foreach ($siniestro->clasificacion_documentos()->get() as $cla) {
                //$documentacion .= "<w:p><w:r><w:rPr><w:b/></w:rPr><w:t>".$cla->clasificacion."</w:t></w:r></w:p>";
                $documentacion .= "<w:p w:rsidR='00BC1EB0' w:rsidRPr='00083F21' w:rsidRDefault='00083F21'><w:pPr><w:rPr><w:b/></w:rPr></w:pPr><w:r w:rsidRPr='00083F21'><w:rPr><w:b/></w:rPr><w:t>".$cla->clasificacion."</w:t></w:r></w:p>";
                foreach ($siniestro->documentos()->get() as $ds) {
                    if ($ds->id_clasificacion == $cla->id) {
                        $documentacion .= "<w:p w:rsidR='00083F21' w:rsidRDefault='00083F21' w:rsidP='00083F21'><w:pPr><w:pStyle w:val='Prrafodelista'/><w:numPr><w:ilvl w:val='0'/><w:numId w:val='1'/></w:numPr></w:pPr><w:r><w:t>".$ds->documento."</w:t></w:r></w:p>";
                    }
                }
            }

            $templateWord->setValue('ciudad_siniestro',$siniestro->ciudad);
            $templateWord->setValue('estado_siniestro',DB::table('estados')->where('id', $siniestro->estado)->pluck('nombre'));
            $templateWord->setValue('fecha',$this->FechaFormateada3(time(new DateTime())));
            $templateWord->setValue('fecha_siniestro',$this->FechaFormateada3((new DateTime($siniestro->fecha))->getTimestamp()));
            $templateWord->setValue('nombre_asegurado',$siniestro->asegurado->nombre);
            $templateWord->setValue('ramo_poliza',$siniestro->poliza->ramo_poliza()->first()->ramo);
            $templateWord->setValue('num_poliza',$siniestro->poliza->num_poliza);
            $templateWord->setValue('coberturas',$coberturas);
            $templateWord->setValue('ajustadores',$siniestro->ajustadora->nombre);
            $templateWord->setValue('documentacion',$documentacion);

            $nombre_archivo = 'Solicitud de Documentos- '.$siniestro->asegurado->nombre.'.docx';
            $nombre_archivo = str_replace(",", "", $nombre_archivo);
            $nombre_archivo = str_replace(" ", "_", $nombre_archivo);
            $templateWord->saveAs($nombre_archivo);
            header("Content-Disposition: attachment; filename=".$nombre_archivo."; charset=iso-8859-1");
            echo file_get_contents($nombre_archivo);
            unlink($nombre_archivo);
        } 
        catch (Exception $e) {
            echo "Error archivo dañado  --  <br>" . $e;
            //return Response::json(array('success' => false, 'error' => $e, 'variables' => $variables));
        }
    }

    // Averiguacion Previa
    public function averiguacionPrevia ($id){
        if(Request::ajax()){
            $siniestro = Siniestro::find($id);
            $variables = array('Fecha Siniestro'        => isset($siniestro->fecha),
                                'Asegurado'             => isset($siniestro->asegurado->nombre),
                                'Tipo de Persona'       => isset($siniestro->asegurado->tipo_persona),
                                'Numero Averiguacion'   => isset($siniestro->id_averiguacion_previa),
                                'Titular Dependencia'   => isset($siniestro->id_averiguacion_previa),
                                );
            if ($siniestro->asegurado->tipo_persona == 1) {
                $variables = array_add($variables, 'Apoderado Legal', isset($siniestro->asegurado->id_apoderado_legal));
                $variables = array_add($variables, 'Escritura Publica', (count($siniestro->asegurado->acta_constitutiva()->get()) == 0) ? false : true);
                $variables = array_add($variables, 'Fecha de Escritura', (count($siniestro->asegurado->acta_constitutiva()->get()) == 0) ? false : true);
            }
            elseif ($siniestro->asegurado->tipo_persona == 3) {
                $variables = array_add($variables, 'Apoderado Legal', isset($siniestro->asegurado->id_apoderado_legal));
                $variables = array_add($variables, 'Numero de Escritura', isset($siniestro->asegurado->id_apoderado_legal));
                $variables = array_add($variables, 'Fecha de Escritura', isset($siniestro->asegurado->id_apoderado_legal));
            }
            if (count($variables) > count(array_filter($variables))) {
                $variables = array_diff($variables, array_filter($variables));
                $variables = array_keys($variables);
                return Response::json(array('success' => false, 'variables' => $variables));
            }
            else{
                return Response::json(array('success' => true, 'variables' => $variables));
            }
        }
    }

    public function descargarAveriguacionPrevia ($id){
        require_once 'src/PhpWord/Autoloader.php';
        \PhpOffice\PhpWord\Autoloader::register();
        $siniestro = Siniestro::find($id);
            
        if ($siniestro->asegurado->tipo_persona == 1) {
            $carpeta = 'formatos/averiguacion_previa/pm/';
        }
        elseif ($siniestro->asegurado->tipo_persona == 2) {
            $carpeta = 'formatos/averiguacion_previa/pfd/';
        }
        elseif ($siniestro->asegurado->tipo_persona == 3) {
            $carpeta = 'formatos/averiguacion_previa/pfrl/';
        }
        $ficheros = scandir($carpeta);
        $ficheros = array_diff($ficheros, array('.', '..'));
        $archivo_final = 'Averiguacion Previa - '.$siniestro->asegurado->nombre.'.zip';  // .zip *
        $archivo_final = str_replace(",", "", $archivo_final);
        $archivo_final = str_replace(" ", "_", $archivo_final);
        $zip = new ZipArchive();
        $files = array();
        if ($zip->open($archivo_final, ZIPARCHIVE::CREATE)==TRUE){
            foreach ($ficheros as $f) {
                $templateWord = new \PhpOffice\PhpWord\TemplateProcessor($carpeta.$f);
                $templateWord->setValue('fecha',$this->FechaFormateada3(time(new DateTime())));
                $templateWord->setValue('fecha_siniestro',$this->FechaFormateada3((new DateTime($siniestro->fecha))->getTimestamp()));
                $templateWord->setValue('nombre_asegurado',$siniestro->asegurado->nombre);
                $templateWord->setValue('num_averiguacion',$siniestro->averiguacion_previa()->first()->num_averiguacion);
                $templateWord->setValue('titular_dependencia',$siniestro->averiguacion_previa()->first()->titular_dependencia);
                if ($siniestro->asegurado->tipo_persona == 1) {
                    $templateWord->setValue('apoderado_legal',$siniestro->asegurado->apoderado_legal()->first()->nombre);
                    $templateWord->setValue('num_escritura',$siniestro->asegurado->acta_constitutiva()->first()->escritura_publica);
                    $templateWord->setValue('fecha_escritura',$this->FechaFormateada3((new DateTime($siniestro->asegurado->acta_constitutiva()->first()->fecha))->getTimestamp()));
                }
                elseif ($siniestro->asegurado->tipo_persona == 3) {
                    $templateWord->setValue('apoderado_legal',$siniestro->asegurado->apoderado_legal()->first()->nombre);
                    $templateWord->setValue('num_escritura',$siniestro->asegurado->apoderado_legal()->first()->num_escritura);
                    $templateWord->setValue('fecha_escritura',$this->FechaFormateada3((new DateTime($siniestro->asegurado->apoderado_legal()->first()->fecha_escritura))->getTimestamp()));
                }
                $n = explode(".", $f);
                $nombre_archivo = $n[0].' - '.$siniestro->asegurado->nombre.'.docx';
                $nombre_archivo = str_replace(",", "", $nombre_archivo);
                $nombre_archivo = str_replace(" ", "_", $nombre_archivo);
                $templateWord->saveAs($nombre_archivo);
                $zip->addFile($nombre_archivo,$nombre_archivo);
                array_push($files, $nombre_archivo);
            }
        }
        $zip->close();
        foreach ($files as $file) {
            unlink($file);
        }
        header('Content-Type: application/zip');
        header('Content-disposition: attachment; filename='.$archivo_final);
        header('Content-Length: ' . filesize($archivo_final));
        readfile($archivo_final);
        unlink($archivo_final);
    }

    public function cartasReclamacion ($id){
        if(Request::ajax()){
            $siniestro = Siniestro::find($id);
            $variables = array('Fecha Siniestro'        => isset($siniestro->fecha),
                                'Numero Siniestro'      => isset($siniestro->num_siniestro),
                                'Estado Siniestro'      => isset($siniestro->estado),
                                'Ciudad Siniestro'      => isset($siniestro->ciudad),
                                'Asegurado'             => isset($siniestro->asegurado->nombre),
                                'Tipo de Persona'       => isset($siniestro->asegurado->tipo_persona),
                                'Caracter Asegurado'    => (count($siniestro->asegurado->caracteres) == 0) ? false : true,
                                'Aseguradora'           => isset($siniestro->aseguradora->nombre),
                                'Ajustadores'           => isset($siniestro->id_ajustadora),
                                'Ajustador Designado'   => isset($siniestro->id_ajustador_designado),
                                'Numero Poliza'         => isset($siniestro->poliza->num_poliza),
                                'Ramo Poliza'           => isset($siniestro->poliza->ramo_poliza),
                                'Coberturas Afectadas'  => (isset($siniestro->id_poliza)) ? ((count($siniestro->poliza->coberturas) != 0) ? true : false) : false
                                );
            if ($siniestro->asegurado->tipo_persona != 2) {
                $variables = array_add($variables, 'Apoderado Legal', isset($siniestro->asegurado->id_apoderado_legal));
            }
            if (count($variables) > count(array_filter($variables))) {
                $variables = array_diff($variables, array_filter($variables));
                $variables = array_keys($variables);
                return Response::json(array('success' => false, 'variables' => $variables));
            }
            else{
                return Response::json(array('success' => true, 'variables' => $variables));
            }
        }
    }

    public function descargarCartasReclamacion ($id){
        require_once 'src/PhpWord/Autoloader.php';
        \PhpOffice\PhpWord\Autoloader::register();
        $siniestro = Siniestro::find($id);
        $array_coberturas = array_pluck($siniestro->poliza->coberturas, 'id');
        $coberturas = implode(", ", $array_coberturas);
        $array_caracter= array_pluck($siniestro->asegurado->caracteres, 'caracter');
        $caracter_asegurado = implode(", ", $array_caracter);
            
        if ($siniestro->asegurado->tipo_persona == 1) {
            $carpeta = 'formatos/cartas_reclamacion/pm/';
        }
        elseif ($siniestro->asegurado->tipo_persona == 2) {
            $carpeta = 'formatos/cartas_reclamacion/pfd/';
        }
        elseif ($siniestro->asegurado->tipo_persona == 3) {
            $carpeta = 'formatos/cartas_reclamacion/pfrl/';
        }
        $ficheros = scandir($carpeta);
        $ficheros = array_diff($ficheros, array('.', '..'));
        $archivo_final = 'cartas_reclamacion - '.$siniestro->asegurado->nombre.'.zip';  // .zip *
        $archivo_final = str_replace(",", "", $archivo_final);
        $archivo_final = str_replace(" ", "_", $archivo_final);
        $zip = new ZipArchive();
        $files = array();
        if ($zip->open($archivo_final, ZIPARCHIVE::CREATE)==TRUE){
            foreach ($ficheros as $f) {
                $doc = explode(" ", $f);
                if (in_array($doc[0], $array_coberturas)) {
                    $templateWord = new \PhpOffice\PhpWord\TemplateProcessor($carpeta.$f);
                    $templateWord->setValue('ciudad_siniestro',$siniestro->ciudad);
                    $templateWord->setValue('estado_siniestro',DB::table('estados')->where('id', $siniestro->estado)->pluck('nombre'));
                    $templateWord->setValue('fecha',$this->FechaFormateada3(time(new DateTime())));
                    $templateWord->setValue('fecha_siniestro',$this->FechaFormateada3((new DateTime($siniestro->fecha))->getTimestamp()));
                    $templateWord->setValue('nombre_asegurado',$siniestro->asegurado->nombre);
                    $templateWord->setValue('ramo_poliza',$siniestro->poliza->ramo_poliza()->first()->ramo);
                    $templateWord->setValue('num_poliza',$siniestro->poliza->num_poliza);
                    $templateWord->setValue('num_siniestro',$siniestro->num_siniestro);
                    $templateWord->setValue('ajustadores',$siniestro->ajustadora->nombre);
                    $templateWord->setValue('aseguradora',$siniestro->aseguradora->nombre);
                    $templateWord->setValue('ajustador_designado',$siniestro->ajustador_designado()->first()->ajustador()->first()->nombre);
                    $templateWord->setValue('caracter_asegurado',$caracter_asegurado);
                    if ($siniestro->asegurado->tipo_persona != 2) {
                        $templateWord->setValue('apoderado_legal',$siniestro->asegurado->apoderado_legal()->first()->nombre);
                    }
                    $n = explode(".", $f);
                    $nombre_archivo = $n[0].' - '.$siniestro->asegurado->nombre.'.docx';
                    $nombre_archivo = str_replace(",", "", $nombre_archivo);
                    $nombre_archivo = str_replace(" ", "_", $nombre_archivo);
                    $templateWord->saveAs($nombre_archivo);
                    $zip->addFile($nombre_archivo,$nombre_archivo);
                    array_push($files, $nombre_archivo);
                }
            }
        }
        $zip->close();
        foreach ($files as $file) {
            unlink($file);
        }
        header('Content-Type: application/zip');
        header('Content-disposition: attachment; filename='.$archivo_final);
        header('Content-Length: ' . filesize($archivo_final));
        readfile($archivo_final);
        unlink($archivo_final);
    }

    // Edificio Arrendado
    public function edificioArrendado ($id){
        if(Request::ajax()){
            $siniestro = Siniestro::find($id);
            $variables = array('Fecha Siniestro'        => isset($siniestro->fecha),
                                'Numero Siniestro'      => isset($siniestro->num_siniestro),
                                'Estado Siniestro'      => isset($siniestro->estado),
                                'Ciudad Siniestro'      => isset($siniestro->ciudad),
                                'Asegurado'             => isset($siniestro->asegurado->nombre),
                                'Tipo de Persona'       => isset($siniestro->asegurado->tipo_persona),
                                'Caracter Asegurado'    => (count($siniestro->asegurado->caracteres) == 0) ? false : true,
                                'Aseguradora'           => isset($siniestro->aseguradora->nombre),
                                'Ajustadores'           => isset($siniestro->id_ajustadora),
                                'Ajustador Designado'   => isset($siniestro->id_ajustador_designado),
                                'Numero Poliza'         => isset($siniestro->poliza->num_poliza),
                                'Ramo Poliza'           => isset($siniestro->poliza->ramo_poliza),
                                'Coberturas Afectadas'  => (isset($siniestro->id_poliza)) ? ((count($siniestro->poliza->coberturas) != 0) ? true : false) : false
                                );
            if ($siniestro->asegurado->tipo_persona != 2) {
                $variables = array_add($variables, 'Apoderado Legal', isset($siniestro->asegurado->id_apoderado_legal));
            }
            if (count($variables) > count(array_filter($variables))) {
                $variables = array_diff($variables, array_filter($variables));
                $variables = array_keys($variables);
                return Response::json(array('success' => false, 'variables' => $variables));
            }
            else{
                return Response::json(array('success' => true, 'variables' => $variables));
            }
        }
    }


    public function descargarEdificioArrendado ($id){
        $siniestro = Siniestro::find($id);
        try {
            require_once 'src/PhpWord/Autoloader.php';
            \PhpOffice\PhpWord\Autoloader::register();

            if ($siniestro->asegurado->tipo_persona == 1) {
                $templateWord = new \PhpOffice\PhpWord\TemplateProcessor('formatos/remision_reclamacion_edificio_arrendado/pm.docx');
            }
            elseif ($siniestro->asegurado->tipo_persona == 2) {
                $templateWord = new \PhpOffice\PhpWord\TemplateProcessor('formatos/remision_reclamacion_edificio_arrendado/pfd.docx');
            }
            elseif ($siniestro->asegurado->tipo_persona == 3) {
                $templateWord = new \PhpOffice\PhpWord\TemplateProcessor('formatos/remision_reclamacion_edificio_arrendado/pfrl.docx');
            }

            $array_caracter= array_pluck($siniestro->asegurado->caracteres, 'caracter');
            $caracter_asegurado = implode(", ", $array_caracter);
            //$fecha = $this->FechaFormateada3(time(new DateTime()));
            $array_coberturas = array_pluck($siniestro->poliza->coberturas, 'cobertura');
            $coberturas = implode(", ", $array_coberturas);

            $templateWord->setValue('ciudad_siniestro',$siniestro->ciudad);
            $templateWord->setValue('estado_siniestro',DB::table('estados')->where('id', $siniestro->estado)->pluck('nombre'));
            $templateWord->setValue('fecha',$this->FechaFormateada3(time(new DateTime())));
            $templateWord->setValue('nombre_asegurado',$siniestro->asegurado->nombre);
            $templateWord->setValue('fecha_siniestro',$this->FechaFormateada3((new DateTime($siniestro->fecha))->getTimestamp()));
            $templateWord->setValue('ramo_poliza',$siniestro->poliza->ramo_poliza()->first()->ramo);
            $templateWord->setValue('num_poliza',$siniestro->poliza->num_poliza);
            $templateWord->setValue('num_siniestro',$siniestro->num_siniestro);
            $templateWord->setValue('coberturas',$coberturas);
            $templateWord->setValue('ajustadores',$siniestro->ajustadora->nombre);
            $templateWord->setValue('aseguradora',$siniestro->aseguradora->nombre);
            $templateWord->setValue('ajustador_designado',$siniestro->ajustador_designado()->first()->ajustador()->first()->nombre);
            $templateWord->setValue('caracter_asegurado',$caracter_asegurado);
            if ($siniestro->asegurado->tipo_persona != 2) {
                $templateWord->setValue('apoderado_legal',$siniestro->asegurado->apoderado_legal()->first()->nombre);
            }

            $nombre_archivo = 'Remision Edificio Arrendado- '.$siniestro->asegurado->nombre.'.docx';
            $nombre_archivo = str_replace(",", "", $nombre_archivo);
            $nombre_archivo = str_replace(" ", "_", $nombre_archivo);
            $templateWord->saveAs($nombre_archivo);
            header("Content-Disposition: attachment; filename=".$nombre_archivo."; charset=iso-8859-1");
            echo file_get_contents($nombre_archivo);
            unlink($nombre_archivo);
        } 
        catch (Exception $e) {
            echo "Error archivo dañado  --  <br>" . $e;
            //return Response::json(array('success' => false, 'error' => $e, 'variables' => $variables));
        }
    }


    public function terceroAfectado ($id){
        if(Request::ajax()){
            $siniestro = Siniestro::find($id);
            $variables = array('Fecha Siniestro'        => isset($siniestro->fecha),
                                'Numero Siniestro'      => isset($siniestro->num_siniestro),
                                'Tipo de Persona'       => isset($siniestro->asegurado->tipo_persona),
                                'Estado Siniestro'      => isset($siniestro->estado),
                                'Ciudad Siniestro'      => isset($siniestro->ciudad),
                                'Asegurado'             => isset($siniestro->asegurado->nombre),
                                'Aseguradora'           => isset($siniestro->aseguradora->nombre),
                                'Ajustadores'           => isset($siniestro->id_ajustadora),
                                'Numero Poliza'         => isset($siniestro->poliza->num_poliza),
                                'Ramo Poliza'           => isset($siniestro->poliza->ramo_poliza),
                                'Coberturas Afectadas'  => (isset($siniestro->id_poliza)) ? ((count($siniestro->poliza->coberturas) != 0) ? true : false) : false
                                );
            if ($siniestro->asegurado->tipo_persona != 2) {
                $variables = array_add($variables, 'Apoderado Legal', isset($siniestro->asegurado->id_apoderado_legal));
            }
            if (count($variables) > count(array_filter($variables))) {
                $variables = array_diff($variables, array_filter($variables));
                $variables = array_keys($variables);
                return Response::json(array('success' => false, 'variables' => $variables));
            }
            else{
                return Response::json(array('success' => true, 'variables' => $variables));
            }
        }
    }

    public function descargarTerceroAfectado ($id){
        $siniestro = Siniestro::find($id);
        try {
            require_once 'src/PhpWord/Autoloader.php';
            \PhpOffice\PhpWord\Autoloader::register();

            if ($siniestro->asegurado->tipo_persona == 1) {
                $templateWord = new \PhpOffice\PhpWord\TemplateProcessor('formatos/remision_reclamacion_tercero_afectado/pm.docx');
            }
            elseif ($siniestro->asegurado->tipo_persona == 2) {
                $templateWord = new \PhpOffice\PhpWord\TemplateProcessor('formatos/remision_reclamacion_tercero_afectado/pfd.docx');
            }
            elseif ($siniestro->asegurado->tipo_persona == 3) {
                $templateWord = new \PhpOffice\PhpWord\TemplateProcessor('formatos/remision_reclamacion_tercero_afectado/pfrl.docx');
            }

            $array_caracter= array_pluck($siniestro->asegurado->caracteres, 'caracter');
            $caracter_asegurado = implode(", ", $array_caracter);
            $array_coberturas = array_pluck($siniestro->poliza->coberturas, 'cobertura');
            $coberturas = implode(", ", $array_coberturas);

            $templateWord->setValue('ciudad_siniestro',$siniestro->ciudad);
            $templateWord->setValue('estado_siniestro',DB::table('estados')->where('id', $siniestro->estado)->pluck('nombre'));
            $templateWord->setValue('fecha',$this->FechaFormateada3(time(new DateTime())));
            $templateWord->setValue('nombre_asegurado',$siniestro->asegurado->nombre);
            $templateWord->setValue('fecha_siniestro',$this->FechaFormateada3((new DateTime($siniestro->fecha))->getTimestamp()));
            $templateWord->setValue('ramo_poliza',$siniestro->poliza->ramo_poliza()->first()->ramo);
            $templateWord->setValue('num_poliza',$siniestro->poliza->num_poliza);
            $templateWord->setValue('num_siniestro',$siniestro->num_siniestro);
            $templateWord->setValue('coberturas',$coberturas);
            $templateWord->setValue('ajustadores',$siniestro->ajustadora->nombre);
            $templateWord->setValue('aseguradora',$siniestro->aseguradora->nombre);
            if ($siniestro->asegurado->tipo_persona != 2) {
                $templateWord->setValue('apoderado_legal',$siniestro->asegurado->apoderado_legal()->first()->nombre);
            }

            $nombre_archivo = 'Remision Reclamacion Tercero Afectado- '.$siniestro->asegurado->nombre.'.docx';
            $nombre_archivo = str_replace(",", "", $nombre_archivo);
            $nombre_archivo = str_replace(" ", "_", $nombre_archivo);
            $templateWord->saveAs($nombre_archivo);
            header("Content-Disposition: attachment; filename=".$nombre_archivo."; charset=iso-8859-1");
            echo file_get_contents($nombre_archivo);
            unlink($nombre_archivo);
        } 
        catch (Exception $e) {
            echo "Error archivo dañado  --  <br>" . $e;
            //return Response::json(array('success' => false, 'error' => $e, 'variables' => $variables));
        }
    }

    public function ofertaSalvamento ($id){
        if(Request::ajax()){
            $siniestro = Siniestro::find($id);
            $variables = array('Fecha Siniestro'        => isset($siniestro->fecha),
                                'Asegurado'             => isset($siniestro->asegurado->nombre),
                                'Tipo de Persona'       => isset($siniestro->asegurado->tipo_persona),
                                'Estado Asegurado'      => isset($siniestro->asegurado->estado),
                                'Ciudad Asegurado'      => isset($siniestro->asegurado->ciudad),
                                'Caracter Asegurado'    => (count($siniestro->asegurado->caracteres) == 0) ? false : true,
                                'Aseguradora'           => isset($siniestro->aseguradora->nombre),
                                'Ajustadores'           => isset($siniestro->id_ajustadora),
                                'Numero Poliza'         => isset($siniestro->poliza->num_poliza),
                                'Ramo Poliza'           => isset($siniestro->poliza->ramo_poliza),
                                'Coberturas Afectadas'  => (isset($siniestro->id_poliza)) ? ((count($siniestro->poliza->coberturas) != 0) ? true : false) : false
                                );
            if ($siniestro->asegurado->tipo_persona != 2) {
                $variables = array_add($variables, 'Apoderado Legal', isset($siniestro->asegurado->id_apoderado_legal));
            }
            if (count($variables) > count(array_filter($variables))) {
                $variables = array_diff($variables, array_filter($variables));
                $variables = array_keys($variables);
                return Response::json(array('success' => false, 'variables' => $variables));
            }
            else{
                return Response::json(array('success' => true, 'variables' => $variables));
            }
        }
    }



    public function descargarOfertaSalvamento ($id){
        $siniestro = Siniestro::find($id);
        try {
            require_once 'src/PhpWord/Autoloader.php';
            \PhpOffice\PhpWord\Autoloader::register();

            if ($siniestro->asegurado->tipo_persona == 1) {
                $templateWord = new \PhpOffice\PhpWord\TemplateProcessor('formatos/oferta_salvamento/pm.docx');
            }
            elseif ($siniestro->asegurado->tipo_persona == 2) {
                $templateWord = new \PhpOffice\PhpWord\TemplateProcessor('formatos/oferta_salvamento/pfd.docx');
            }
            elseif ($siniestro->asegurado->tipo_persona == 3) {
                $templateWord = new \PhpOffice\PhpWord\TemplateProcessor('formatos/oferta_salvamento/pfrl.docx');
            }

            $array_caracter= array_pluck($siniestro->asegurado->caracteres, 'caracter');
            $caracter_asegurado = implode(", ", $array_caracter);
            $array_coberturas = array_pluck($siniestro->poliza->coberturas, 'cobertura');
            $coberturas = implode(", ", $array_coberturas);

            $templateWord->setValue('ciudad_siniestro',$siniestro->ciudad);
            $templateWord->setValue('estado_siniestro',DB::table('estados')->where('id', $siniestro->estado)->pluck('nombre'));
            $templateWord->setValue('fecha',$this->FechaFormateada3(time(new DateTime())));
            $templateWord->setValue('nombre_asegurado',$siniestro->asegurado->nombre);
            $templateWord->setValue('fecha_siniestro',$this->FechaFormateada3((new DateTime($siniestro->fecha))->getTimestamp()));
            $templateWord->setValue('ramo_poliza',$siniestro->poliza->ramo_poliza()->first()->ramo);
            $templateWord->setValue('num_poliza',$siniestro->poliza->num_poliza);
            $templateWord->setValue('coberturas',$coberturas);
            $templateWord->setValue('ajustadores',$siniestro->ajustadora->nombre);
            $templateWord->setValue('aseguradora',$siniestro->aseguradora->nombre);
            $templateWord->setValue('caracter_asegurado',$caracter_asegurado);
            if ($siniestro->asegurado->tipo_persona != 2) {
                $templateWord->setValue('apoderado_legal',$siniestro->asegurado->apoderado_legal()->first()->nombre);
            }

            $nombre_archivo = 'Oferta Salvamento - '.$siniestro->asegurado->nombre.'.docx';
            $nombre_archivo = str_replace(",", "", $nombre_archivo);
            $nombre_archivo = str_replace(" ", "_", $nombre_archivo);
            $templateWord->saveAs($nombre_archivo);
            header("Content-Disposition: attachment; filename=".$nombre_archivo."; charset=iso-8859-1");
            echo file_get_contents($nombre_archivo);
            unlink($nombre_archivo);
        } 
        catch (Exception $e) {
            echo "Error archivo dañado  --  <br>" . $e;
            //return Response::json(array('success' => false, 'error' => $e, 'variables' => $variables));
        }
    }

}
?>