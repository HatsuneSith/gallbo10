<?php namespace App\Models;
use View;
use Auth;

use Illuminate\Database\Eloquent\Model;
class EjecutivoAsignado extends Model {
    protected $table = 'EjecutivoAsignado';
    protected $fillable = array('id_siniestro',
    							'id_usuario'
                                );




}
?>