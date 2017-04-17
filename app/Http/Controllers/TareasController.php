<?php namespace App\Http\Controllers;
use View;
use Auth;
use DB;
use DateTime;
use Validator;
use Mail;
use DateInterval;
use Request;
use Response;
use PDF;
use App\Models\tarea;
use App\Models\usuario;
use App\Models\prorroga;
use App\Models\compromiso;
use App\Models\comentarioTarea;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;

class TareasController extends Controller {

    public function principal()
    {
        return View::make('tareas.principal');
    }

    public function listaTareas()
    {   
        $asignados      = DB::table('asignacion')->where('id_coordinador', Auth::user()->id)->lists('id_personal', 'id_personal');
        $id_responsable = Input::get('id_responsable');
        $estado         = Input::get('estado');
        $indicador      = Input::get('indicador');
        $users          = DB::table('usuarios')->orderBy('nombre', 'Asc')->get();

        $usuarios = array();
        foreach ($users as $user) {
            if (isset($asignados[$user->id])) {
                $usuarios[] = $user;
            }
        }

        $tareas = tarea::responsablex($id_responsable)->estado($estado, $indicador)->indicador($estado, $indicador)->orderBy('fecha', 'Asc')->paginate(25);
        return View::make('tareas.lista', array('tareas' => $tareas, 'usuarios' => $usuarios, 'id_responsable' => $id_responsable, 'estado' => $estado, 'indicador' => $indicador));
    }

    public function nuevaTarea()
    {
        $now        = new DateTime();
        $mes_actual = $now->format('m');
        $año_actual = $now->format('Y');
        $usuarios   = DB::table('usuarios')->orderBy('nombre', 'Asc')->get();
        $asignados  = DB::table('asignacion')->where('id_coordinador', Auth::user()->id)->lists('id_personal', 'id_personal');
 
        return View::make('tareas.crear', array('usuarios' => $usuarios, 'mes_actual' => $mes_actual, 'año_actual' => $año_actual, 'asignados' => $asignados));


    }

