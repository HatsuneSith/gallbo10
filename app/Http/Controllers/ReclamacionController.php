<?php namespace App\Http\Controllers;
use View;
use Auth;
use DB;
use App\Models\Siniestro;
use App\Models\Estados;
use App\Models\GirosEmpresas;
use App\Models\TiposSiniestros;
use App\Models\TiposPersonas;
use App\Models\Asegurado;
use App\Models\Aseguradora;
use App\Models\TableroSiniestrosNoRegistrados;
use App\Models\Estados;
use App\Models\Sexos;
use App\Models\CaracteresAsegurado;
use App\Models\RamosPolizas;
use App\Models\Monedas;
use App\Models\Coberturas;
use App\Models\PerdidasConsecuenciales;
use App\Models\ClausulasEspeciales;
use App\Models\usuario;
use App\Models\ApoderadoLegal;
use App\Models\Contacto;
use App\Models\ActaConstitutiva;
use App\Models\AgentesSeguros;
use App\Models\DirectorDespacho;
use App\Models\DirectorSiniestros;
use App\Models\AveriguacionPrevia;
use App\Models\Poliza;
use App\Models\AgenteSeguroSiniestro;
use App\Models\LimitacionValorReposicion;
use App\Models\GerenciaSiniestros;
use App\Models\Ajustadora;
use App\Models\Ajustadores;
use App\Models\AjustadorDesignado;
use App\Models\MedidasSeguridad;
use App\Models\EndososConvenios;
use App\Models\Bitacora;
use App\Models\TableroFechas;


class ReclamacionController extends Controller {

    public function inicio()
    {
    	$siniestros = Siniestro::all();
        $estados = Estados::all();
        $giros_empresas = GirosEmpresas::all();
        $tipos_siniestros = TiposSiniestros::all();
        $tipos_personas = TiposPersonas::all();
        return View::make('reclamacion.inicio', array('estados'          => $estados, 
                                                        'giros_empresas'     => $giros_empresas, 
                                                        'tipos_siniestros'   => $tipos_siniestros,
                                                        'tipos_personas'     => $tipos_personas,
                                                        'siniestros'         => $siniestros));
    }

    public function agregarSiniestro()
    {
        $date = str_replace ('/' , '-' , Input::get('fecha'));
        $fecha = new DateTime($date);
        $inputSiniestro = array('fecha'             => $fecha,
                                'tipo_siniestro'    => Input::get('tipo_siniestro'),
                                'domicilio'         => Input::get('domicilio'),
                                'estado'            => Input::get('estado'),
                                'ciudad'            => Input::get('ciudad'),
                                'codigo_postal'     => Input::get('codigo_postal'),
                                );

        $inputAsegurado = array('nombre'        => Input::get('asegurado'),
                                'tipo_persona'  => Input::get('tipo_persona'),
                                'giro'          => Input::get('giro'),
                                );

        $siniestro = Siniestro::create($inputSiniestro);
        $siniestroId = $siniestro->id;
        $asegurado = Asegurado::create($inputAsegurado);
        $aseguradoId = $asegurado->id;
        DB::table('Siniestros')->where('id', $siniestroId)->update(array('id_asegurado' => $aseguradoId));
        return Redirect::back()->with('info', $info="Siniestro Agregado Correctamente");
    }

    public function tablero()
    {
        $siniestros = Siniestro::all();
        $siniestros_noresgistrados = TableroSiniestrosNoRegistrados::all();
        $dias_doc = 0;
        $avance_tiempo = 0;
        $casos_doc = 0;
        $casos_ajustador = 0;
        $dias_recl = 0;
        $nc1 = 0;
        $nc2 = 0;
        $nc3 = 0;
        $nc4 = 0;
        foreach ($siniestros as $siniestro) {

            if ($siniestro->tablero != Null) {
                if ($siniestro->tablero()->first()->solicitud_documentos != '0000-00-00 00:00:00') {
                    if ($siniestro->tablero()->first()->entrega_reclamacion_total != '0000-00-00 00:00:00') {
                        $dias_doc=$dias_doc+(new DateTime($siniestro->tablero()->first()->solicitud_documentos))->diff(new DateTime($siniestro->tablero()->first()->entrega_reclamacion_total))->format('%a');
                    }
                    else{
                        $dias_doc=$dias_doc+(new DateTime($siniestro->tablero()->first()->solicitud_documentos))->diff(new DateTime())->format('%a');
                    }
                    

                    if ($siniestro->tablero()->first()->entrega_reclamacion_total != '0000-00-00 00:00:00') {
                        if ((new DateTime($siniestro->tablero()->first()->solicitud_documentos))->diff(new DateTime($siniestro->tablero()->first()->entrega_reclamacion_total))->format('%a') <= 60) {
                            $casos_doc++;
                        }
                    }
                    else{
                        if ((new DateTime($siniestro->tablero()->first()->solicitud_documentos))->diff(new DateTime())->format('%a') <= 60) {
                            $casos_doc++;
                        }
                    }

                    $nc1 ++;

                }

                if ($siniestro->tablero()->first()->inicio_fase_ajustador != '0000-00-00 00:00:00') {
                    if ($siniestro->tablero()->first()->firma_convenio != '0000-00-00 00:00:00') {
                        if ((new DateTime($siniestro->tablero()->first()->inicio_fase_ajustador))->diff(new DateTime($siniestro->tablero()->first()->firma_convenio))->format('%a') <= 150) {
                            $casos_ajustador++;
                        }
                    }
                    else{
                        if ((new DateTime($siniestro->tablero()->first()->inicio_fase_ajustador))->diff(new DateTime())->format('%a') <= 150) {
                            $casos_ajustador++;
                        }
                    }
                    $nc2++;
                }

                if($siniestro->tablero()->first()->cierre_trato != '0000-00-00 00:00:00') {
                    if($siniestro->tablero()->first()->firma_convenio != '0000-00-00 00:00:00'){
                        $dias_recl = $dias_recl+(new DateTime($siniestro->tablero()->first()->cierre_trato))->diff(new DateTime($siniestro->tablero()->first()->firma_convenio))->format('%a');
                        $nc4 ++;
                    }
                    else{
                        $dias_recl = $dias_recl+(new DateTime($siniestro->tablero()->first()->cierre_trato))->diff(new DateTime())->format('%a');
                        $nc4 ++;
                    }
                }
            }

            if (count($siniestro->documentos()->get()) > 0) {
                $avance_tiempo = $avance_tiempo + (100/count($siniestro->documentos()->get()))*count($siniestro->documentos()->wherePivot('entregado', 'OK')->get());
                $nc3++;
            }
        }


        $nc1!=0 ? $dias_prom_doc = $dias_doc/$nc1 : $dias_prom_doc=0;
        $nc4!=0 ? $dias_prom_recl = $dias_recl/$nc4 : $dias_prom_recl=0;
        $nc3!=0 ? $porc_avance_tiempo = $avance_tiempo/$nc3 : $porc_avance_tiempo = 0;
        $nc1!=0 ? $porc_casos_doc_tiempo = (100/$nc1)*$casos_doc : $porc_casos_doc_tiempo = 0;
        $nc2!=0 ? $porc_casos_aju_tiempo = (100/$nc2)*$casos_ajustador : $porc_casos_aju_tiempo = 0;


        return View::make('reclamacion.tablero', array('siniestros'                 => $siniestros,
                                                        'siniestros_noresgistrados' => $siniestros_noresgistrados,
                                                        'dias_prom_doc'             => $dias_prom_doc,
                                                        'dias_prom_recl'            => $dias_prom_recl,
                                                        'porc_avance_tiempo'        => $porc_avance_tiempo,
                                                        'porc_casos_doc_tiempo'     => $porc_casos_doc_tiempo,
                                                        'porc_casos_aju_tiempo'     => $porc_casos_aju_tiempo));
    }


