<?php 
class ComentarioPromocionSiniestro extends Eloquent { //Todos los modelos deben extender la clase Eloquent
    protected $table = 'ComentariosPromocionSiniestros';
    protected $fillable = array('id_promocion_siniestros', 'id_usuario', 'comentario');

    public function promocionSiniestros(){
    	return $this->belongsTo('PromocionSiniestro', 'id_promocion_siniestros', 'id');
    }

    public function usuario(){
    	return $this->belongsTo('Usuario', 'id_usuario', 'id');
    }

}
?>