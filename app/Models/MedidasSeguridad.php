<?php namespace App\Models;
use View;
use Auth;

use Illuminate\Database\Eloquent\Model;
class MedidasSeguridad extends Model {
    protected $table = 'MedidasSeguridad';
    protected $fillable = array('id_poliza',
    							'descripcion'
                                );




}
?>