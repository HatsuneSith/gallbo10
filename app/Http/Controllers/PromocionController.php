<?php namespace App\Http\Controllers;
use View;
use Auth;
use DB;
use App\Models\PromocionSiniestro;
use App\Models\ComentarioPromocionSiniestro;
use App\Models\Siniestro;
use App\Models\Asegurado;
use App\Models\PropuestaSiniestro;

class PromocionController extends Controller {

    public function inicio()
    {
        return View::make('promocion.inicio');
    }

    public function busqueda()
    {
        $estados = DB::table('estados')->get();
        return View::make('promocion.busqueda', array('estados' => $estados));

    }

    public function busquedaPeriodicos($id){
        if(Request::ajax()){
            $periodicos = DB::table('periodicos')->where('id_estado', '=', $id)->get();
            return Response::json(array('success' =>true, 'periodicos' => $periodicos));
        }
    }

    public function busquedaCiudades($id){
        if(Request::ajax()){
            $ciudades = DB::table('localidades')
                                ->join('municipios', function($join)
                                {
                                    $join->on('localidades.municipio_id', '=', 'municipios.id');         
                                })
                                ->where('municipios.estado_id', '=', $id)
                                ->select('localidades.id', 'localidades.nombre')
                                ->get();
            return Response::json(array('success' =>true, 'ciudades' => $ciudades));
        }
    }

    public function siniestros()
    {
		$siniestros = PromocionSiniestro::all();
		return View::make('promocion.siniestros', array('siniestros' => $siniestros));
    }


    public function siniestrosNuevo()
    {
        $estados = DB::table('estados')->get();
        $giros_empresas = DB::table('GirosEmpresas')->get();
        $tipos_siniestros = DB::table('TiposSiniestros')->get();
        return View::make('promocion.nuevo', array( 'estados' => $estados, 
                                                    'giros_empresas' => $giros_empresas, 
                                                    'tipos_siniestros' => $tipos_siniestros
                                                    ));
    }

    public function siniestrosGuardar()
    {
        $reglas =  array(
        'fecha_siniestro'               => 'required',
        'nombre'                        => 'required',
        'director_general'              => 'required',
        'asistente_director_general'    => 'required',
        'tipo_siniestro'                => 'required',
        'magnitud_siniestro'            => 'required',
        'giro_empresa'                  => 'required',
        'estado'                        => 'required',
        'ciudad'                        => 'required',
        'domicilio'                     => 'required',
        'telefonos'                     => 'required',
        'email'                         => 'required',
        'fuente_informacion'            => 'required'
        );

        $validator = Validator::make(Input::all(), $reglas);

        if ( $validator->fails() ){
            return Redirect::to('sire/promocion/siniestros/nuevo')
                    ->with('danger', $danger="Error al guardar, Verifique que todos los campos fueron llenados correctamente")
                    ->withErrors($validator)// Aquí se esta devolviendo a la vista los errores
                    ->withInput();// Aquí se esta devolviendo a la vista todos los datos del formulario
        }
        else{
            $date = str_replace ('/' , '-' , Input::get('fecha_siniestro'));
            $fecha_siniestro = new DateTime($date);
            $estatus = "Pendiente";
            $input = array(
                'fecha_siniestro'               => $fecha_siniestro,
                'nombre'                        => Input::get('nombre'),
                'director_general'              => Input::get('director_general'),
                'asistente_director_general'    => Input::get('asistente_director_general'),
                'tipo_siniestro'                => Input::get('tipo_siniestro'),
                'magnitud_siniestro'            => Input::get('magnitud_siniestro'),
                'giro_empresa'                  => Input::get('giro_empresa'),
                'estado'                        => Input::get('estado'),
                'ciudad'                        => Input::get('ciudad'),
                'domicilio'                     => Input::get('domicilio'),
                'telefonos'                     => Input::get('telefonos'),
                'email'                         => Input::get('email'),
                'fuente_informacion'            => Input::get('fuente_informacion'),
                'estatus'                       => $estatus
                );
            PromocionSiniestro::create($input);
 

            return Redirect::to('sire/promocion/siniestros')->with('info', $info="Siniestro Agregado Correctamente");
        }
    }