    public function verSiniestro($id)
    {
    	$siniestro = Siniestro::find($id);
    	$estados = Estados::all();
        $giros_empresas = GirosEmpresas::all();
        $tipos_siniestros = TiposSiniestros::all();
        $tipos_personas = TiposPersonas::all();
        $sexos = Sexos::all();
        $caracteres_asegurado = CaracteresAsegurado::all();
        $ramos_polizas = RamosPolizas::all();
        $monedas = Monedas::all();
        $coberturas = Coberturas::all();
        $perdidas_consecuenciales = PerdidasConsecuenciales::all();
        $clausulas_especiales = ClausulasEspeciales::all();
        $usuarios = usuario::all();
        $ejecutivos = usuario::where('departamento', 'Reclamacion')->orWhere('departamento', 'Direccion')->get();
        
        return View::make('reclamacion.ver', array(	'estados' 					=> $estados, 
	                                                'giros_empresas' 			=> $giros_empresas, 
	                                                'tipos_siniestros' 			=> $tipos_siniestros,
	                                                'tipos_personas' 			=> $tipos_personas,
	                                                'sexos' 					=> $sexos,
	                                                'siniestro' 				=> $siniestro,
	                                                'caracteres_asegurado'		=> $caracteres_asegurado,
	                                                'ramos_polizas'				=> $ramos_polizas,
	                                                'monedas' 					=> $monedas,
	                                                'coberturas' 				=> $coberturas,
	                                                'perdidas_consecuenciales' 	=> $perdidas_consecuenciales,
	                                                'clausulas_especiales' 		=> $clausulas_especiales,
	                                                'usuarios'					=> $usuarios,
	                                                'ejecutivos' 				=> $ejecutivos
                                                ));
    }

    public function busquedaSiniestro($id){
        if(Request::ajax()){
            $siniestro = Siniestro::find($id);
            if (isset($siniestro)) {
                return Response::json(array('success' =>true, 'siniestro' => $siniestro));
            }
            else{
                return Response::json(array('success' =>false));
            } 
        }
    }

    public function busquedaAsegurado($id){
        if(Request::ajax()){
            $asegurado = Asegurado::find($id);
            if (isset($asegurado)) {
                return Response::json(array('success' =>true, 'asegurado' => $asegurado));
            }
            else{
                return Response::json(array('success' =>false));
            } 
        }
    }
    public function busquedaApoderados(){
        if(Request::ajax()){
            $apoderados = ApoderadoLegal::all();
            if (isset($apoderados)) {
                return Response::json(array('success' =>true, 'apoderados' => $apoderados));
            }
            else{
                return Response::json(array('success' =>false));
            } 
        }
    }

    public function busquedaApoderado($id){
        if(Request::ajax()){
            $apoderado = ApoderadoLegal::find($id);
            if (isset($apoderado)) {
                return Response::json(array('success' =>true, 'apoderado' => $apoderado));
            }
            else{
                return Response::json(array('success' =>false));
            } 
        }
    }

    public function busquedaContactos(){
        if(Request::ajax()){
            $contactos = Contacto::all();
            if (isset($contactos)) {
                return Response::json(array('success' =>true, 'contactos' => $contactos));
            }
            else{
                return Response::json(array('success' =>false));
            } 
        }
    }

    public function busquedaContacto($id){
        if(Request::ajax()){
            $contacto = Contacto::find($id);
            if (isset($contacto)) {
                return Response::json(array('success' =>true, 'contacto' => $contacto));
            }
            else{
                return Response::json(array('success' =>false));
            } 
        }
    }

    public function busquedaActaConstitutiva($id){
        if(Request::ajax()){
            $acta_constitutiva = ActaConstitutiva::find($id);
            if (isset($acta_constitutiva)) {
                return Response::json(array('success' =>true, 'acta_constitutiva' => $acta_constitutiva));
            }
            else{
                return Response::json(array('success' =>false));
            } 
        }
    }

    public function busquedaAseguradoras(){
        if(Request::ajax()){
            $aseguradoras = Aseguradora::all();
            if (isset($aseguradoras)) {
                return Response::json(array('success' =>true, 'aseguradoras' => $aseguradoras));
            }
            else{
                return Response::json(array('success' =>false));
            } 
        }
    }

    public function busquedaAgentesSeguros(){
        if(Request::ajax()){
            $agentes_seguros = AgentesSeguros::all();
            if (isset($agentes_seguros)) {
                return Response::json(array('success' =>true, 'agentes_seguros' => $agentes_seguros));
            }
            else{
                return Response::json(array('success' =>false));
            } 
        }
    }

    public function busquedaAseguradora($id){
        if(Request::ajax()){
            $aseguradora = Aseguradora::find($id);
            if (isset($aseguradora)) {
                return Response::json(array('success' =>true, 'aseguradora' => $aseguradora));
            }
            else{
                return Response::json(array('success' =>false));
            } 
        }
    }

    public function busquedaDirectorSiniestros($id){
        if(Request::ajax()){
            $director_siniestros = DirectorSiniestros::find($id);
            if (isset($director_siniestros)) {
                return Response::json(array('success' =>true, 'director_siniestros' => $director_siniestros));
            }
            else{
                return Response::json(array('success' =>false));
            } 
        }
    }

    public function busquedaGerenciaSiniestros($id){
        if(Request::ajax()){
            $gerencia_siniestros = GerenciaSiniestros::find($id);
            if (isset($gerencia_siniestros)) {
                return Response::json(array('success' =>true, 'gerencia_siniestros' => $gerencia_siniestros));
            }
            else{
                return Response::json(array('success' =>false));
            } 
        }
    }

    public function busquedaAgenteSeguro($id){
        if(Request::ajax()){
            $agente_seguro = AgentesSeguros::find($id);
            if (isset($agente_seguro)) {
                return Response::json(array('success' =>true, 'agente_seguro' => $agente_seguro));
            }
            else{
                return Response::json(array('success' =>false));
            } 
        }
    }

    public function busquedaAjustadora($id){
        if(Request::ajax()){
            $ajustadora = Ajustadora::find($id);
            if (isset($ajustadora)) {
                return Response::json(array('success' =>true, 'ajustadora' => $ajustadora));
            }
            else{
                return Response::json(array('success' =>false));
            } 
        }
    }

    public function busquedaAjustadoras(){
        if(Request::ajax()){
            $ajustadoras = Ajustadora::all();
            if (isset($ajustadoras)) {
                return Response::json(array('success' =>true, 'ajustadoras' => $ajustadoras));
            }
            else{
                return Response::json(array('success' =>false));
            } 
        }
    }

