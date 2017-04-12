<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;
class TableroFechas extends Model {
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
        return $this->belongsTo('App\Models\Siniestro', 'id_siniestro', 'id');
    }
 

}
?>