<?php namespace App\Models;
use View;
use Auth;

use Illuminate\Database\Eloquent\Model;
class ClausulasEspecialesPoliza extends Model {
    protected $table = 'ClausulasEspecialesPoliza';
    protected $fillable = array('id_poliza',
                                'id_clausulas_especiales'
                                );



    }


}
?>