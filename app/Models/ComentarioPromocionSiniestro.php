<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;
class ComentarioPromocionSiniestro extends Model { //Todos los modelos deben extender la clase Eloquent
    protected $table = 'ComentariosPromocionSiniestros';
    protected $fillable = array('id_promocion_siniestros', 'id_usuario', 'comentario');

    public function promocionSiniestros(){
    	return $this->belongsTo('App\Models\PromocionSiniestro', 'id_promocion_siniestros', 'id');
    }

    public function usuario(){
    	return $this->belongsTo('App\Models\Usuario', 'id_usuario', 'id');
    }

}
?>