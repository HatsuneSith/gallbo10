<?php 
class DocumentosSiniestros extends Eloquent {
    protected $table = 'DocumentosSiniestros';
    protected $fillable = array('id_siniestro',
                                'id_documento',
                                'id_responsable',
                                'nombre_responsable',
                                'fecha_entrega',
                                'entregado',
                                'archivo',
                                'observaciones'
                                );


}