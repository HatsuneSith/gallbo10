<?php namespace App\Models;
use View;
use Auth;

use Illuminate\Database\Eloquent\Model;
class TiposSiniestros extends Model {
    protected $table = 'TiposSiniestros';

    /*public function promSiniestros(){
    	return $this->hasMany('PromocionSiniestros', 'tipo_siniestro');
    }*/

}
?>