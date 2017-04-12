<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;
class EjecutivoAsignado extends Model {
    protected $table = 'EjecutivoAsignado';
    protected $fillable = array('id_siniestro',
    							'id_usuario'
                                );




}
?>