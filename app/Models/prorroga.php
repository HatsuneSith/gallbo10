<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;
class Prorroga extends Model { //Todos los modelos deben extender la clase Eloquent
    protected $table = 'prorroga_fecha';
    protected $fillable = array('id_tarea', 'fecha_peticion', 'fecha_anterior', 'estado');

    public function tareas(){
    	return $this->belongsTo('App\Models\Tareas', 'id');
    }

}
?>