    public function crearTarea()
    {
        $now = new DateTime();
        $hoy = $now->format('Y-m-d H:i:s');

        if (Input::get('check_prog') === 'yes') {
            $reglas =  array(
            'tarea'             => 'required',
            'objetivo'          => 'required',
            'id_responsable'    => 'required',
            'dia'               => 'required',
            'mes'               => 'required',
            'año'               => 'required',
            'veces'             => 'required',
            'periodo'           => 'required'
            );
        }
        else{
            $reglas =  array(
            'tarea'             => 'required',
            'objetivo'          => 'required',
            'id_responsable'    => 'required',
            'dia'               => 'required',
            'mes'               => 'required',
            'año'               => 'required'
            /*'fecha' => array ('required', 'after:'.$hoy)*/
            );
        }

        $validator = Validator::make(Input::all(), $reglas);

        $fecha          = Input::get('año'). '-' .Input::get('mes') . '-' . Input::get('dia') .' ' . '22:00:00';
        $fecha_actual   = strtotime($hoy);
        $fecha_entrada  = strtotime($fecha);

        if ( $validator->fails() ){
            return Redirect::to('tareas/nueva')
                    ->with('danger', $danger="Error al guardar, Verifique que todos los campos fueron llenados correctamente")
                    ->withErrors($validator)
                    ->withInput();
        }
        elseif (!checkdate(Input::get('mes'), Input::get('dia'), Input::get('año'))) {
            return Redirect::to('tareas/nueva')->with('danger', $danger="Error al guardar, La fecha es invalida")->withInput();
        }
        elseif ($fecha_actual > $fecha_entrada) {
            return Redirect::to('tareas/nueva')->with('danger', $danger="Error al guardar, La fecha ingresada ya ha pasado")->withInput();
        }
        else{

            $id_responsable     = Input::get('id_responsable');
            $usuario            = usuario::find($id_responsable);
            $email              = $usuario->email;
            $nombre             = $usuario->nombre;
            $apellido           = $usuario->apellido;   
            $nombre_responsable = $nombre . ' '.$apellido;
            //$date = Input::get('fecha');
            //$fecha = new DateTime($date);
            //$fecha -> add(new DateInterval('PT22H'));
            $fecha = Input::get('año'). '-' .Input::get('mes') . '-' . Input::get('dia') .' ' . '22:00:00';
            $datos_tarea = array(
                'id_compromiso'         => 0,
                'tarea'                 => Input::get('tarea'),
                'objetivo'              => Input::get('objetivo'),
                'fecha'                 => $fecha,
                'estado'                => Input::get('estado'),
                'indicador'             => Input::get('indicador'),
                'id_responsable'        => Input::get('id_responsable'),
                'nombre_responsable'    => $nombre_responsable,
                'id_asignador'          => Input::get('id_asignador'),
                'nombre_asignador'      => Input::get('nombre_asignador'),
                );

            $tarea      = Tarea::create($datos_tarea);

            if (Input::get('id_asignador') != Input::get('id_responsable')) {
                $insertedId = $tarea->id;
                $data = array(
                    'descripcion'           => Input::get('tarea'),
                    'objetivo'              => Input::get('objetivo'),
                    'nombre_responsable'    => $nombre_responsable,
                    'id'                    => $insertedId
                    );

                Mail::queue('emails.nuevatarea',$data,function($message)use($email)
                        {
                            $message->to($email);
                            $message->subject('Tienes una nueva tarea');
                        });
            }
            

            if (Input::get('check_prog') === 'yes') {
                $datos_tareap = array(
                    'id_compromiso'         => 0,
                    'tarea'                 => Input::get('tarea'),
                    'objetivo'              => Input::get('objetivo'),
                    'estado'                => Input::get('estado'),
                    'indicador'             => Input::get('indicador'),
                    'id_responsable'        => Input::get('id_responsable'),
                    'nombre_responsable'    => $nombre_responsable,
                    'id_asignador'          => Input::get('id_asignador'),
                    'nombre_asignador'      => Input::get('nombre_asignador'),
                );

                $veces = Input::get('veces');
                $periodo = Input::get('periodo');
                $fecha = new DateTime($fecha);

                if ($periodo == 'Diario') {
                    for ($i=0; $i < $veces; $i++) { 
                        $fecha = $fecha->modify('+ 1 day');
                        $datos_tarea_pr = array_add($datos_tareap, 'fecha', $fecha);
                        $tarea      = Tarea::create($datos_tarea_pr);
                        //echo date_format($fecha, 'Y-m-d H:i:s');
                    }
                }
                elseif ($periodo == 'Semanal') {
                    for ($i=0; $i < $veces; $i++) { 
                        $fecha = $fecha->modify('+ 1 week');
                        $datos_tarea_pr = array_add($datos_tareap, 'fecha', $fecha);
                        $tarea      = Tarea::create($datos_tarea_pr);
                        //echo date_format($fecha, 'Y-m-d H:i:s');
                    }
                }
                elseif ($periodo == 'Quincenal') {
                    for ($i=0; $i < $veces; $i++) { 
                        if (date_format($fecha, 'd') == 15 && cal_days_in_month(CAL_GREGORIAN, date_format($fecha, 'm'), date_format($fecha, 'Y')) == 31 ) {
                            $fecha = $fecha->modify('+ 16 days');
                            $datos_tarea_pr = array_add($datos_tareap, 'fecha', $fecha);
                            $tarea      = Tarea::create($datos_tarea_pr);
                        }
                        else{
                            $fecha = $fecha->modify('+ 15 days');
                            $datos_tarea_pr = array_add($datos_tareap, 'fecha', $fecha);
                            $tarea      = Tarea::create($datos_tarea_pr);
                        }
                    }
                }
                elseif ($periodo == 'Mensual') {
                    for ($i=0; $i < $veces; $i++) { 
                        $fecha = $fecha->modify('+ 1 month');
                        $datos_tarea_pr = array_add($datos_tareap, 'fecha', $fecha);
                        $tarea      = Tarea::create($datos_tarea_pr);
                    }
                }
            }

            return Redirect::to('tareas/nueva')->with('info', $info="Tarea Agregada correctamente");
        }
    }

    

    public function crearProrroga()
    {
        $reglas =  array(
            'fecha_peticion'  => 'required',
        );

        $validator = Validator::make(Input::all(), $reglas);
        if ( $validator->fails() ){
            $input = Input::all();
            return Redirect::to("tareas/ver/{$input['id_tarea']}")
                    ->withErrors($validator)
                    ->withInput();
        }else{

            $input              = Input::all();
            $data_tarea         = tarea::find($input['id_tarea']);
            $id_responsable     = $data_tarea->id_responsable;
            $id_asignador       = $data_tarea->id_asignador;
            $tarea              = $data_tarea->tarea;
            $data_asignador     = usuario::find($id_asignador);
            $email_destinatario = $data_asignador->email;//destinatario
            $destinatario       = $data_asignador->nombre;//destinatario
            $remitente          = DB::table('usuarios')->where('id', $id_responsable)->pluck('nombre');//remitente
            $date               = Input::get('fecha_peticion');
            $fecha_peticion     = new DateTime($date);
            $fecha_peticion     -> add(new DateInterval('PT22H'));

            $prorroga = array(
                'id_tarea'          => Input::get('id_tarea'),
                'fecha_peticion'    => $fecha_peticion,
                'fecha_anterior'    => Input::get('fecha_anterior'),
                'estado'            => Input::get('estado')
                );

            /*$data = array(
                'fecha_peticion' => Input::get('fecha_peticion'),
                'id_tarea' => Input::get('id_tarea'),
                'tarea' => $tarea,
                'destinatario' => $destinatario,
                'remitente' => $remitente
                );
            
            Mail::queue('emails.nuevocomentario',$data,function($message)use($email_destinatario)
                    {
                        $message->to($email_destinatario);
                        $message->subject('Solicitud de cambio de fecha');
                    });*/

            Prorroga::create($prorroga);
            
            return Redirect::to("tareas/ver/{$input['id_tarea']}");
        }
    }