    public function siniestrosVer($id)
    {
        $estados = DB::table('estados')->get();
        $giros_empresas = DB::table('GirosEmpresas')->get();
        $tipos_siniestros = DB::table('TiposSiniestros')->get();
        $siniestro = PromocionSiniestro::find($id);
        $comentarios = PromocionSiniestro::find($id)->comentarios;
        //$comentarios = DB::table('ComentariosPromocionSiniestros')->where('id_promocion_siniestros', '=', $id)->get(); 
        return View::make('promocion.ver', array('siniestro' => $siniestro,
                                                'estados' => $estados, 
                                                'giros_empresas' => $giros_empresas, 
                                                'tipos_siniestros' => $tipos_siniestros,
                                                'comentarios' => $comentarios
                                                ));
    }

    public function siniestrosActualizar($id)
    {
        $reglas =  array(
        'fecha_siniestro'               => 'required',
        'nombre'                        => 'required',
        'director_general'              => 'required',
        'asistente_director_general'    => 'required',
        'tipo_siniestro'                => 'required',
        'magnitud_siniestro'            => 'required',
        'giro_empresa'                  => 'required',
        'estado'                        => 'required',
        'ciudad'                        => 'required',
        'domicilio'                     => 'required',
        'telefonos'                     => 'required',
        'email'                         => 'required',
        'fuente_informacion'            => 'required'
        );

        $validator = Validator::make(Input::all(), $reglas);

        if ( $validator->fails() ){
            return Redirect::to('sire/promocion/siniestros/ver/'.$id)
                    ->with('danger', $danger="Error al guardar, Verifique que todos los campos fueron llenados correctamente")
                    ->withErrors($validator)// Aquí se esta devolviendo a la vista los errores
                    ->withInput();// Aquí se esta devolviendo a la vista todos los datos del formulario
        }
        else{
            $promSiniestro = PromocionSiniestro::find($id);
            $date = str_replace ('/' , '-' , Input::get('fecha_siniestro'));
            $fecha_siniestro = new DateTime($date);
            $input = array(
                'fecha_siniestro'               => $fecha_siniestro,
                'nombre'                        => Input::get('nombre'),
                'director_general'              => Input::get('director_general'),
                'asistente_director_general'    => Input::get('asistente_director_general'),
                'tipo_siniestro'                => Input::get('tipo_siniestro'),
                'magnitud_siniestro'            => Input::get('magnitud_siniestro'),
                'giro_empresa'                  => Input::get('giro_empresa'),
                'estado'                        => Input::get('estado'),
                'ciudad'                        => Input::get('ciudad'),
                'domicilio'                     => Input::get('domicilio'),
                'telefonos'                     => Input::get('telefonos'),
                'email'                         => Input::get('email'),
                'fuente_informacion'            => Input::get('fuente_informacion')
                );
            $promSiniestro->fill($input);
            $promSiniestro->save();
            return Redirect::to('sire/promocion/siniestros/ver/'.$id)->with('info', $info="Siniestro Actualizado Correctamente");
        }


    }

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

    

