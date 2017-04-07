<?php 
class ClasificacionDocumentos extends Eloquent {
    protected $table = 'ClasificacionDocumentos';

    public function documentos(){
        return $this->hasMany('Documentos', 'id_clasificacion');
    }

}