    public function tareaSinConcluir()
    {
        $id                 = Input::get('id_tarea');
        $tarea              = tarea::find($id);
        $descripcion        = $tarea->tarea;
        $fecha              = $tarea->fecha;
        $created_at         = $tarea->created_at;
        $id_responsable     = $tarea->id_responsable;
        $destinatario       = $tarea->nombre_responsable;
        $id_compromiso      = $tarea->id_compromiso;
        $email_destinatario = DB::table('usuarios')->where('id', $id_responsable)->pluck('email');
        $now                = new DateTime();
        $hoy                = $now->format('Y-m-d H:i:s'); //fecha de hoy
        $diferencia         = strtotime($fecha) - strtotime($created_at); //diferencia entre la fecha de creacion y le fecha limite
        $diferencia2        = strtotime($hoy) - strtotime($created_at); //Tiempo transcurrido entre la fecha de creacion y hoy

        //checar esto
        if ($id_compromiso != 0 ) {
            $compr = compromiso::find($id_compromiso);
            if ($compr->cumplido == 'Si') {
                $actualizar = DB::table('compromisos')->where('id', $id_compromiso)->update(array('cumplido' => 'No', 'fecha_cumplimiento' => '0000-00-00 00:00:00'));
            }
        }

        if($diferencia2 < ($diferencia/2)){
            $indicador  = "Amarillo";
            $estado     = "Tramite";

            $actualizar = DB::update('UPDATE tareas SET estado = ?, indicador = ? WHERE id = ? ', array( $estado, $indicador, $id));

            $data = array(
                'id'            => $id,
                'destinatario'  => $destinatario,
                'descripcion'   => $descripcion,
                'estado'        => $estado,
                'indicador'     => $indicador
            );
        
            Mail::queue('emails.tareasinconcluir',$data,function($message)use($email_destinatario)
            {
                $message->to($email_destinatario);
                $message->subject('Cambio de estado en tarea');
            });

            return Redirect::to("tareas/ver/{$id}");
            
        }
        if (($diferencia2 >= ($diferencia/2)) && ($diferencia2 < (($diferencia/100)*85))) {
            $indicador  = "Naranja";
            $estado     = "Tramite";
            $actualizar = DB::update('UPDATE tareas SET estado = ?, indicador = ? WHERE id = ? ', array( $estado, $indicador, $id));
            $data = array(
                'id'            => $id,
                'destinatario'  => $destinatario,
                'descripcion'   => $descripcion,
                'estado'        => $estado,
                'indicador'     => $indicador
            );
        
            Mail::queue('emails.tareasinconcluir',$data,function($message)use($email_destinatario)
            {
                $message->to($email_destinatario);
                $message->subject('Cambio de estado en tarea');
            });

            return Redirect::to("tareas/ver/{$id}");
            
        }
        if (($diferencia2 >= (($diferencia/100)*85)) && ($diferencia2 <= $diferencia)) {
            $indicador  = "Rojo";
            $estado     = "Tramite";
            $actualizar = DB::update('UPDATE tareas SET estado = ?, indicador = ? WHERE id = ? ', array( $estado, $indicador, $id));
            $data = array(
                'id'            => $id,
                'destinatario'  => $destinatario,
                'descripcion'   => $descripcion,
                'estado'        => $estado,
                'indicador'     => $indicador
            );
        
            Mail::queue('emails.tareasinconcluir',$data,function($message)use($email_destinatario)
            {
                $message->to($email_destinatario);
                $message->subject('Cambio de estado en tarea');
            });

            return Redirect::to("tareas/ver/{$id}");
            
        }
        if ($diferencia2 > $diferencia) {
            $indicador  = "Rojo";
            $estado     = "Vencido";
            $actualizar = DB::update('UPDATE tareas SET estado = ?, indicador = ? WHERE id = ? ', array( $estado, $indicador, $id));
            $data = array(
                'id'            => $id,
                'destinatario'  => $destinatario,
                'descripcion'   => $descripcion,
                'estado'        => $estado,
                'indicador'     => $indicador
            );
        
            Mail::queue('emails.tareasinconcluir',$data,function($message)use($email_destinatario)
            {
                $message->to($email_destinatario);
                $message->subject('Cambio de estado en tarea');
            });

            return Redirect::to("tareas/ver/{$id}");
            
        }

    }

