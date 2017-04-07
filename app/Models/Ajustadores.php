<?php 
class Ajustadores extends Eloquent {
    protected $table = 'Ajustadores';
    protected $fillable = array('nombre',
    							'domicilio',
    							'estado',
    							'ciudad',
    							'codigo_postal',
                                'telefono_oficina',
                                'telefono_celular',
                                'nextel',
                                'email'
                                );

    public function estado(){
        return $this->belongsTo('Estados', 'estado', 'id');
    }




}
?>