    public function busquedaDirectorDespacho($id){
        if(Request::ajax()){
            $director_despacho = DirectorDespacho::find($id);
            if (isset($director_despacho)) {
                return Response::json(array('success' =>true, 'director_despacho' => $director_despacho));
            }
            else{
                return Response::json(array('success' =>false));
            } 
        }
    }

    public function busquedaAjustadores(){
        if(Request::ajax()){
            $ajustadores = Ajustadores::all();
            if (isset($ajustadores)) {
                return Response::json(array('success' =>true, 'ajustadores' => $ajustadores));
            }
            else{
                return Response::json(array('success' =>false));
            } 
        }
    }

    public function busquedaAjustador($id){
        if(Request::ajax()){
            $ajustador = Ajustadores::find($id);
            if (isset($ajustador)) {
                return Response::json(array('success' =>true, 'ajustador' => $ajustador));
            }
            else{
                return Response::json(array('success' =>false));
            } 
        }
    }

    public function busquedaAveriguacion($id){
        if(Request::ajax()){
            $averiguacion = AveriguacionPrevia::find($id);
            if (isset($averiguacion)) {
                return Response::json(array('success' =>true, 'averiguacion' => $averiguacion));
            }
            else{
                return Response::json(array('success' =>false));
            } 
        }
    }

    public function busquedaPoliza($id){
        if(Request::ajax()){
            $poliza = Poliza::find($id);
            if (isset($poliza)) {
                return Response::json(array('success' =>true, 'poliza' => $poliza));
            }
            else{
                return Response::json(array('success' =>false));
            } 
        }
    }

    public function busquedaTablero($id){
        if(Request::ajax()){
            $siniestro = Siniestro::find($id);
            $tablero = $siniestro->tablero()->first();
            if (isset($tablero)) {
                return Response::json(array('success' =>true, 'tablero' => $tablero));
            }
            else{
                return Response::json(array('success' =>false));
            } 
        }
    }

    public function busquedaSinTablero($id){
        if(Request::ajax()){
            $tablero = TableroSiniestrosNoRegistrados::find($id);
            if (isset($tablero)) {
                return Response::json(array('success' =>true, 'tablero' => $tablero));
            }
            else{
                return Response::json(array('success' =>false));
            } 
        }
    }




    public function actualizarSiniestro()
    {
    	$id = Input::get('id');
    	$date = str_replace ('/' , '-' , Input::get('fecha'));
        $fecha = new DateTime($date);
        $input = array(
            'fecha'				=> $fecha,
            'num_siniestro'		=> Input::get('num_siniestro'),
            'tipo_siniestro'	=> Input::get('tipo_siniestro'),
            'domicilio'			=> Input::get('domicilio'),
            'estado'			=> Input::get('estado'),
            'ciudad'			=> Input::get('ciudad'),
            'codigo_postal'		=> Input::get('codigo_postal')
            );
        $siniestro = Siniestro::find($id);
        $siniestro->fill($input);
        $siniestro->save();
        return Redirect::back()->with('info', $info="Siniestro Actualizado Correctamente");
    }

    public function actualizarAsegurado()
    {
    	$id = Input::get('id');
        $asegurado = Asegurado::find($id);
        $input = Input::all();
        $asegurado->fill($input);
        $asegurado->save();
        //return Redirect::back()->with('info', $info="Asegurado Actualizado Correctamente");
        return Redirect::back()->with('info', $info="Asegurado Actualizado Correctamente")->with('tabName', $tabName="asegurado");
    }

    public function agregarApoderado()
    {
    	$id_asegurado = Input::get('id_asegurado');
		$input = Input::all();
        $apoderado = ApoderadoLegal::create($input);
        $apoderadoId = $apoderado->id;
        $asegurado = Asegurado::find($id_asegurado);
        $asegurado->id_apoderado_legal = $apoderadoId;
        $asegurado->save();
        return Redirect::back()->with('info', $info="Apoderado Agregado Correctamente")->with('tabName', $tabName="asegurado");
    }

    public function seleccionarApoderado()
    {
    	$id_asegurado = Input::get('id_asegurado');
    	$id_apoderado_legal = Input::get('id_apoderado_legal');
        $asegurado = Asegurado::find($id_asegurado);
        $asegurado->id_apoderado_legal = $id_apoderado_legal;
        $asegurado->save();
        return Redirect::back()->with('info', $info="Apoderado Agregado Correctamente")->with('tabName', $tabName="asegurado");
    }

    public function actualizarApoderado()
    {
    	$id = Input::get('id_apoderado_legal');
        $apoderado = ApoderadoLegal::find($id);
        $input = Input::all();
        $apoderado->fill($input);
        $apoderado->save();
        //return Redirect::back()->with('info', $info="Asegurado Actualizado Correctamente");
        return Redirect::back()->with('info', $info="Apoderado Actualizado Correctamente")->with('tabName', $tabName="asegurado");
    }

    public function agregarContacto()
    {
    	$id_asegurado = Input::get('id_asegurado');
		$input = Input::all();
        $contacto = Contacto::create($input);
        $contactoId = $contacto->id;
        $asegurado = Asegurado::find($id_asegurado);
        $asegurado->id_contacto = $contactoId;
        $asegurado->save();
        return Redirect::back()->with('info', $info="Contacto Agregado Correctamente")->with('tabName', $tabName="asegurado");
    }

    public function seleccionarContacto()
    {
    	$id_asegurado = Input::get('id_asegurado');
    	$id_contacto = Input::get('id_contacto');
        $asegurado = Asegurado::find($id_asegurado);
        $asegurado->id_contacto = $id_contacto;
        $asegurado->save();
        return Redirect::back()->with('info', $info="Contacto Agregado Correctamente")->with('tabName', $tabName="asegurado");
    }

    public function actualizarContacto()
    {
    	$id = Input::get('id_contacto');
        $contacto = Contacto::find($id);
        $input = Input::all();
        $contacto->fill($input);
        $contacto->save();
        return Redirect::back()->with('info', $info="Contacto Actualizado Correctamente")->with('tabName', $tabName="asegurado");
    }



///////////////////////////////////////

    public function agregarActaConstitutiva()
    {
    	$date = str_replace ('/' , '-' , Input::get('fecha'));
        $fecha = new DateTime($date);
        $id_asegurado = Input::get('id_asegurado');
        $escritura_publica = Input::get('escritura_publica');
        $notario_publico = Input::get('notario_publico');
        $objeto = Input::get('objeto');
        $administrador = Input::get('administrador');

        $input = array(
        	'id_asegurado'		=> $id_asegurado,
            'escritura_publica'	=> $escritura_publica,
            'fecha'				=> $fecha,
            'notario_publico'	=> $notario_publico,
            'objeto'			=> $objeto,
            'administrador'		=> $administrador
            );

        ActaConstitutiva::create($input);
        return Redirect::back()->with('info', $info="Acta Constitutiva Agregada Correctamente")->with('tabName', $tabName="asegurado");
    }

