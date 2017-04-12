<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;
class CaracterAsegurado extends Model {
    protected $table = 'CaracterAsegurado';
    protected $fillable = array('id_caracter_asegurado',
                                'id_asegurado'
                                );

}
?>