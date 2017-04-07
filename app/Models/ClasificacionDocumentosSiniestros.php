<?php 
class ClasificacionDocumentosSiniestros extends Eloquent {
    protected $table = 'ClasificacionDocumentosSiniestros';
    protected $fillable = array('id_siniestro',
                                'id_clasificacion'
                                );

}