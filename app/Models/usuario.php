<?php 
/*use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;*/
use Illuminate\Auth\Authenticatable;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class Usuario extends Eloquent implements AuthenticatableContract, CanResetPasswordContract{ //Todos los modelos deben extender la clase Eloquent

	use Authenticatable, CanResetPassword;

    protected $table = 'usuarios';
    protected $fillable = array('usuario', 'nombre', 'apellido', 'email', 'telefono', 'departamento', 'rol', 'password');
    protected $hidden = array('password', 'remember_token');

    public function tareas(){
    	return $this->hasMany('Tarea', 'id_responsable');
    }

    public function comentariosTarea(){
        return $this->hasMany('ComentarioTarea', 'id_usuario');
    }
    public function comentariosPromocionSiniestros(){
        return $this->hasMany('ComentarioPromocionSiniestro', 'id_usuario');
    }

    // este metodo se debe implementar por la interfaz
    public function getAuthIdentifier()
    {
        return $this->getKey();
    }

    //este metodo se debe implementar por la interfaz
    // y sirve para obtener la clave al momento de validar el inicio de sesión
    public function getAuthPassword()
    {
        return $this->password; 
    }

    public function siniestro(){
        return $this->hasOne('ResponsableSiniestro', 'id_usuario');
    }

}

?>