<?php namespace App\Models;
use View;
use Auth;

use Illuminate\Database\Eloquent\Model;
class CoberturasAfectadas extends Model {
    protected $table = 'CoberturasAfectadas';
    protected $fillable = array('id_poliza',
                                'id_coberturas', 
                                'suma_asegurada', 
                                'valor_declarado', 
                                'deducible', 
                                'coaseguro'
                                );




}
?>