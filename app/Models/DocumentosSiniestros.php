<?php namespace App\Models;
use View;
use Auth;

use Illuminate\Database\Eloquent\Model;
class DocumentosSiniestros extends Model {
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