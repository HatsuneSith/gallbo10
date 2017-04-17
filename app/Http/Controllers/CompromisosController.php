<?php namespace App\Http\Controllers;
use View;
use Auth;
use DB;
use DateTime;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use App\Models\compromiso;
use App\Models\responsable;
use App\Models\Validator;
use App\Models\usuario;
use App\Models\Tarea;

class CompromisosController extends Controller {




    public function inicio()
    {

        $asig = DB::table('asignacion')->where('id_coordinador', Auth::user()->id)->lists('id_personal', 'id_personal');
        $users = DB::table('usuarios')->orderBy('nombre', 'Asc')->get();

        $asignados = array();
        foreach ($users as $user) {
            if (isset($asig[$user->id])) {
                $asignados[] = $user;
            }
        }

        $usuarios = DB::table('usuarios')->where('rol', '=', 'Coordinador')->orWhere('rol', '=', 'Directivo')->orderBy('nombre', 'Asc')->get();


        $now = new DateTime();
        $mes_actual = $now->format('m');
        $año_actual = $now->format('Y');

        $responsable = Input::get('responsable');

        //$compromisos=Compromiso::where('responsable', Auth::user()->id)->get();
        $compromisos=compromiso::respond($responsable)->orderBy('fecha', 'Desc')->paginate(25);

        
        return View::make('compromisos.inicio', array('compromisos' => $compromisos, 'asignados' => $asignados, 'usuarios' => $usuarios, 'responsable' => $responsable,'mes_actual' => $mes_actual, 'año_actual' => $año_actual));

    }

    public function crear()
    {
        $now = new DateTime();
        $hoy = $now->format('Y-m-d H:i:s');

        $reglas =  array(
        'responsable'  => 'required',
        'compromiso'  => 'required',
        'dia' => 'required',
        'mes' => 'required',
        'año' => 'required'
        );

        $validator = Validator::make(Input::all(), $reglas);

        $fecha = Input::get('año'). '-' .Input::get('mes') . '-' . Input::get('dia') .' ' . '22:00:00';
        $fecha_actual = strtotime($hoy);
        $fecha_entrada = strtotime($fecha);

        if ( $validator->fails() ){
            return Redirect::to('sire/compromisos')
                    ->with('danger', $danger="Error al guardar, Verifique que todos los campos fueron llenados correctamente")
                    ->withErrors($validator)// Aquí se esta devolviendo a la vista los errores
                    ->withInput();// Aquí se esta devolviendo a la vista todos los datos del formulario
        }
        elseif (!checkdate(Input::get('mes'), Input::get('dia'), Input::get('año'))) {
            return Redirect::to('sire/compromisos')->with('danger', $danger="Error al guardar, La fecha es invalida")->withInput();
        }
        elseif ($fecha_actual > $fecha_entrada) {
            return Redirect::to('sire/compromisos')->with('danger', $danger="Error al guardar, La fecha ingresada ya ha pasado")->withInput();
        }
        else{
            
            $fecha = Input::get('año'). '-' .Input::get('mes') . '-' . Input::get('dia');            
            $datos = array(
                'compromiso' => Input::get('compromiso'),
                'responsable' => Input::get('responsable'),
                'fecha' => $fecha,
                'cumplido' => Input::get('cumplido'),
                );

            $compromiso = compromiso::create($datos);
            $insertedId = $compromiso->id;

            Session::put('lastCompromisoID', $insertedId);



            $usuario = usuario::find(Input::get('responsable'));
            $email = $usuario->email;
            $nombre = $usuario->nombre;
            $apellido = $usuario->apellido;
            $nombre_responsable = $nombre . ' '.$apellido;

            $data = array('compromiso' => Input::get('compromiso'),
                        'nombre_responsable' => $nombre_responsable,
                );

            Mail::queue('emails.nuevocompromiso',$data,function($message)use($email)
                    {
                        $message->to($email)->cc('tareas.lmartinez@gallbo.com');
                        $message->subject('Tienes un nuevo compromiso');
                    });
            $responsable = Session::get('responsable');


            return Redirect::route('compromisos', array('responsable' => $responsable))->with('infoCompromiso', $infoTarea="Compromiso Agregado correctamente");
        }
    }

