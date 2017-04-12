<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;
class PromocionSiniestro extends Model {
    protected $table = 'PromocionSiniestros';
    protected $fillable = array('fecha_siniestro', 
                                'nombre', 
                                'director_general', 
                                'asistente_director_general', 
                                'tipo_siniestro', 
                                'magnitud_siniestro', 
                                'giro_empresa', 
                                'estado', 
                                'ciudad', 
                                'domicilio', 
                                'telefonos', 
                                'email', 
                                'fuente_informacion', 
                                'fecha_cita_agendada', 
                                'fecha_cita_realizada', 
                                'lugar_cita', 
                                'estatus');

    public function comentarios(){
    	return $this->hasMany('App\Models\ComentarioPromocionSiniestro', 'id_promocion_siniestros');
    }

    public function tipo_siniestro(){
    	return $this->belongsTo('App\Models\TiposSiniestros', 'tipo_siniestro', 'id');
    }

    public function estado(){
    	return $this->belongsTo('App\Models\Estados', 'estado', 'id');
    }

    public function giro_empresa(){
    	return $this->belongsTo('App\Models\GirosEmpresas', 'giro_empresa', 'id');
    }

    public function propuesta(){
    	return $this->hasOne('App\Models\PropuestaSiniestro', 'id_promocion_siniestro');
    }

    

}
?>