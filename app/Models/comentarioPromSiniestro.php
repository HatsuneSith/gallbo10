<?php 
class comentarioPromSiniestro extends Eloquent { //Todos los modelos deben extender la clase Eloquent
    protected $table = 'comentarios_promSiniestros';
    protected $fillable = array('id_promSiniestro', 'comentario', 'id_usuario', 'nombre_usuario');

    public function promSiniestro(){
    	return $this->belongsTo('promSiniestro', 'id');
    }

    public function usuarios(){
    	return $this->belongsTo('Usuario', 'id');
    }

}
?>