<?php 
class CaracterAsegurado extends Eloquent {
    protected $table = 'CaracterAsegurado';
    protected $fillable = array('id_caracter_asegurado',
                                'id_asegurado'
                                );

}
?>