    public function crearComentario()
    {
        $reglas =  array(
            'comentario'  => 'required',
        );

        $validator = Validator::make(Input::all(), $reglas);
        if ( $validator->fails() ){
            $input = Input::all();
            return Redirect::to("tareas/ver/{$input['id_tarea']}")
                    ->withErrors($validator)
                    ->withInput();
        }else{

            $input = Input::all();
            $data_tarea = tarea::find($input['id_tarea']);

            $id_responsable = $data_tarea->id_responsable;
            $id_asignador = $data_tarea->id_asignador;
            $tarea = $data_tarea->tarea;

            if ((Auth::user()->id == $id_responsable) &&  (Auth::user()->id == $id_asignador)) {
                # solo guardamos el comentario
                comentarioTarea::create($input);
                return Redirect::to("tareas/ver/{$input['id_tarea']}")->with('info', $info="Comentario agregado correctamente");
            }

            if (Auth::user()->id == $id_responsable) {
                # le enviamos el correo al asignador
                $data_asignador = usuario::find($id_asignador);
                $email_destinatario = $data_asignador->email;
                $destinatario = $data_asignador->nombre;
                $remitente = DB::table('usuarios')->where('id', $id_responsable)->pluck('nombre');//remitente

                $data = array(
                'comentario' => Input::get('comentario'),
                'id' => Input::get('id_tarea'),
                'tarea' => $tarea,
                'destinatario' => $destinatario,
                'remitente' => $remitente
                );

                comentarioTarea::create($input);
                Mail::queue('emails.nuevocomentario',$data,function($message)use($email_destinatario)
                        {
                            $message->to($email_destinatario);
                            $message->subject('Nuevo comentario en tarea');
                        });
                return Redirect::to("tareas/ver/{$input['id_tarea']}")->with('info', $info="Comentario agregado correctamente");
            }

            if (Auth::user()->id == $id_asignador) {
                # le enviamos el correo al responsable
                $data_responsable = usuario::find($id_responsable);
                $email_destinatario = $data_responsable->email;
                $destinatario = $data_responsable->nombre;
                $remitente = DB::table('usuarios')->where('id', $id_asignador)->pluck('nombre');//remitente

                $data = array(
                'comentario' => Input::get('comentario'),
                'id' => Input::get('id_tarea'),
                'tarea' => $tarea,
                'destinatario' => $destinatario,
                'remitente' => $remitente
                );

                comentarioTarea::create($input);
                Mail::queue('emails.nuevocomentario',$data,function($message)use($email_destinatario)
                        {
                            $message->to($email_destinatario);
                            $message->subject('Nuevo comentario en tarea');
                        });
                return Redirect::to("tareas/ver/{$input['id_tarea']}")->with('info', $info="Comentario agregado correctamente");
            }

            if ((Auth::user()->id != $id_responsable) &&  (Auth::user()->id != $id_asignador)) {
                # enviamos el correo al responsable y al asignador

                $email_destinatario = DB::table('usuarios')->where('id', $id_responsable)->pluck('email');//destinatario
                $email_cc = DB::table('usuarios')->where('id', $id_asignador)->pluck('email');//destinatario
                $destinatario = DB::table('usuarios')->where('id', $id_responsable)->pluck('nombre');//destinatario
                $remitente = DB::table('usuarios')->where('id', Auth::user()->id)->pluck('nombre');//remitente

                $data = array(
                'comentario' => Input::get('comentario'),
                'id' => Input::get('id_tarea'),
                'tarea' => $tarea,
                'destinatario' => $destinatario,
                'remitente' => $remitente
                );

                comentarioTarea::create($input);
                Mail::queue('emails.nuevocomentario',$data,function($message)use($email_destinatario, $email_cc)
                        {
                            $message->to($email_destinatario)->cc($email_cc);
                            $message->subject('Nuevo comentario en tarea');
                        });
                return Redirect::to("tareas/ver/{$input['id_tarea']}")->with('info', $info="Comentario agregado correctamente");
            }
        }

    }