	public function actualizarActaConstitutiva()
    {
    	$id = Input::get('id_acta_constitutiva');
    	$fecha = new DateTime(str_replace ('/' , '-' , Input::get('fecha')));
    	$escritura_publica = Input::get('escritura_publica');
        $notario_publico = Input::get('notario_publico');
        $objeto = Input::get('objeto');
        $administrador = Input::get('administrador');

        $input = array(
            'escritura_publica'	=> $escritura_publica,
            'fecha'				=> $fecha,
            'notario_publico'	=> $notario_publico,
            'objeto'			=> $objeto,
            'administrador'		=> $administrador
            );

        $acta = ActaConstitutiva::find($id);
        $acta->fill($input);
        $acta->save();
        return Redirect::back()->with('info', $info="Acta Constitutiva Actualizada Correctamente")->with('tabName', $tabName="asegurado");
    }

    public function agregarLogo()
    {

        $id_siniestro = Input::get('id_siniestro');
        $siniestro=Siniestro::find($id_siniestro);
        $ruta = 'siniestros/'.$id_siniestro;
        
        if (Input::hasFile('logo')) {
        	if (($siniestro->asegurado->logo != Null || $siniestro->asegurado->logo != "") && File::exists($siniestro->asegurado->logo)) {
	        	File::delete($siniestro->asegurado->logo);
	        }

        	$extension = Input::file('logo')->getClientOriginalExtension();
        	$nombre = 'logo.'.$extension;
        	$logo=$ruta.'/'.$nombre;
        	if (File::isDirectory($ruta)) {
        		Input::file('logo')->move($ruta, $nombre);
        		$asegurado = Asegurado::find($siniestro->id_asegurado);
        		$asegurado->logo = $logo;
        		$asegurado->save();
        		return Redirect::back()->with('info', $info="Logo Agregado Correctamente")->with('tabName', $tabName="asegurado");
        	}
        	else{
        		File::makeDirectory($ruta, 0777, true);
        		Input::file('logo')->move($ruta, $nombre);
        		$asegurado = Asegurado::find($siniestro->id_asegurado);
        		$asegurado->logo = $logo;
        		$asegurado->save();
        		return Redirect::back()->with('info', $info="Logo Agregado Correctamente")->with('tabName', $tabName="asegurado");
        	}	
        }  
    }

    public function agregarCaracter()
    {
        $id_asegurado = Input::get('id_asegurado');
        $arreglo_caracteres = Input::get('checkcaracter');
        $num = count($arreglo_caracteres);
        if ($num != 0) {
        	$asegurado = Asegurado::find($id_asegurado);

            for ($n=0; $n < $num ; $n++) {
                $asegurado->caracteres()->attach($arreglo_caracteres[$n]);
            }
            return Redirect::back()->with('info', $info="Caracteres Agregados Correctamente")->with('tabName', $tabName="asegurado");
        }
        else{
            return Redirect::back()->with('info', $info="Error al asignar caracteres")->with('tabName', $tabName="asegurado");
        }
    }

    public function actualizarCaracter()
    {
        $id_asegurado = Input::get('id_asegurado');
        $arreglo_caracteres = Input::get('checkcaracter');
        $num = count($arreglo_caracteres);
        if ($num > 0) {
        	$asegurado = Asegurado::find($id_asegurado);
        	$asegurado->caracteres()->sync($arreglo_caracteres);

            return Redirect::back()->with('info', $info="Caracteres Agregados Correctamente")->with('tabName', $tabName="asegurado");
        }
        else{
            return Redirect::back()->with('info', $info="Error al asignar caracteres")->with('tabName', $tabName="asegurado");
        }
    }

    public function agregarEjecutivoAsignado()
    {
        $id_siniestro = Input::get('id_siniestro');
        $arreglo_ejecutivos = Input::get('checkejecutivo');
        $num = count($arreglo_ejecutivos);
        if ($num != 0) {
        	$siniestro = Siniestro::find($id_siniestro);

            for ($n=0; $n < $num ; $n++) {
                $siniestro->ejecutivo_asignado()->attach($arreglo_ejecutivos[$n]);
            }
            return Redirect::back()->with('info', $info="Ejecutivos Agregados Correctamente")->with('tabName', $tabName="siniestro");
        }
        else{
            return Redirect::back()->with('info', $info="Error al asignar caracteres")->with('tabName', $tabName="siniestro");
        }
    }

    public function actualizarEjecutivoAsignado()
    {
        $id_siniestro = Input::get('id_siniestro');
        $arreglo_ejecutivos = Input::get('checkejecutivo');
        $num = count($arreglo_ejecutivos);
        if ($num != 0) {
        	$siniestro = Siniestro::find($id_siniestro);
        	$siniestro->ejecutivo_asignado()->sync($arreglo_ejecutivos);

            return Redirect::back()->with('info', $info="Ejecutivos Agregados Correctamente")->with('tabName', $tabName="siniestro");
        }
        else{
            return Redirect::back()->with('info', $info="Error al asignar caracteres")->with('tabName', $tabName="siniestro");
        }
    }

    public function agregarAseguradora()
    {
    	$id_siniestro = Input::get('id_siniestro');

        $input = array(
        	'nombre'		=> Input::get('nombre'),
            'domicilio'		=> Input::get('domicilio'),
            'estado'		=> Input::get('estado'),
            'ciudad'		=> Input::get('ciudad'),
            'codigo_postal'	=> Input::get('codigo_postal'),
            'telefono'		=> Input::get('telefono'),
            'fax'			=> Input::get('fax'),
            'email'			=> Input::get('email')
            );

        $aseguradora = Aseguradora::create($input);
        $id_aseguradora = $aseguradora->id;
        $siniestro = Siniestro::find($id_siniestro);
        $siniestro->id_aseguradora = $id_aseguradora;
        $siniestro->save();
        return Redirect::back()->with('info', $info="Aseguradora Agregada Correctamente")->with('tabName', $tabName="aseguradora");
    }

    public function actualizarAseguradora()
    {
    	$id_aseguradora = Input::get('id_aseguradora');
        $aseguradora = Aseguradora::find($id_aseguradora);
       	$aseguradora->fill(Input::all());
       	$aseguradora->save();
        return Redirect::back()->with('info', $info="Aseguradora Actualizada Correctamente")->with('tabName', $tabName="aseguradora");
    }

    public function agregarDirectorSiniestros()
    {
        DirectorSiniestros::create(Input::all());
        return Redirect::back()->with('info', $info="Director de Siniestros Agregado Correctamente")->with('tabName', $tabName="aseguradora");
    }

    public function agregarGerenciaSiniestros()
    {
        GerenciaSiniestros::create(Input::all());
        return Redirect::back()->with('info', $info="Gerencia de Siniestros Agregada Correctamente")->with('tabName', $tabName="aseguradora");
    }

    public function actualizarDirectorSiniestros()
    {
        $id = Aseguradora::find(Input::get('id_aseguradora'))->director_siniestros()->first()->id;
        $director_siniestros = DirectorSiniestros::find($id);
       	$director_siniestros->fill(Input::all());
       	$director_siniestros->save();
        return Redirect::back()->with('info', $info="Director de Siniestros Actualizado Correctamente")->with('tabName', $tabName="aseguradora");
    }