    public function crearTarea()
    {
        $now = new DateTime();
        $hoy = $now->format('Y-m-d H:i:s');

        $reglas =  array(
        'id_responsable' => 'required',
        'tarea'  => 'required',
        'dia' => 'required',
        'mes' => 'required',
        'año' => 'required'
        );

        $validator = Validator::make(Input::all(), $reglas);

        $fecha = Input::get('año'). '-' .Input::get('mes') . '-' . Input::get('dia') .' ' . '22:00:00';
        $fecha_actual = strtotime($hoy);
        $fecha_entrada = strtotime($fecha);

        if ( $validator->fails() ){
            return Redirect::to('sire/compromisos')
                    ->with('danger', $danger="Error al guardar, Verifique que todos los campos fueron llenados correctamente")
                    ->withErrors($validator)// Aquí se esta devolviendo a la vista los errores
                    ->withInput();// Aquí se esta devolviendo a la vista todos los datos del formulario
        }
        elseif (!checkdate(Input::get('mes'), Input::get('dia'), Input::get('año'))) {
            return Redirect::to('sire/compromisos')->with('danger', $danger="Error al guardar, La fecha es invalida")->withInput();
        }
        elseif ($fecha_actual > $fecha_entrada) {
            return Redirect::to('sire/compromisos')->with('danger', $danger="Error al guardar, La fecha ingresada ya ha pasado")->withInput();
        }
        else{

            $id_compromiso = Input::get('id_compromiso');
            $compromiso = compromiso::find($id_compromiso);
            $id_responsable = Input::get('id_responsable');
            $usuario = usuario::find($id_responsable);
            $email = $usuario->email;
            $nombre = $usuario->nombre;
            $apellido = $usuario->apellido;
            $nombre_responsable = $nombre . ' '.$apellido;

            $fecha = Input::get('año'). '-' .Input::get('mes') . '-' . Input::get('dia') .' ' . '22:00:00';
            $datos_tarea = array(
                'id_compromiso' => Input::get('id_compromiso'),
                'tarea' => Input::get('tarea'),
                'objetivo' => "Cumplir con compromiso " . $compromiso->compromiso,
                'fecha' => $fecha,
                'estado' => Input::get('estado'),
                'indicador' => Input::get('indicador'),
                'id_responsable' => Input::get('id_responsable'),
                'nombre_responsable' => $nombre_responsable,
                'id_asignador' => Input::get('id_asignador'),
                'nombre_asignador' => Input::get('nombre_asignador'),
                );

            $tarea= Tarea::create($datos_tarea);
            $insertedId = $tarea->id;

            $compr = compromiso::find($id_compromiso);
            if ($compr->cumplido == 'Si') {
                $actualizar = DB::table('compromisos')->where('id', $id_compromiso)->update(array('cumplido' => 'No', 'fecha_cumplimiento' => '0000-00-00 00:00:00'));
            }

            $data = array(
                'descripcion' => Input::get('tarea'),
                'objetivo' => "Complir con compromiso " . $compromiso->compromiso,
                'nombre_responsable' => $nombre_responsable,
                'id' => $insertedId
                );

            Mail::queue('emails.nuevatarea',$data,function($message)use($email)
                    {
                        $message->to($email);
                        $message->subject('Tienes una nueva tarea');
                    });

            Session::put('lastCompromisoID', Input::get('id_compromiso'));
            $responsable = Session::get('responsable');
            return Redirect::route('compromisos', array('responsable' => $responsable))->with('infoTarea', $infoTarea="Tarea Agregada correctamente");

        }
    }

    public function reportes()
    {
        return View::make('compromisos.reportes');
    }

    public function listaTareas($id){
        if(Request::ajax()){
            $tareas = DB::table('tareas')->where('id_compromiso', '=', $id)->get();
            return Response::json(array('success' =>true, 'tareas' => $tareas));
        }
    }

