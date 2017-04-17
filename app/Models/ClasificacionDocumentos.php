<?php namespace App\Models;
use View;
use Auth;

use Illuminate\Database\Eloquent\Model;
class ClasificacionDocumentos extends Model {
    protected $table = 'ClasificacionDocumentos';

    public function documentos(){
        return $this->hasMany('App\Models\Documentos', 'id_clasificacion');
    }

}