    public function actualizarGerenciaSiniestros()
    {
    	$id = Aseguradora::find(Input::get('id_aseguradora'))->gerencia_siniestros()->first()->id;
        $gerencia_siniestros = GerenciaSiniestros::find($id);
       	$gerencia_siniestros->fill(Input::all());
       	$gerencia_siniestros->save();
        return Redirect::back()->with('info', $info="Gerencia Siniestros Actualizada Correctamente")->with('tabName', $tabName="aseguradora");
    }

    public function agregarAgenteSeguros()
    {
        $agente_seguros = AgentesSeguros::create(Input::all());
        $id_agente = $agente_seguros->id;
        $id_aseguradora = Input::get('id_aseguradora');
        $input = array('id_agente' => $id_agente,
        				'id_aseguradora' => $id_aseguradora 
        				);
        $agente_seguros_siniestro = AgenteSeguroSiniestro::create($input);
        $id_agente_seguros = $agente_seguros_siniestro->id;
        $siniestro = Siniestro::find(Input::get('id_siniestro'));
        $siniestro->id_agente_seguros = $id_agente_seguros;
        $siniestro->save();

        return Redirect::back()->with('info', $info="Agente de Seguros Agreado Correctamente")->with('tabName', $tabName="aseguradora");
    }

    public function actualizarAgenteSeguros()
    {
    	$id = Input::get('id');
        $agente_seguros = AgentesSeguros::find($id);
       	$agente_seguros->fill(Input::all());
       	$agente_seguros->save();
        return Redirect::back()->with('info', $info="Agente de Seguros Actualizado Correctamente")->with('tabName', $tabName="aseguradora");
    }

    public function seleccionarAseguradora()
    {
    	$id_siniestro= Input::get('id_siniestro');
    	$id_aseguradora = Input::get('id_aseguradora');
        $siniestro = Siniestro::find($id_siniestro);
        $siniestro->id_aseguradora = $id_aseguradora;
        $siniestro->save();
        return Redirect::back()->with('info', $info="Aseguradora Agregada Correctamente")->with('tabName', $tabName="aseguradora");
    }

    public function seleccionarAgenteSeguros()
    {
    	$id_aseguradora = Input::get('id_aseguradora');
    	$id_siniestro = Input::get('id_siniestro');
    	$id_agente = Input::get('id_agente_seguros');

    	$a = AgenteSeguroSiniestro::where('id_agente', $id_agente)->where('id_aseguradora', $id_aseguradora)->first();
    	if (isset($a)) {
    		$id_agente_seguros = $a->id;
    		$siniestro = Siniestro::find($id_siniestro);
	        $siniestro->id_agente_seguros = $id_agente_seguros;
	        $siniestro->save();
    	}
    	else{
	        $input = array('id_agente' => $id_agente,
	        				'id_aseguradora' => $id_aseguradora 
	        				);
	        $agente_seguros_siniestro = AgenteSeguroSiniestro::create($input);
	        $id_agente_seguros = $agente_seguros_siniestro->id;
	        $siniestro = Siniestro::find($id_siniestro);
	        $siniestro->id_agente_seguros = $id_agente_seguros;
	        $siniestro->save();
    	}

        return Redirect::back()->with('info', $info="Agente de Seguros Agregado Correctamente")->with('tabName', $tabName="aseguradora");
    }

    public function agregarAjustadora()
    {
    	$id_siniestro = Input::get('id_siniestro');

        $input = array(
        	'nombre'		=> Input::get('nombre'),
            'domicilio'		=> Input::get('domicilio'),
            'estado'		=> Input::get('estado'),
            'ciudad'		=> Input::get('ciudad'),
            'codigo_postal'	=> Input::get('codigo_postal')
            );

        $ajustadora = Ajustadora::create($input);
        $id_ajustadora = $ajustadora->id;
        $siniestro = Siniestro::find($id_siniestro);
        $siniestro->id_ajustadora = $id_ajustadora;
        $siniestro->save();
        return Redirect::back()->with('info', $info="Empresa Ajustadora Agregada Correctamente")->with('tabName', $tabName="ajustadora");
    }

    public function actualizarAjustadora()
    {
    	$id_ajustadora = Input::get('id_ajustadora');
        $ajustadora = Ajustadora::find($id_ajustadora);
       	$ajustadora->fill(Input::all());
       	$ajustadora->save();
        return Redirect::back()->with('info', $info="Ajustadora Actualizada Correctamente")->with('tabName', $tabName="ajustadora");
    }

    public function agregarDirectorDespacho()
    {
        DirectorDespacho::create(Input::all());
        return Redirect::back()->with('info', $info="Director de Despacho Agregado Correctamente")->with('tabName', $tabName="ajustadora");
    }

    public function actualizarDirectorDespacho()
    {
        $id = Ajustadora::find(Input::get('id_ajustadora'))->director_despacho()->first()->id;
        $director_despacho = DirectorDespacho::find($id);
       	$director_despacho->fill(Input::all());
       	$director_despacho->save();
        return Redirect::back()->with('info', $info="Director de Despacho Actualizado Correctamente")->with('tabName', $tabName="ajustadora");
    }

    ///////////

    public function agregarAjustador()
    {
        $ajustador = Ajustadores::create(Input::all());
        $id_ajustador = $ajustador->id;
        $id_ajustadora = Input::get('id_ajustadora');
        $input = array('id_ajustador' => $id_ajustador,
        				'id_ajustadora' => $id_ajustadora 
        				);
        $ajustador_designado = AjustadorDesignado::create($input);
        $id_ajustador_designado = $ajustador_designado->id;
        $siniestro = Siniestro::find(Input::get('id_siniestro'));
        $siniestro->id_ajustador_designado = $id_ajustador_designado;
        $siniestro->save();

        return Redirect::back()->with('info', $info="Ajustador Designado Agreado Correctamente")->with('tabName', $tabName="ajustadora");
    }

    public function actualizarAjustador()
    {
    	$id = Input::get('id');
        $ajustador = Ajustadores::find($id);
       	$ajustador->fill(Input::all());
       	$ajustador->save();
        return Redirect::back()->with('info', $info="Ajustador Actualizado Correctamente")->with('tabName', $tabName="ajustadora");
    }

    public function seleccionarAjustadora()
    {
    	$id_siniestro= Input::get('id_siniestro');
    	$id_ajustadora = Input::get('id_ajustadora');
        $siniestro = Siniestro::find($id_siniestro);
        $siniestro->id_ajustadora = $id_ajustadora;
        $siniestro->save();
        return Redirect::back()->with('info', $info="Ajustadora Agregada Correctamente")->with('tabName', $tabName="ajustadora");
    }

    public function seleccionarAjustador()
    {
    	$id_ajustadora = Input::get('id_ajustadora');
    	$id_siniestro = Input::get('id_siniestro');
    	$id_ajustador = Input::get('id_ajustador');

    	$a = AjustadorDesignado::where('id_ajustador', $id_ajustador)->where('id_ajustadora', $id_ajustadora)->first();
    	if (isset($a)) {
    		$id_ajustador_designado = $a->id;
    		$siniestro = Siniestro::find($id_siniestro);
	        $siniestro->id_ajustador_designado = $id_ajustador_designado;
	        $siniestro->save();
    	}
    	else{
	        $input = array('id_ajustador' => $id_ajustador,
	        				'id_ajustadora' => $id_ajustadora 
	        				);
	        $ajustador_designado = AjustadorDesignado::create($input);
	        $id_ajustador_designado = $ajustador_designado->id;
	        $siniestro = Siniestro::find($id_siniestro);
	        $siniestro->id_ajustador_designado = $id_ajustador_designado;
	        $siniestro->save();
    	}

        return Redirect::back()->with('info', $info="Ajustador Designado Agregado Correctamente")->with('tabName', $tabName="ajustadora");
    }

