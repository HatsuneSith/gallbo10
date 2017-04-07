<?php 
class Bitacora extends Eloquent { //Todos los modelos deben extender la clase Eloquent
    protected $table = 'Bitacora';
    protected $fillable = array('id_usuario', 
    							'id_siniestro', 
    							'comentario'
    							);

    public function usuario(){
    	return $this->belongsTo('Usuario', 'id_usuario', 'id');
    }

}
?>