<?php 
class CaracteresAsegurado extends Eloquent {
    protected $table = 'CaracteresAsegurado';

    public function asegurados(){
        return $this->belongsToMany('Asegurado', 'CaracterAsegurado', 'id_caracter_asegurado', 'id_asegurado');
    }

}



?>