<?php 
class comentarioTarea extends Eloquent { //Todos los modelos deben extender la clase Eloquent
    protected $table = 'comentarios_tareas';
    protected $fillable = array('id_tarea', 'comentario', 'id_usuario', 'nombre_usuario');

    public function tareas(){
    	return $this->belongsTo('Tareas', 'id');
    }

    public function usuarios(){
    	return $this->belongsTo('Usuario', 'id');
    }

}
?>