<?php namespace App\Models;
use View;
use Auth;

use Illuminate\Database\Eloquent\Model;
class PerdidasConsecuencialesPoliza extends Model {
    protected $table = 'PerdidasConsecuencialesPoliza';
    protected $fillable = array('id_poliza',
                                'id_perdidas_consecuenciales', 
                                'periodo_indemnizacion'
                                );


    



}
?>