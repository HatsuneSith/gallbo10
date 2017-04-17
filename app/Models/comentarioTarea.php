<?php namespace App\Models;
use View;
use Auth;

use Illuminate\Database\Eloquent\Model;
class comentarioTarea extends Model { //Todos los modelos deben extender la clase Eloquent
    protected $table = 'comentarios_tareas';
    protected $fillable = array('id_tarea', 'comentario', 'id_usuario', 'nombre_usuario');

    public function tareas(){
    	return $this->belongsTo('App\Models\Tareas', 'id');
    }

    public function usuarios(){
    	return $this->belongsTo('App\Models\Usuario', 'id');
    }

}
?>