    public function verTarea($id)
    {
            $tarea = tarea::find($id);
            $comentarios = DB::table('comentarios_tareas')->where('id_tarea', '=', $id)->get();
            $prorroga = DB::table('prorroga_fecha')->where('id_tarea', '=', $id)->where('estado', '=', 'Pendiente')->first();
            $estado = $tarea->estado;

            $ejecutivos = DB::table('usuarios')->where('departamento', Auth::user()->departamento)->lists('id', 'id');


            $id_responsable = DB::table('tareas')->where('id', $id)->pluck('id_responsable');

            if (($estado == 'Sin Ver') && (Auth::user()->id == $id_responsable)) {

                $actualizar = DB::update('UPDATE tareas SET estado = ? WHERE id = ? ', array( 'Tramite', $id));
                //$id_responsable = DB::table('tareas')->where('id', $id)->pluck('id_responsable');
                $id_asignador = DB::table('tareas')->where('id', $id)->pluck('id_asignador');
                $descripcion_tarea = DB::table('tareas')->where('id', $id)->pluck('tarea');
                $email_destinatario = DB::table('usuarios')->where('id', $id_asignador)->pluck('email');//destinatario
                $destinatario = DB::table('usuarios')->where('id', $id_asignador)->pluck('nombre');//destinatario
                $remitente = DB::table('usuarios')->where('id', $id_responsable)->pluck('nombre');//remitente

                if ($id_asignador != $id_responsable) {
                    $data = array(
                        'descripcion_tarea' => $descripcion_tarea,
                        'destinatario' => $destinatario,
                        'remitente' => $remitente
                        );

                    $subj = 'Tarea Vista por ' . $remitente;

                    Mail::queue('emails.tareavista',$data,function($message)use($email_destinatario, $subj)
                            {
                                $message->to($email_destinatario);
                                $message->subject($subj);
                            });
                }

                return View::make('tareas.ver', array('tarea' => $tarea, 'comentarios' => $comentarios, 'prorroga' => $prorroga, 'ejecutivos' => $ejecutivos));
            }
            return View::make('tareas.ver', array('tarea' => $tarea, 'comentarios' => $comentarios, 'prorroga' => $prorroga, 'ejecutivos' => $ejecutivos));
        
    }

    public function actualizarConcluida($id)
    {
            $now = new DateTime();
            $hoy = $now->format('Y-m-d H:i:s'); //fecha de hoy
            $data_tarea = tarea::find($id);
            $tarea = $data_tarea->tarea;
            $fecha = $data_tarea->fecha;
            $id_asignador = $data_tarea->id_asignador;
            $id_responsable = $data_tarea->id_responsable;
            $data_asignador = usuario::find($id_asignador);
            $email_destinatario = $data_asignador->email;
            $destinatario = $data_asignador->nombre;
            $remitente = DB::table('usuarios')->where('id', $id_responsable)->pluck('nombre');//remitente

            $data = array(
                    'tarea' => $tarea,
                    'destinatario' => $destinatario,
                    'remitente' => $remitente
                    );

            $subj = 'Tarea Concluida por ' . $remitente;

            if ($hoy > $fecha) {
                $actualizar = DB::update('UPDATE tareas SET estado = ?, indicador = ?, fecha_concluida = ? WHERE id = ? ', array( 'Concluida A Destiempo', 'Verde', $hoy,  $id));
            }
            else{
                $actualizar = DB::update('UPDATE tareas SET estado = ?, indicador = ?, fecha_concluida = ? WHERE id = ? ', array( 'Concluida A Tiempo', 'Verde', $hoy,  $id));
            }

            if ($id_asignador != $id_responsable) {
                Mail::queue('emails.tareaconcluida',$data,function($message)use($email_destinatario, $subj)
                {
                    $message->to($email_destinatario)->cc('tareas@gallbo.com');
                    $message->subject($subj);
                });
            }
            else{
                Mail::queue('emails.tareaconcluida',$data,function($message)use($email_destinatario, $subj)
                {
                    $message->to('tareas@gallbo.com');
                    $message->subject($subj);
                });
            }

            if ($data_tarea->id_compromiso != 0) {
                $nt = DB::table('tareas')->where('id_compromiso', '=', $data_tarea->id_compromiso)->where('indicador', '!=', 'verde')->count();
                if ($nt == 0) {
                    $actualizar = DB::update('UPDATE compromisos SET cumplido = ?, fecha_cumplimiento = ? WHERE id = ? ', array( 'Si', $hoy, $data_tarea->id_compromiso));
                }
            }

            return Response::json(array('success' =>true));
        
    }

    public function eliminarTarea($id)
    {
        if(Request::ajax()){
            $tarea = Tarea::find($id);
            $tarea->delete();
            return Response::json(array('success' =>true));
        }
        else{
            $tarea = Tarea::find($id);
            $tarea->delete();
            return Redirect::to('tareas/lista');
        }

        
    }

    public function editarTarea($id)
    {
        $tarea = tarea::find($id);
        return View::make('tareas.editar', array('tarea' => $tarea));
    }

