<?php 
class AgentesSeguros extends Eloquent {
    protected $table = 'AgentesSeguros';
    protected $fillable = array('nombre',
    							'domicilio',
    							'estado',
    							'ciudad',
    							'codigo_postal',
                                'telefono_oficina',
                                'telefono_celular', 
                                'email', 
                                'nextel'
                                );

    public function estado(){
        return $this->belongsTo('Estados', 'estado', 'id');
    }



}
?>