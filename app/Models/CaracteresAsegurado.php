<?php namespace App\Models;
use View;
use Auth;

use Illuminate\Database\Eloquent\Model;
class CaracteresAsegurado extends Model {
    protected $table = 'CaracteresAsegurado';

    public function asegurados(){
        return $this->belongsToMany('App\Models\Asegurado', 'App\Models\CaracterAsegurado', 'id_caracter_asegurado', 'id_asegurado');
    }

}



?>