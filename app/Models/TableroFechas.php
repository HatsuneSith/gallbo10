<?php 
class TableroFechas extends Eloquent {
    protected $table = 'TableroFechas';
    protected $fillable = array('id_siniestro',
                                'cierre_trato', 
                                'firma_contrato', 
                                'entrega_cartas', 
                                'solicitud_documentos', 
                                'elaboracion_cronograma', 
                                'entrega_reclamacion_parcial', 
                                'entrega_reclamacion_total', 
                                'inicio_fase_ajustador', 
                                'firma_convenio'
                                );



    public function siniestro(){
        return $this->belongsTo('Siniestro', 'id_siniestro', 'id');
    }
 

}
?>