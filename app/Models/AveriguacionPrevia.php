<?php namespace App\Models;
use View;
use Auth;

use Illuminate\Database\Eloquent\Model;
class AveriguacionPrevia extends Model {
    protected $table = 'AveriguacionPrevia';
    protected $fillable = array('num_averiguacion',
    							'dependencia_judicial',
    							'titular_dependencia'
                                );




}
?>