    public function siniestrosCita($id)
    {
        $reglas =  array(
        'fecha_cita_agendada'   => 'required',
        'fecha_cita_realizada'  => 'required',
        'lugar_cita'            => 'required'
        );

        $validator = Validator::make(Input::all(), $reglas);

        if ( $validator->fails() ){
            return Redirect::to('sire/promocion/siniestros/ver/'.$id)
                    ->with('danger', $danger="Error al guardar, Verifique que todos los campos fueron llenados correctamente")
                    ->withErrors($validator)// Aquí se esta devolviendo a la vista los errores
                    ->withInput();// Aquí se esta devolviendo a la vista todos los datos del formulario
        }
        else{
            $promSiniestro = PromocionSiniestro::find($id);
            $date1 = str_replace ('/' , '-' , Input::get('fecha_cita_realizada'));
            $fecha_cita_realizada = new DateTime($date1);
            $date2 = str_replace ('/' , '-' , Input::get('fecha_cita_agendada'));
            $fecha_cita_agendada = new DateTime($date2);
            $data = array(
                'fecha_cita_agendada'   => $fecha_cita_agendada,
                'fecha_cita_realizada'  => $fecha_cita_realizada,
                'lugar_cita'            => Input::get('lugar_cita')
                );

            $fecha_cita_agendada_correo = strtotime($date2); //convertimos la fecha a time
            $lugar_siniestro = $promSiniestro->domicilio . ", " . $promSiniestro->ciudad .", " . $promSiniestro->estado()->first()->nombre;
            $data_correo =  array(
                'fecha_cita_agendada'   => $this->FechaFormateada2($fecha_cita_agendada_correo), //mandamos la fecha a la funcion para recibir un string
                'nombre_empresa'        => $promSiniestro->nombre,
                'lugar_cita'            => Input::get('lugar_cita'),
                'tipo_siniestro'        => $promSiniestro->tipo_siniestro()->first()->tipo,
                'fecha_siniestro'       => $this->FechaFormateada2(strtotime($promSiniestro->fecha_siniestro)),
                'magnitud_siniestro'    => $promSiniestro->magnitud_siniestro,
                'giro_empresa'          => $promSiniestro->giro_empresa()->first()->giro,
                'lugar_siniestro'       => $lugar_siniestro,
                'telefono'              => $promSiniestro->telefonos,
                'correo_empresa'        => $promSiniestro->email,
                'asistente'             => $promSiniestro->asistente_director_general,
                'director_general'      => $promSiniestro->director_general
                );
            $promSiniestro->fill($data);
            $promSiniestro->save();
            Mail::queue('emails.promocion.nuevacita', $data_correo, function($message)
            {
                $message->to('tareas.mgallardo@gallbo.com')->cc('tareas.lmartinez@galbo.com');
                $message->subject('Nueva cita agendada');
            });
            
            return Redirect::to('sire/promocion/siniestros/ver/'.$id)->with('info', $info="Cita Agregada Correctamente");
        }
    }

    public function siniestrosComentar($id)
    {
        $reglas =  array(
        'comentario'   => 'required'
        );

        $validator = Validator::make(Input::all(), $reglas);

        if ( $validator->fails() ){
            return Redirect::to('sire/promocion/siniestros/ver/'.$id)
                    ->with('danger', $danger="Error al guardar, Verifique que todos los campos fueron llenados correctamente")
                    ->withErrors($validator)// Aquí se esta devolviendo a la vista los errores
                    ->withInput();// Aquí se esta devolviendo a la vista todos los datos del formulario
        }
        else{

            $input = Input::all();
            ComentarioPromocionSiniestro::create($input);
            return Redirect::to('sire/promocion/siniestros/ver/'.$id)->with('info', $info="Comentario Agregado Correctamente");
        }
    }

    public function siniestrosEstatus($id)
    {
        $reglas =  array(
        'estatus'   => 'required'
        );

        $validator = Validator::make(Input::all(), $reglas);

        if ( $validator->fails() ){
            return Redirect::to('sire/promocion/siniestros/ver/'.$id)
                    ->with('danger', $danger="Error al guardar, Verifique que todos los campos fueron llenados correctamente")
                    ->withErrors($validator)// Aquí se esta devolviendo a la vista los errores
                    ->withInput();// Aquí se esta devolviendo a la vista todos los datos del formulario
        }
        else{
            if (Input::get('estatus') == 'Aceptado') {
                $promSiniestro = PromocionSiniestro::find($id);
                $inputSiniestro = array('fecha'             => $promSiniestro->fecha_siniestro,
                                        'domicilio'         => $promSiniestro->domicilio,
                                        'estado'            => $promSiniestro->estado,
                                        'ciudad'            => $promSiniestro->ciudad,
                                        'tipo_siniestro'    => $promSiniestro->tipo_siniestro
                                        );

                $inputAsegurado = array('nombre'    => $promSiniestro->nombre,
                                        'giro'      => $promSiniestro->giro_empresa
                                        );

                $siniestro = Siniestro::create($inputSiniestro);
                $siniestroId = $siniestro->id;
                $asegurado = Asegurado::create($inputAsegurado);
                $aseguradoId = $asegurado->id;
                DB::table('Siniestros')->where('id', $siniestroId)->update(array('id_asegurado' => $aseguradoId));

                
            }
            $promSiniestro = PromocionSiniestro::find($id);
            $data = Input::all();
            $promSiniestro->fill($data);
            $promSiniestro->save();
            return Redirect::to('sire/promocion/siniestros/ver/'.$id)->with('info', $info="Estatus Actualizado Correctamente");
        }
    }

