<?php 
class TableroSiniestrosNoRegistrados extends Eloquent {
    protected $table = 'TableroSiniestrosNoRegistrados';
    protected $fillable = array('asegurado',
                                'ejecutivo',
                                'cierre_trato', 
                                'firma_contrato', 
                                'entrega_cartas', 
                                'solicitud_documentos', 
                                'elaboracion_cronograma',
                                'doc_totales',
                                'doc_recabados',
                                'entrega_reclamacion_parcial', 
                                'entrega_reclamacion_total', 
                                'inicio_fase_ajustador', 
                                'bitacora',
                                'firma_convenio'
                                );


}
?>