    public function actualizarTarea($id)
    {
        $now = new DateTime();
        $hoy = $now->format('Y-m-d H:i:s');

        $reglas =  array(
        'dia' => 'required',
        'mes' => 'required',
        'año' => 'required'
        );

        $validator = Validator::make(Input::all(), $reglas);

        $fecha = Input::get('año'). '-' .Input::get('mes') . '-' . Input::get('dia') .' ' . '22:00:00';
        $fecha_actual = strtotime($hoy);
        $fecha_entrada = strtotime($fecha);

        if ( $validator->fails() ){
            return Redirect::to('tareas/editar/'.$id)
                    ->with('danger', $danger="Error al guardar, Verifique que todos los campos fueron llenados correctamente")
                    ->withErrors($validator)// Aquí se esta devolviendo a la vista los errores
                    ->withInput();// Aquí se esta devolviendo a la vista todos los datos del formulario
        }
        elseif (!checkdate(Input::get('mes'), Input::get('dia'), Input::get('año'))) {
            return Redirect::to('tareas/editar/'.$id)->with('danger', $danger="Error al guardar, La fecha es invalida")->withInput();
        }
        elseif ($fecha_actual > $fecha_entrada) {
            return Redirect::to('tareas/editar/'.$id)->with('danger', $danger="Error al guardar, La fecha ingresada ya ha pasado")->withInput();
        }
        else{
            $tarea = tarea::find($id);
            $tarea->fecha = $fecha;
            $tarea->save();
            return Redirect::to('tareas/editar/'.$id);
        }

    }

    public function editarTareaEG($id)
    {
        $tarea = tarea::find($id);
        return View::make('tareas.editar_eg', array('tarea' => $tarea));
    }

    public function actualizarTareaEG($id)
    {
        $reglas =  array(
        'dia' => 'required',
        'mes' => 'required',
        'año' => 'required'
        );
        $fecha_concluida = date_create(str_replace ('/' , '-' , Input::get('fecha_concluida')));
        $created_at = date_create(str_replace ('/' , '-' , Input::get('created_at')));

        $validator = Validator::make(Input::all(), $reglas);

        $fecha = Input::get('año'). '-' .Input::get('mes') . '-' . Input::get('dia') .' ' . '22:00:00';

        if ( $validator->fails() ){
            return Redirect::to('tareas/editar/'.$id)
                    ->with('danger', $danger="Error al guardar, Verifique que todos los campos fueron llenados correctamente")
                    ->withErrors($validator)// Aquí se esta devolviendo a la vista los errores
                    ->withInput();// Aquí se esta devolviendo a la vista todos los datos del formulario
        }
        elseif (!checkdate(Input::get('mes'), Input::get('dia'), Input::get('año'))) {
            return Redirect::to('tareas/editar/'.$id)->with('danger', $danger="Error al guardar, La fecha es invalida")->withInput();
        }
        else{
            DB::table('tareas')
                ->where('id', $id)
                ->update(array('fecha'              => $fecha,
                                'tarea'             => Input::get('tarea'),
                                'objetivo'          => Input::get('objetivo'),
                                'fecha_concluida'   => $fecha_concluida,
                                'created_at'        => $created_at,
                                'updated_at'         => $created_at));
            return Redirect::to('tareas/ver/'.$id);
        }
    }

    public function reportesInicio()
    {
        return View::make('tareas.reportes.inicio');
    }

    public function reportesUsuarios()
    {

        if (Auth::user()->rol == 'Directivo') {
            $usuarios = DB::table('usuarios')->orderBy('nombre', 'Asc')->get();
            return View::make('tareas.reportes.usuarios', array('usuarios' => $usuarios));
        }
        if ((Auth::user()->rol == "Coordinador") && (Auth::user()->departamento == "Promocion")) {
            $usuarios = DB::table('usuarios')->orderBy('nombre', 'Asc')->get();
            return View::make('tareas.reportes.usuarios', array('usuarios' => $usuarios));
        }
        else {

            $asignados = DB::table('asignacion')->where('id_coordinador', Auth::user()->id)->lists('id_personal', 'id_personal');
            $users = DB::table('usuarios')->orderBy('nombre', 'Asc')->get();
            $usuarios = array();
                    foreach ($users as $user) {
                        if (isset($asignados[$user->id])) {
                            $usuarios[] = $user;
                        }
                    }
            return View::make('tareas.reportes.usuarios', array('usuarios' => $usuarios));
        }
        
    }