    public function agregarAveriguacion()
    {
    	$id_siniestro = Input::get('id_siniestro');

        $input = array(
        	'num_averiguacion'		=> Input::get('num_averiguacion'),
            'dependencia_judicial'	=> Input::get('dependencia_judicial'),
            'titular_dependencia'	=> Input::get('titular_dependencia')
            );

        $averiguacion = AveriguacionPrevia::create($input);
        $id_averiguacion_previa = $averiguacion->id;
        $siniestro = Siniestro::find($id_siniestro);
        $siniestro->id_averiguacion_previa = $id_averiguacion_previa;
        $siniestro->save();
        return Redirect::back()->with('info', $info="Averiguacion Previa Agregada Correctamente")->with('tabName', $tabName="averiguacion");
    }

    public function actualizarAveriguacion()
    {
    	$id_averiguacion = Input::get('id_averiguacion');
        $averiguacion = AveriguacionPrevia::find($id_averiguacion);
       	$averiguacion->fill(Input::all());
       	$averiguacion->save();
        return Redirect::back()->with('info', $info="Averiguacion Previa Actualizada Correctamente")->with('tabName', $tabName="averiguacion");
    }

    public function agregarPoliza()
    {
    	$id_siniestro = Input::get('id_siniestro');
    	$fecha_expedicion = new DateTime(str_replace ('/' , '-' , Input::get('fecha_expedicion')));
    	$inicio_vigencia = new DateTime(str_replace ('/' , '-' , Input::get('inicio_vigencia')));
    	$fin_vigencia = new DateTime(str_replace ('/' , '-' , Input::get('fin_vigencia')));

        $input = array(
        	'num_poliza'		=> Input::get('num_poliza'),
            'ramo_poliza'		=> Input::get('ramo_poliza'),
            'fecha_expedicion'	=> $fecha_expedicion,
            'inicio_vigencia'	=> $inicio_vigencia,
            'fin_vigencia'		=> $fin_vigencia,
            'tipo_moneda'		=> Input::get('tipo_moneda')
            );

        $poliza = Poliza::create($input);
        $id_poliza = $poliza->id;
        $siniestro = Siniestro::find($id_siniestro);
        $siniestro->id_poliza = $id_poliza;
        $siniestro->save();
        return Redirect::back()->with('info', $info="Poliza Agregada Correctamente")->with('tabName', $tabName="poliza");
    }

    public function actualizarPoliza()
    {
    	$id_poliza = Input::get('id_poliza');
    	$fecha_expedicion = new DateTime(str_replace ('/' , '-' , Input::get('fecha_expedicion')));
    	$inicio_vigencia = new DateTime(str_replace ('/' , '-' , Input::get('inicio_vigencia')));
    	$fin_vigencia = new DateTime(str_replace ('/' , '-' , Input::get('fin_vigencia')));

        $input = array(
        	'num_poliza'		=> Input::get('num_poliza'),
            'ramo_poliza'		=> Input::get('ramo_poliza'),
            'fecha_expedicion'	=> $fecha_expedicion,
            'inicio_vigencia'	=> $inicio_vigencia,
            'fin_vigencia'		=> $fin_vigencia,
            'tipo_moneda'		=> Input::get('tipo_moneda')
            );
        $poliza = Poliza::find($id_poliza);
       	$poliza->fill($input);
       	$poliza->save();
        return Redirect::back()->with('info', $info="Poliza Actualizada Correctamente")->with('tabName', $tabName="poliza");
    }

    public function agregarMedidasSeguridad()
    {
        MedidasSeguridad::create(Input::all());
        return Redirect::back()->with('info', $info="Medidas de Seguridad Agregadas Correctamente")->with('tabName', $tabName="poliza");
    }

    public function agregarEndososConvenios()
    {
        EndososConvenios::create(Input::all());
        return Redirect::back()->with('info', $info="Endosos/Convenios Agregados Correctamente")->with('tabName', $tabName="poliza");
    }

    public function agregarLimitacionVR()
    {
        LimitacionValorReposicion::create(Input::all());
        return Redirect::back()->with('info', $info="Limitacion de Valor Reposicion Agregada Correctamente")->with('tabName', $tabName="poliza");
    }

    public function actualizarLimitacionVR()
    {
        $limitacion = LimitacionValorReposicion::find(Input::get('id'));
        $limitacion->limitacion = Input::get('limitacion');
        $limitacion->save();
        return Redirect::back()->with('info', $info="Limitacion de Valor Reposicion Actualizada Correctamente")->with('tabName', $tabName="poliza");
    }

    public function agregarCoberturas()
    {

        $id_poliza = Input::get('id_poliza');
        $arreglo_coberturas = Input::get('checkcobertura');
        $num = count($arreglo_coberturas);
        if ($num != 0) {
        	$poliza = Poliza::find($id_poliza);

            for ($n=0; $n < $num ; $n++) {
                $poliza->coberturas()->attach($arreglo_coberturas[$n]);
            }
            return Redirect::back()->with('info', $info="Coberturas Agregados Correctamente")->with('tabName', $tabName="poliza");
        }
        else{
            return Redirect::back()->with('info', $info="Error ")->with('tabName', $tabName="poliza");
        }
    }

    public function actualizarCoberturas()
    {

        $id_poliza = Input::get('id_poliza');
        $arreglo_coberturas = Input::get('checkcobertura');
        $num = count($arreglo_coberturas);
        if ($num != 0) {
        	$poliza = Poliza::find($id_poliza);
            $poliza->coberturas()->sync($arreglo_coberturas);
            return Redirect::back()->with('info', $info="Coberturas Actualizadas Correctamente")->with('tabName', $tabName="poliza");
        }
        else{
            return Redirect::back()->with('info', $info="Error ")->with('tabName', $tabName="poliza");
        }
    }

    public function actualizarDatosCoberturas()
    {

        $id_poliza 			= Input::get('id_poliza');
        $id_cobertura 		= Input::get('id_cobertura');
        $suma_asegurada 	= Input::get('suma_asegurada');
        $valor_declarado 	= Input::get('valor_declarado');
        $deducible 			= Input::get('deducible');
        $coaseguro 			= Input::get('coaseguro');
        $num = count($id_cobertura);
        if ($num > 0) {
        	$poliza = Poliza::find($id_poliza);
            for ($n=0; $n < $num ; $n++) {
                $poliza->coberturas()->updateExistingPivot($id_cobertura[$n], array('suma_asegurada' => $suma_asegurada[$n],
                																	'valor_declarado' => $valor_declarado[$n],
                																	'deducible' => $deducible[$n],
                																	'coaseguro' => $coaseguro[$n]));
            }
            return Redirect::back()->with('info', $info="Coberturas Actualizadas Correctamente")->with('tabName', $tabName="poliza");
        }
        else{
            return Redirect::back()->with('info', $info="Error ")->with('tabName', $tabName="poliza");
        }
    }

