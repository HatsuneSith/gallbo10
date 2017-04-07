<?php 
class PromocionSiniestro extends Eloquent {
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
    	return $this->hasMany('ComentarioPromocionSiniestro', 'id_promocion_siniestros');
    }

    public function tipo_siniestro(){
    	return $this->belongsTo('TiposSiniestros', 'tipo_siniestro', 'id');
    }

    public function estado(){
    	return $this->belongsTo('Estados', 'estado', 'id');
    }

    public function giro_empresa(){
    	return $this->belongsTo('GirosEmpresas', 'giro_empresa', 'id');
    }

    public function propuesta(){
    	return $this->hasOne('PropuestaSiniestro', 'id_promocion_siniestro');
    }

    

}
?>