    public function busquedaPropuesta($id){
        if(Request::ajax()){
            $propuesta = PromocionSiniestro::find($id)->propuesta;
            if (isset($propuesta)) {
                return Response::json(array('success' =>true, 'propuesta' => $propuesta));
            }
            else{
                $siniestro = PromocionSiniestro::find($id);
                return Response::json(array('success' =>false, 'siniestro' => $siniestro));
            }
            
            
        }
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

    public function imprimirPropuesta(){
        $date = str_replace ('/' , '-' , Input::get('fecha_siniestro'));
        $fecha_siniestro = new DateTime($date);

        $estado_siniestro = DB::table('estados')->where('id', Input::get('estado'))->pluck('nombre');
        $ciudad_siniestro = Input::get('ciudad') . ", " . $estado_siniestro;

        $ciudad_propuesta = Input::get('ciudad_propuesta');
        $estado_propuesta = DB::table('estados')->where('id', Input::get('estado_propuesta'))->pluck('nombre');
        $now = new DateTime();
        $fecha = time($now);
        $fecha_si = $fecha_siniestro->getTimestamp();
        $fecha_propuesta = $this->FechaFormateada3($fecha);
        $fechasiniestro = $this->FechaFormateada3($fecha_si);
        $input = array(
            'asegurado'                     => Input::get('asegurado'),
            'apoderado_legal'               => Input::get('apoderado_legal'),
            'estado'                        => Input::get('estado'),
            'ciudad'                        => Input::get('ciudad'),
            'domicilio'                     => Input::get('domicilio'),
            'fecha_siniestro'               => $fecha_siniestro,
            'num_poliza'                    => Input::get('num_poliza'),
            'aseguradora'                   => Input::get('aseguradora'),
            'honorarios_porcentaje'         => Input::get('honorarios_porcentaje'),
            'honorarios_porcentaje_letra'   => Input::get('honorarios_porcentaje_letra'),
            'anticipo_cantidad'             => Input::get('anticipo_cantidad'),
            'anticipo_cantidad_letra'       => Input::get('anticipo_cantidad_letra'),
            'num_personas_atencion'         => Input::get('num_personas_atencion'),
            'id_promocion_siniestro'        => Input::get('id_promocion_siniestro')
            );

        $propuesta = PromocionSiniestro::find(Input::get('id_promocion_siniestro'))->propuesta;
        if (isset($propuesta)) {
            $propuesta->fill($input);
            $propuesta->save();
        }
        else{
            PropuestaSiniestro::create($input);
        }

        require_once 'src/PhpWord/Autoloader.php';
        \PhpOffice\PhpWord\Autoloader::register();
        $templateWord = new \PhpOffice\PhpWord\TemplateProcessor('formatos/propuesta/propuesta.docx');

        $templateWord->setValue('ciudad_propuesta',$ciudad_propuesta);
        $templateWord->setValue('estado_propuesta',$estado_propuesta);
        $templateWord->setValue('fecha_propuesta',$fecha_propuesta);
        $templateWord->setValue('apoderado_legal',Input::get('apoderado_legal'));
        $templateWord->setValue('nombre_asegurado',Input::get('asegurado'));
        $templateWord->setValue('domicilio_siniestro',Input::get('domicilio'));
        $templateWord->setValue('ciudad_siniestro',$ciudad_siniestro);
        $templateWord->setValue('fecha_siniestro',$fechasiniestro);
        $templateWord->setValue('num_poliza',Input::get('num_poliza'));
        $templateWord->setValue('aseguradora',Input::get('aseguradora'));
        $templateWord->setValue('porcentaje_honorarios',Input::get('honorarios_porcentaje'));
        $templateWord->setValue('porcentaje_honorarios_letra',Input::get('honorarios_porcentaje_letra'));
        $templateWord->setValue('cantidad_anticipo',Input::get('anticipo_cantidad'));
        $templateWord->setValue('cantidad_anticipo_letra',Input::get('anticipo_cantidad_letra'));
        $templateWord->setValue('num_personas_atencion',Input::get('num_personas_atencion'));
        $nombre_archivo = 'Propuesta - '.Input::get('asegurado').'.docx';


        $templateWord->saveAs($nombre_archivo);
        header("Content-Disposition: attachment; filename=".$nombre_archivo."; charset=iso-8859-1");
        echo file_get_contents($nombre_archivo);
        unlink($nombre_archivo);

    }

}
?>