    public function agregarPerdidasConsecuenciales()
    {

        $id_poliza = Input::get('id_poliza');
        $arreglo_perdidas = Input::get('checkperdidas');
        $num = count($arreglo_perdidas);
        if ($num != 0) {
        	$poliza = Poliza::find($id_poliza);

            for ($n=0; $n < $num ; $n++) {
                $poliza->perdidas_consecuenciales()->attach($arreglo_perdidas[$n]);
            }
            return Redirect::back()->with('info', $info="Perdidas Consecuenciales Agregados Correctamente")->with('tabName', $tabName="poliza");
        }
        else{
            return Redirect::back()->with('info', $info="Error ")->with('tabName', $tabName="poliza");
        }
    }

    public function actualizarPerdidasConsecuenciales()
    {

        $id_poliza = Input::get('id_poliza');
        $arreglo_perdidas = Input::get('checkperdidas');
        $num = count($arreglo_perdidas);
        if ($num != 0) {
        	$poliza = Poliza::find($id_poliza);
            $poliza->perdidas_consecuenciales()->sync($arreglo_perdidas);
            return Redirect::back()->with('info', $info="Perdidas Consecuenciales Actualizadas Correctamente")->with('tabName', $tabName="poliza");
        }
        else{
            return Redirect::back()->with('info', $info="Error ")->with('tabName', $tabName="poliza");
        }
    }

    public function actualizarIndemnizacionPerdidasConsecuenciales()
    {

        $id_poliza 				= Input::get('id_poliza');
        $id_perdida 			= Input::get('id_perdida');
        $periodo_indemnizacion 	= Input::get('periodo_indemnizacion');
        $num = count($id_perdida);
        if ($num != 0) {
        	$poliza = Poliza::find($id_poliza);
            for ($n=0; $n < $num ; $n++) {
                $poliza->perdidas_consecuenciales()->updateExistingPivot($id_perdida[$n], array('periodo_indemnizacion' => $periodo_indemnizacion[$n]));
            }
            return Redirect::back()->with('info', $info="Perdidas Consecuenciales Actualizadas Correctamente")->with('tabName', $tabName="poliza");
        }
        else{
            return Redirect::back()->with('info', $info="Error ")->with('tabName', $tabName="poliza");
        }
    }

    public function agregarClausulasEspeciales()
    {

        $id_poliza = Input::get('id_poliza');
        $arreglo_clausulas = Input::get('checkclausulas');
        $num = count($arreglo_clausulas);
        if ($num != 0) {
        	$poliza = Poliza::find($id_poliza);

            for ($n=0; $n < $num ; $n++) {
                $poliza->clausulas_especiales()->attach($arreglo_clausulas[$n]);
            }
            return Redirect::back()->with('info', $info="Clausulas Agregados Correctamente")->with('tabName', $tabName="poliza");
        }
        else{
            return Redirect::back()->with('info', $info="Error ")->with('tabName', $tabName="poliza");
        }
    }

    public function actualizarClausulasEspeciales()
    {

        $id_poliza = Input::get('id_poliza');
        $arreglo_clausulas = Input::get('checkclausulas');
        $num = count($arreglo_clausulas);
        if ($num != 0) {
        	$poliza = Poliza::find($id_poliza);
            $poliza->clausulas_especiales()->sync($arreglo_clausulas);
            return Redirect::back()->with('info', $info="Clausulas Agregados Correctamente")->with('tabName', $tabName="poliza");
        }
        else{
            return Redirect::back()->with('info', $info="Error ")->with('tabName', $tabName="poliza");
        }
    }

    public function agregarDocumentacion()
    {
        $id_siniestro = Input::get('id_siniestro');
        $arreglo_clasificacion = Input::get('checkclasificacion');
        $num = count($arreglo_clasificacion);
        if ($num != 0) {
        	$siniestro = Siniestro::find($id_siniestro);

            for ($n=0; $n < $num ; $n++) {
                $siniestro->clasificacion_documentos()->attach($arreglo_clasificacion[$n]);
            }
            foreach ($siniestro->clasificacion_documentos()->get() as $cla) {
            	foreach ($cla->documentos()->get() as $c) {
            		$siniestro->documentos()->attach($c->id);
            	}
            }
            return Redirect::back()->with('info', $info="Documentacion Agregado Correctamente")->with('tabName', $tabName="documentacion");
        }
        else{
            return Redirect::back()->with('info', $info="Error ")->with('tabName', $tabName="documentacion");
        }
    }

    public function agregarComentarioBitacora()
    {
        Bitacora::create(Input::all());
        return Redirect::back()->with('info', $info="Comentario Agregado Correctamente")->with('tabName', $tabName="bitacora");
    }

    public function agregarDocumento()
    {

        $id_siniestro = Input::get('id_siniestro');
        $id_documento = Input::get('id_documento');
        $siniestro=Siniestro::find($id_siniestro);
        $documento = DocumentosSiniestros::where('id_siniestro', $id_siniestro)->where('id_documento', $id_documento)->first();
        $ruta = 'siniestros/'.$id_siniestro;
        
        if (Input::hasFile('documento')) {
        	if (($documento->entregado != Null || $documento->archivo != "") && File::exists($documento->archivo)) {
	        	File::delete($documento->archivo);
	        }

        	$extension = Input::file('documento')->getClientOriginalExtension();
        	$nombre = 'documento'.$id_documento.'.'.$extension;
        	$doc=$ruta.'/'.$nombre;
        	if (File::isDirectory($ruta)) {
        		Input::file('documento')->move($ruta, $nombre);
        		$siniestro->documentos()->updateExistingPivot($id_documento, array('entregado' => 'OK', 'archivo'=> $doc));
        		return Redirect::back()->with('info', $info="Documento Agregado Correctamente")->with('tabName', $tabName="cronograma");
        	}
        	else{
        		File::makeDirectory($ruta, 0777, true);
        		Input::file('documento')->move($ruta, $nombre);
        		$siniestro->documentos()->updateExistingPivot($id_documento, array('entregado' => 'OK', 'archivo'=> $doc));
        		return Redirect::back()->with('info', $info="Documento Agregado Correctamente")->with('tabName', $tabName="cronograma");
        	}	
        }  
    }

    public function actualizarInformacionDocumentos()
    {

        $id_siniestro 	= Input::get('id_siniestro');
        $id_documento 	= Input::get('id_documento');
        $id_responsable = Input::get('id_responsable');
        $observaciones 	= Input::get('observaciones');
        $fecha_entrega 	= Input::get('fecha_entrega');
        $num = count($id_documento);
        if ($num != 0) {
        	$siniestro = Siniestro::find($id_siniestro);
            for ($n=0; $n < $num ; $n++) {
            	$user = Usuario::find($id_responsable[$n]);
            	if ($user) {
            		$nombre_responsable = $user->nombre ." ". $user->apellido;
            	}
            	else{
            		$nombre_responsable = null;
            		}
            	if ($fecha_entrega[$n] != null) {
            		$fecha = date_create(str_replace ('/' , '-' , $fecha_entrega[$n]));
            	}
            	else{
            		$fecha = NULL;
            		}
                $siniestro->documentos()->updateExistingPivot($id_documento[$n], array('id_responsable' 		=> $id_responsable[$n], 
                																		'nombre_responsable' 	=> $nombre_responsable,
                																		'fecha_entrega' 		=> $fecha, 
                																		'observaciones' 		=> $observaciones[$n]));
            }
            return Redirect::back()->with('info', $info="Informacion actualizada correctamente")->with('tabName', $tabName="cronograma");
        }
        else{
            return Redirect::back()->with('info', $info="Error ")->with('tabName', $tabName="cronograma");
        }
    }