    public function reportesUsuariosAjax(){
        if(Request::ajax()){
            $id_responsable =Input::get('id_responsable');
            $fecha_de =Input::get('fecha_de');
            $date = Input::get('fecha_hasta');
            $fechahasta = new DateTime($date);
            $fecha_hasta = $fechahasta -> add(new DateInterval('PT24H'));

            $tareas = DB::table('tareas')->where('id_responsable', '=', $id_responsable)->whereBetween('fecha', array($fecha_de, $fecha_hasta))->get();
            $tareas_concluidas_en_ese_periodo = DB::table('tareas')->where('id_responsable', '=', $id_responsable)->whereBetween('fecha_concluida', array($fecha_de, $fecha_hasta))->get();

            //total de tareas
            $tareas_total = DB::table('tareas')->where('id_responsable', '=', $id_responsable)->whereBetween('fecha', array($fecha_de, $fecha_hasta))->count();
            //total de tareas completadas
            $tareas_completadas_tiempo = DB::table('tareas')->where('id_responsable', '=', $id_responsable)->where('estado', '=', 'Concluida A Tiempo')->whereBetween('fecha', array($fecha_de, $fecha_hasta))->count();
            $tareas_completadas_destiempo = DB::table('tareas')->where('id_responsable', '=', $id_responsable)->where('estado', '=', 'Concluida A Destiempo')->whereBetween('fecha', array($fecha_de, $fecha_hasta))->count();
            $tareas_completadas_total = $tareas_completadas_tiempo + $tareas_completadas_destiempo;
            $tareas_autoasignadas_para =  DB::table('tareas')->where('id_responsable', '=', $id_responsable)->where('id_asignador', '=', $id_responsable)->whereBetween('fecha', array($fecha_de, $fecha_hasta))->count();
            $tareas_autoasignadas_en =  DB::table('tareas')->where('id_responsable', '=', $id_responsable)->where('id_asignador', '=', $id_responsable)->whereBetween('created_at', array($fecha_de, $fecha_hasta))->count();

            $tareas_completadas_en =  DB::table('tareas')->where('id_responsable', '=', $id_responsable)->whereBetween('fecha_concluida', array($fecha_de, $fecha_hasta))->count();

            //total de tareas no completadas
            $tareas_vencidas = DB::table('tareas')->where('id_responsable', '=', $id_responsable)->where('estado', '=', 'Vencido')->whereBetween('fecha', array($fecha_de, $fecha_hasta))->count();

            return Response::json(array('success' =>true, 'tareas' => $tareas, 'tareas_total' => $tareas_total, 'tareas_autoasignadas_en' => $tareas_autoasignadas_en, 'tareas_autoasignadas_para' => $tareas_autoasignadas_para, 'tareas_completadas_tiempo' => $tareas_completadas_tiempo, 'tareas_completadas_destiempo' => $tareas_completadas_destiempo, 'tareas_completadas_total' => $tareas_completadas_total, 'tareas_vencidas' => $tareas_vencidas, 'tareas_completadas_en' => $tareas_completadas_en, 'tareas_concluidas_en_ese_periodo' => $tareas_concluidas_en_ese_periodo));
        }
    }

    public function reportesUsuariosAjaxPDF(){
        //if(Request::ajax()){
            $id_responsable =Input::get('id_responsable');
            $fecha_de =Input::get('fecha_de');
            $date_hasta = Input::get('fecha_hasta');
            $fechahasta = new DateTime($date_hasta);
            $fecha_hasta = $fechahasta -> add(new DateInterval('PT24H'));
            $nombre = DB::table('usuarios')->where('id', $id_responsable)->pluck('nombre');
            $apellido = DB::table('usuarios')->where('id', $id_responsable)->pluck('apellido');
            $tareas = DB::table('tareas')->where('id_responsable', '=', $id_responsable)->whereBetween('fecha', array($fecha_de, $fecha_hasta))->get();
            

            //total de tareas
            $tareas_total = DB::table('tareas')->where('id_responsable', '=', $id_responsable)->whereBetween('fecha', array($fecha_de, $fecha_hasta))->count();
            //total de tareas completadas
            $tareas_completadas_tiempo = DB::table('tareas')->where('id_responsable', '=', $id_responsable)->where('estado', '=', 'Concluida A Tiempo')->whereBetween('fecha', array($fecha_de, $fecha_hasta))->count();
            $tareas_completadas_destiempo = DB::table('tareas')->where('id_responsable', '=', $id_responsable)->where('estado', '=', 'Concluida A Destiempo')->whereBetween('fecha', array($fecha_de, $fecha_hasta))->count();
            $tareas_completadas_total = $tareas_completadas_tiempo + $tareas_completadas_destiempo;
            $tareas_autoasignadas =  DB::table('tareas')->where('id_responsable', '=', $id_responsable)->where('id_asignador', '=', $id_responsable)->whereBetween('fecha', array($fecha_de, $fecha_hasta))->count();
            //total de tareas no completadas
            $tareas_vencidas = DB::table('tareas')->where('id_responsable', '=', $id_responsable)->where('estado', '=', 'Vencido')->whereBetween('fecha', array($fecha_de, $fecha_hasta))->count();

            $now = new DateTime();
            $hoy = $now->format('Y-m-d H:i:s');

            $nombre_pdf = 'Reporte' . $nombre . $apellido. $hoy;
            $data = array(
                'tareas' => $tareas,
                'tareas_total' => $tareas_total,
                'tareas_autoasignadas' => $tareas_autoasignadas,
                'tareas_completadas_tiempo' => $tareas_completadas_tiempo,
                'tareas_completadas_destiempo' => $tareas_completadas_destiempo,
                'tareas_completadas_total' => $tareas_completadas_total,
                'tareas_vencidas' => $tareas_vencidas
                );

            $html = View::make('tareas.reportes.pdf.usuarios')->with(array('tareas'=>$tareas, 'nombre'=>$nombre, 'apellido'=>$apellido, 'fecha_de'=>$fecha_de, 'date_hasta'=>$date_hasta));

            return PDF::loadHTML($html)->setPaper('a4')->setOrientation('portrait')->stream($nombre_pdf);
            //return PDF::load(utf8_decode($html), 'A4', 'portrait')->download($nombre_pdf);


            //return Response::json(array('success' =>true));
        //}
    }