    public function editarBusqueda($id){
        if(Request::ajax()){
            $compr = compromiso::find($id);
            $compromiso = $compr->compromiso;
            return Response::json(array('success' =>true, 'compromiso' => $compromiso));
        }
    }

    public function editar()
    {

        $id = Input::get('id_compromiso');
        $compromiso = Input::get('compromiso');
        $compr = compromiso::find($id);
        $compr->compromiso = $compromiso;
        $compr->save();
        $responsable = Session::get('responsable');
        return Redirect::route('compromisos', array('responsable' => $responsable))->with('infoEditado', $infoEditado="Compromiso editado correctamente");
    }

    public function reportesAjax(){
        if(Request::ajax()){

            $fecha_de =Input::get('fecha_de');
            $date = Input::get('fecha_hasta');
            $fechahasta = new DateTime($date);
            $fecha_hasta = $fechahasta -> add(new DateInterval('PT24H'));

            $departamento =Input::get('departamento');

            //checar esto 

            if ($departamento != NULL) {

                $compromisos = DB::table('compromisos')
                                    ->join('usuarios', function($join)
                                    {
                                        $join->on('compromisos.responsable', '=', 'usuarios.id');         
                                    })
                                    ->where(function($query) use ($fecha_de, $fecha_hasta, $departamento) {
                                        $query->whereBetween('compromisos.fecha', array($fecha_de, $fecha_hasta))
                                                ->where('usuarios.departamento', '=', $departamento);
                                    })
                                    ->orWhere(function($queryy) use ($fecha_de, $departamento) {
                                        $queryy->where('compromisos.fecha', '<', $fecha_de)
                                                ->where('usuarios.departamento', '=', $departamento)
                                                ->where('compromisos.cumplido', '=', 'No');
                                    })
                                    ->orWhere(function($queryyy) use ($fecha_de, $fecha_hasta, $departamento) {
                                        $queryyy->where('compromisos.fecha', '<', $fecha_de)
                                                ->where('usuarios.departamento', '=', $departamento)
                                                ->where('compromisos.cumplido', '=', 'Si')
                                                ->whereBetween('compromisos.fecha_cumplimiento', array($fecha_de, $fecha_hasta));
                                    })
                                    ->select('compromisos.id', 'compromisos.compromiso', 'usuarios.nombre', 'usuarios.apellido', 'compromisos.fecha', 'compromisos.cumplido', 'compromisos.fecha_cumplimiento', 'usuarios.departamento')
                                    ->get();

                $compromisos_total = count($compromisos);

                /*$compromisos_cumplidos = DB::table('compromisos')
                                    ->join('usuarios', function($join)
                                    {
                                        $join->on('compromisos.responsable', '=', 'usuarios.id');
                                                
                                    })
                                    ->where(function($query) use ($fecha_de, $fecha_hasta, $departamento) {
                                        $query->whereBetween('compromisos.fecha', array($fecha_de, $fecha_hasta))
                                                ->where('usuarios.departamento', '=', $departamento)
                                                ->where('compromisos.cumplido', '=', 'Si');
                                    })
                                    ->orWhere(function($queryyy) use ($fecha_de, $fecha_hasta, $departamento) {
                                        $queryyy->where('compromisos.fecha', '<', $fecha_de)
                                                ->where('usuarios.departamento', '=', $departamento)
                                                ->where('compromisos.cumplido', '=', 'Si')
                                                ->whereBetween('compromisos.fecha_cumplimiento', array($fecha_de, $fecha_hasta));
                                    })
                                    ->count();*/

                

                /*$compromisos_nocumplidos = DB::table('compromisos')
                                    ->join('usuarios', function($join)
                                    {
                                        $join->on('compromisos.responsable', '=', 'usuarios.id');
                                                
                                    })
                                    ->where(function($query) use ($fecha_de, $fecha_hasta, $departamento) {
                                        $query->whereBetween('compromisos.fecha', array($fecha_de, $fecha_hasta))
                                                ->where('usuarios.departamento', '=', $departamento)
                                                ->where('compromisos.cumplido', '=', 'No');
                                    })
                                    ->where(function($queryy) use ($fecha_de, $departamento) {
                                        $queryy->where('compromisos.fecha', '<', $fecha_de)
                                                ->where('usuarios.departamento', '=', $departamento)
                                                ->where('compromisos.cumplido', '=', 'No');
                                    })
                                    ->count();*/
                                    
                $compromisos_cumplidos = 0;
                $compromisos_nocumplidos = 0;
                foreach ($compromisos as $compromiso) {
                    if ($compromiso->cumplido == 'Si') {
                        $compromisos_cumplidos ++;
                    }
                    else if ($compromiso->cumplido == 'No') {
                        $compromisos_nocumplidos ++;
                    }
                }

            }
            else{
                $compromisos = DB::table('compromisos')
                                    ->join('usuarios', function($join)
                                    {
                                        $join->on('compromisos.responsable', '=', 'usuarios.id');       
                                    })
                                    ->where(function($query) use ($fecha_de, $fecha_hasta) {
                                        $query->whereBetween('compromisos.fecha', array($fecha_de, $fecha_hasta));
                                    })
                                    ->orWhere(function($queryy) use ($fecha_de) {
                                        $queryy->where('compromisos.fecha', '<', $fecha_de)
                                                ->where('compromisos.cumplido', '=', 'No');
                                    })
                                    ->orWhere(function($queryyy) use ($fecha_de, $fecha_hasta) {
                                        $queryyy->where('compromisos.fecha', '<', $fecha_de)
                                                ->where('compromisos.cumplido', '=', 'Si')
                                                ->whereBetween('compromisos.fecha_cumplimiento', array($fecha_de, $fecha_hasta));
                                    })
                                    ->select('compromisos.id', 'compromisos.compromiso', 'usuarios.nombre', 'usuarios.apellido', 'compromisos.fecha', 'compromisos.cumplido', 'compromisos.fecha_cumplimiento', 'usuarios.departamento')
                                    ->get();

                $compromisos_total = count($compromisos);

                /*$compromisos_cumplidos = DB::table('compromisos')
                                    ->join('usuarios', function($join)
                                    {
                                        $join->on('compromisos.responsable', '=', 'usuarios.id');
                                                
                                    })
                                    ->where(function($query) use ($fecha_de, $fecha_hasta) {
                                        $query->whereBetween('compromisos.fecha', array($fecha_de, $fecha_hasta))
                                                ->where('compromisos.cumplido', '=', 'Si');
                                    })
                                    ->orWhere(function($queryyy) use ($fecha_de, $fecha_hasta) {
                                        $queryyy->where('compromisos.fecha', '<', $fecha_de)
                                                ->where('compromisos.cumplido', '=', 'Si')
                                                ->whereBetween('compromisos.fecha_cumplimiento', array($fecha_de, $fecha_hasta));
                                    })
                                    ->count();

                $compromisos_nocumplidos = DB::table('compromisos')
                                    ->join('usuarios', function($join)
                                    {
                                        $join->on('compromisos.responsable', '=', 'usuarios.id');
                                                
                                    })
                                    ->where(function($query) use ($fecha_de, $fecha_hasta) {
                                        $query->whereBetween('compromisos.fecha', array($fecha_de, $fecha_hasta))
                                                ->where('compromisos.cumplido', '=', 'No');
                                    })
                                    ->where(function($queryy) use ($fecha_de) {
                                        $queryy->where('compromisos.fecha', '<', $fecha_de)
                                                ->where('compromisos.cumplido', '=', 'No');
                                    })
                                    ->count();
                                    */

                $compromisos_cumplidos = 0;
                $compromisos_nocumplidos = 0;
                foreach ($compromisos as $compromiso) {
                    if ($compromiso->cumplido == 'Si') {
                        $compromisos_cumplidos ++;
                    }
                    else if ($compromiso->cumplido == 'No') {
                        $compromisos_nocumplidos ++;
                    }
                }
            }


            return Response::json(array('success' =>true, 'compromisos' => $compromisos, 'compromisos_total' => $compromisos_total, 'compromisos_cumplidos' => $compromisos_cumplidos, 'compromisos_nocumplidos' => $compromisos_nocumplidos));
        }
    }




}
?>