    public function agregarResponsable()
    {
    	$id_siniestro = Input::get('id_siniestro');
		$input = Input::all();
		$input['password'] = Hash::make($input['password']);
        $usuario = usuario::create($input);
        $id_usuario = $usuario->id;
        $siniestro = Siniestro::find($id_siniestro);
        $siniestro->responsable()->attach($id_usuario);
        return Redirect::back()->with('info', $info="Responsable Agregado Correctamente")->with('tabName', $tabName="cronograma");
    }

    public function actualizarTablero()
    {
        $id_siniestro                   = Input::get('id');
        $cierre_trato                   = Input::get('cierre_trato');
        $firma_contrato                 = Input::get('firma_contrato');
        $entrega_cartas                 = Input::get('entrega_cartas');
        $solicitud_documentos           = Input::get('solicitud_documentos');
        $elaboracion_cronograma         = Input::get('elaboracion_cronograma');
        $entrega_reclamacion_parcial    = Input::get('entrega_reclamacion_parcial');
        $entrega_reclamacion_total      = Input::get('entrega_reclamacion_total');
        $inicio_fase_ajustador          = Input::get('inicio_fase_ajustador');
        $firma_convenio                 = Input::get('firma_convenio');

        $input = array(
            'id_siniestro'                  => $id_siniestro,
            'cierre_trato'                  => $cierre_trato,
            'firma_contrato'                => $firma_contrato,
            'entrega_cartas'                => $entrega_cartas,
            'solicitud_documentos'          => $solicitud_documentos,
            'elaboracion_cronograma'        => $elaboracion_cronograma,
            'entrega_reclamacion_parcial'   => $entrega_reclamacion_parcial,
            'entrega_reclamacion_total'     => $entrega_reclamacion_total,
            'inicio_fase_ajustador'         => $inicio_fase_ajustador,
            'firma_convenio'                => $firma_convenio
            );

        $siniestro = Siniestro::find($id_siniestro);

        if ($siniestro->tablero != Null) {
            $tablero = TableroFechas::where('id_siniestro', $id_siniestro)->update(array(
                'cierre_trato'                  => $cierre_trato,
                'firma_contrato'                => $firma_contrato,
                'entrega_cartas'                => $entrega_cartas,
                'solicitud_documentos'          => $solicitud_documentos,
                'elaboracion_cronograma'        => $elaboracion_cronograma,
                'entrega_reclamacion_parcial'   => $entrega_reclamacion_parcial,
                'entrega_reclamacion_total'     => $entrega_reclamacion_total,
                'inicio_fase_ajustador'         => $inicio_fase_ajustador,
                'firma_convenio'                => $firma_convenio
                ));
        }
        else{
            TableroFechas::create($input);
        }

        return Redirect::back()->with('info', $info="Informacion actualizada correctamente");
    }

    public function agregarSinTablero()
    {
        $asegurado                      = Input::get('asegurado');
        $ejecutivo                      = Input::get('ejecutivo');
        $cierre_trato                   = Input::get('cierre_trato');
        $firma_contrato                 = Input::get('firma_contrato');
        $entrega_cartas                 = Input::get('entrega_cartas');
        $solicitud_documentos           = Input::get('solicitud_documentos');
        $elaboracion_cronograma         = Input::get('elaboracion_cronograma');
        $doc_totales                    = Input::get('doc_totales');
        $doc_recabados                  = Input::get('doc_recabados');
        $entrega_reclamacion_parcial    = Input::get('entrega_reclamacion_parcial');
        $entrega_reclamacion_total      = Input::get('entrega_reclamacion_total');
        $inicio_fase_ajustador          = Input::get('entrega_reclamacion_total');
        $bitacora                       = Input::get('bitacora');
        $firma_convenio                 = Input::get('firma_convenio');

        $input = array(
            'asegurado'                     => $asegurado,
            'ejecutivo'                     => $ejecutivo,
            'cierre_trato'                  => $cierre_trato,
            'firma_contrato'                => $firma_contrato,
            'entrega_cartas'                => $entrega_cartas,
            'solicitud_documentos'          => $solicitud_documentos,
            'elaboracion_cronograma'        => $elaboracion_cronograma,
            'doc_totales'                   => $doc_totales,
            'doc_recabados'                 => $doc_recabados,
            'entrega_reclamacion_parcial'   => $entrega_reclamacion_parcial,
            'entrega_reclamacion_total'     => $entrega_reclamacion_total,
            'inicio_fase_ajustador'         => $inicio_fase_ajustador,
            'bitacora'                      => $bitacora,
            'firma_convenio'                => $firma_convenio
            );


        TableroSiniestrosNoRegistrados::create($input);


        return Redirect::back()->with('info', $info="Informacion actualizada correctamente");
    }

    public function actualizarSinTablero()
    {
        $id                             = Input::get('id');
        $asegurado                      = Input::get('asegurado');
        $ejecutivo                      = Input::get('ejecutivo');
        $cierre_trato                   = Input::get('cierre_trato');
        $firma_contrato                 = Input::get('firma_contrato');
        $entrega_cartas                 = Input::get('entrega_cartas');
        $solicitud_documentos           = Input::get('solicitud_documentos');
        $elaboracion_cronograma         = Input::get('elaboracion_cronograma');
        $doc_totales                    = Input::get('doc_totales');
        $doc_recabados                  = Input::get('doc_recabados');
        $entrega_reclamacion_parcial    = Input::get('entrega_reclamacion_parcial');
        $entrega_reclamacion_total      = Input::get('entrega_reclamacion_total');
        $inicio_fase_ajustador          = Input::get('entrega_reclamacion_total');
        $bitacora                       = Input::get('bitacora');
        $firma_convenio                 = Input::get('firma_convenio');

        $tablero = TableroSiniestrosNoRegistrados::where('id', $id)->update(array(
            'asegurado'                     => $asegurado,
            'ejecutivo'                     => $ejecutivo,
            'cierre_trato'                  => $cierre_trato,
            'firma_contrato'                => $firma_contrato,
            'entrega_cartas'                => $entrega_cartas,
            'solicitud_documentos'          => $solicitud_documentos,
            'elaboracion_cronograma'        => $elaboracion_cronograma,
            'doc_totales'                   => $doc_totales,
            'doc_recabados'                 => $doc_recabados,
            'entrega_reclamacion_parcial'   => $entrega_reclamacion_parcial,
            'entrega_reclamacion_total'     => $entrega_reclamacion_total,
            'inicio_fase_ajustador'         => $inicio_fase_ajustador,
            'bitacora'                      => $bitacora,
            'firma_convenio'                => $firma_convenio
            ));


        return Redirect::back()->with('info', $info="Informacion actualizada correctamente");
    }

}
?>