<?php namespace App\Models;
use View;
use Auth;

use Illuminate\Database\Eloquent\Model;
class LimitacionValorReposicion extends Model {
    protected $table = 'LimitacionValorReposicion';
    protected $fillable = array('id_poliza',
    							'limitacion'
                                );




}
?>