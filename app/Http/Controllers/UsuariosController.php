<?php namespace App\Http\Controllers;
use View;
use Auth;
use Hash;
use DB;
use DateTime;
use Validator;
use Request;
use Response;
use App\Models\Usuario;
use App\Models\Asignacion;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;


class UsuariosController extends Controller {

    public function inicio()
    {
        
        return View::make('usuarios.inicio');
    }

    /**
     * Mustra la lista con todos los usuarios
     */
    public function mostrarUsuarios()
    {
        $usuarios = Usuario::all(); 
        // Con el método all() le estamos pidiendo al modelo de Usuario
        // que busque todos los registros contenidos en esa tabla y los devuelva en un Array
        return View::make('usuarios.lista', array('usuarios' => $usuarios));

        // El método make de la clase View indica cual vista vamos a mostrar al usuario 
        //y también pasa como parámetro los datos que queramos pasar a la vista. 
        // En este caso le estamos pasando un array con todos los usuarios
    }

    /**
     * Muestra formulario para crear Usuario
     */
    public function nuevoUsuario()
    {
        return View::make('usuarios.crear');
    }

    /**
     * Crear el usuario nuevo
     */
    public function crearUsuario()
    {
        // arreglo con todas las reglas de validación que se van a aplicar a los datos
        $reglas =  array(
            'nombre' => 'required',
            'apellido' => 'required',
            'email'  => array('required','email', 'unique:usuarios'),
            'departamento' => 'required',
            'rol' => 'required',
            'password' => 'required'
        );

        $validator = Validator::make(Input::all(), $reglas);

        // aplicamos las reglas con la clase Validator como aprendimos anteriormente
        if ( $validator->fails() ){

            // en caso de que la validación falle vamos a retornar al formulario
            // pero vamos a enviar los errores que devolvió Validator
            // y también los datos que el usuario escribió
            return Redirect::to('sire/configuracion/usuarios/nuevo')
                    
                    ->withErrors($validator)// Aquí se esta devolviendo a la vista los errores
                    
                    ->withInput();// Aquí se esta devolviendo a la vista todos los datos del formulario
        }else{

            $input = Input::all();
            $input['password'] = Hash::make($input['password']);

            Usuario::create($input);

            return Redirect::to('sire/configuracion/usuarios');
        }

    }


    /**
     * Ver usuario con id
     */
    /*public function verUsuario($id)
    {

        $usuario = Usuario::find($id);

    return View::make('usuarios.ver', array('usuario' => $usuario));
    }*/

    public function verPerfil()
    {
        $usuario = Usuario::find(Auth::user()->id);
        return View::make('usuarios.ver', array('usuario' => $usuario));
    }


    public function cambiarPassword()
    {
        
        $password = DB::table('usuarios')->where('id', Auth::user()->id)->pluck('password');

            
        $reglas =  array(
            'password_anterior' => 'required',
            'password_nueva' => 'required',
        );

        $validator = Validator::make(Input::all(), $reglas);

        
        if ( $validator->fails() ){
            return Redirect::to('usuario/perfil')->with('message', $message="Favor de ingresar los dos campos");
        }else{

            $input = Input::all();
            $password_anterior = $input['password_anterior'];

            if ( Hash::check($password_anterior, $password)) {
                $usuario = Usuario::find(Auth::user()->id);
                $usuario->password = Hash::make($input['password_nueva']);;
                $usuario->save();
                return Redirect::to('usuario/perfil')->with('message', $message="La contraseña fue cambiada correctamente");
            }
            else{
                return Redirect::to('usuario/perfil')->with('message', $message="Contraseña actual incorrecta");
            
            }
            
        }

    }

    public function cambioPassword()
    {

        $reglas =  array(
            'password' => 'required',
        );
        
        $validator = Validator::make(Input::all(), $reglas);
        
        if ( $validator->fails() ){
            return Redirect::to('sire/configuracion/usuarios')->with('message', $message="Favor de ingresar el password nuevo");
        }
        else{

            $input = Input::all();           
            $usuario = Usuario::find($input['id_usuario']);
            $usuario->password = Hash::make($input['password']);;
            $usuario->save();
            return Redirect::to('sire/configuracion/usuarios')->with('message', $message="La contraseña fue cambiada correctamente");
        }

    }

    public function arrayUsuarios ()
    {
        $now = new DateTime();
        $mes_actual = $now->format('m');
        $año_actual = $now->format('Y');
        if(Request::ajax()){
            if (Auth::user()->rol == 'Directivo') {
                $usuarios = DB::table('usuarios')->orderBy('nombre', 'Asc')->get();
                return Response::json(array('success' =>true, 'usuarios' => $usuarios, 'mes_actual' => $mes_actual, 'año_actual' => $año_actual));    
            }
            if (Auth::user()->rol == "Coordinador") {
                $usuarios = DB::table('usuarios')->orderBy('nombre', 'Asc')->where('departamento', '=', Auth::user()->departamento)->orWhere('departamento', '=', 'Sistemas')->get();
                return Response::json(array('success' =>true, 'usuarios' => $usuarios, 'mes_actual' => $mes_actual, 'año_actual' => $año_actual));    
            }
            else{
                $usuarios = DB::table('usuarios')->orderBy('nombre', 'Asc')->where('id', '=', Auth::user()->id)->get();
                return Response::json(array('success' =>true, 'usuarios' => $usuarios, 'mes_actual' => $mes_actual, 'año_actual' => $año_actual));    
            }
            
        }

    }

    public function eliminarUsuario($id)
    {
        if(Request::ajax()){
            $usuario = Usuario::find($id);
            $usuario->delete();
            DB::table('tareas')->where('id_responsable', '=', $id)->delete();
            DB::table('tareas')->where('id_asignador', '=', $id)->delete();

            DB::table('comentarios_tareas')->where('id_usuario', '=', $id)->delete();

            DB::table('comentarios_tareas')
                ->join('tareas', function($join)
                {
                    $join->on('comentarios_tareas.id_tarea', '=', 'tareas.id'); 
                })
                ->where('tareas.id_responsable', '=', $id)
                ->delete();

            DB::table('comentarios_tareas')
                ->join('tareas', function($join)
                {
                    $join->on('comentarios_tareas.id_tarea', '=', 'tareas.id'); 
                })
                ->where('tareas.id_asignador', '=', $id)
                ->delete();

            return Response::json(array('success' =>true));
        }
        else{
            return Redirect::to('sire/configuracion/usuarios');
        }
    }

    public function asignacionUsuario($id)
    {
        $usuarios = DB::table('usuarios')->orderBy('nombre', 'Asc')->get();
        $asignados = DB::table('asignacion')->where('id_coordinador', $id)->lists('id_personal', 'id_personal');
        $user = usuario::find($id);
        return View::make('usuarios.asignacion', array('user' => $user, "usuarios" => $usuarios, "asignados" => $asignados));
    }

    public function guardarAsignacionUsuario()
    {
        $arreglocheck = Input::get('checkuser');
        $num = count($arreglocheck);
        if ($num != 0) {
            DB::table('asignacion')->where('id_coordinador', '=', Input::get('id_coordinador'))->delete();
            for ($n=0; $n < $num ; $n++) {
                $input = array('id_coordinador' => Input::get('id_coordinador'),
                                'id_personal' => $arreglocheck[$n]
                        );
                Asignacion::create($input);
            }
            return Redirect::to('sire/configuracion/usuarios');
        }
        else{
            return Redirect::to('sire/configuracion/usuarios');
        }

    }

}
?>
