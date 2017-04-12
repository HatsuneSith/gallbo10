<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;
class EndososConvenios extends Model {
    protected $table = 'EndososConvenios';
    protected $fillable = array('id_poliza',
    							'texto'
                                );



}
?>