    public function reportesDepartamento()
    {
        return View::make('tareas.reportes.departamento');
    }

    public function reportesDepartamentoAjax(){
        if(Request::ajax()){
            $departamento =Input::get('departamento');
            $fecha_de =Input::get('fecha_de');
            $date = Input::get('fecha_hasta');
            $fechahasta = new DateTime($date);
            $fecha_hasta = $fechahasta -> add(new DateInterval('PT24H'));

            $tareas = DB::table('tareas')
                                ->join('usuarios', function($join)
                                {
                                    $join->on('tareas.id_responsable', '=', 'usuarios.id');
                                            
                                })
                                ->where('usuarios.departamento', '=', $departamento)
                                ->whereBetween('tareas.fecha', array($fecha_de, $fecha_hasta))
                                ->select('tareas.id', 'tareas.tarea', 'tareas.objetivo', 'tareas.estado', 'tareas.fecha', 'tareas.fecha_concluida', 'tareas.nombre_responsable')
                                ->get();

            

            //total de tareas
            $tareas_total = DB::table('tareas')
                                    ->join('usuarios', function($join)
                                    {
                                        $join->on('tareas.id_responsable', '=', 'usuarios.id');
                                    })
                                    ->where('usuarios.departamento', '=', $departamento)
                                    ->whereBetween('tareas.fecha', array($fecha_de, $fecha_hasta))
                                    ->count();
            //total de tareas completadas
            $tareas_completadas_tiempo = DB::table('tareas')
                                        ->join('usuarios', function($join)
                                        {
                                            $join->on('tareas.id_responsable', '=', 'usuarios.id'); 
                                        })
                                        ->where('usuarios.departamento', '=', $departamento)
                                        ->where('tareas.estado', '=', 'Concluida A Tiempo')
                                        ->whereBetween('tareas.fecha', array($fecha_de, $fecha_hasta))
                                        ->count();

            $tareas_completadas_destiempo = DB::table('tareas')
                                        ->join('usuarios', function($join)
                                        {
                                            $join->on('tareas.id_responsable', '=', 'usuarios.id'); 
                                        })
                                        ->where('usuarios.departamento', '=', $departamento)
                                        ->where('tareas.estado', '=', 'Concluida A Destiempo')
                                        ->whereBetween('tareas.fecha', array($fecha_de, $fecha_hasta))
                                        ->count();

            $tareas_completadas_total = $tareas_completadas_tiempo + $tareas_completadas_destiempo;

            //total de tareas no completadas
            $tareas_vencidas = DB::table('tareas')
                                        ->join('usuarios', function($join)
                                        {
                                            $join->on('tareas.id_responsable', '=', 'usuarios.id');
                                        })
                                        ->where('usuarios.departamento', '=', $departamento)
                                        ->where('tareas.estado', '=', 'Vencido')
                                        ->whereBetween('tareas.fecha', array($fecha_de, $fecha_hasta))
                                        ->count();


            return Response::json(array('success' =>true, 'tareas' => $tareas, 'tareas_total' => $tareas_total, 'tareas_completadas_tiempo' => $tareas_completadas_tiempo, 'tareas_completadas_destiempo' => $tareas_completadas_destiempo, 'tareas_completadas_total' => $tareas_completadas_total, 'tareas_vencidas' => $tareas_vencidas));
        }
    }


}
?>