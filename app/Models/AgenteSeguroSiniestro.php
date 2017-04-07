<?php 
class AgenteSeguroSiniestro extends Eloquent {
    protected $table = 'AgenteSeguroSiniestro';
    protected $fillable = array('id_agente',
    							'id_aseguradora'
                                );

    public function agente(){
        return $this->belongsTo('AgentesSeguros', 'id_agente', 'id');
    }

    public function aseguradora(){
        return $this->belongsTo('Aseguradora', 'id_aseguradora', 'id');
    }




}
?>