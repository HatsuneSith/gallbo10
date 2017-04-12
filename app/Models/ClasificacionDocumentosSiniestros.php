<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;
class ClasificacionDocumentosSiniestros extends Model {
    protected $table = 'ClasificacionDocumentosSiniestros';
    protected $fillable = array('id_siniestro',
                                'id_clasificacion'
                                );

}