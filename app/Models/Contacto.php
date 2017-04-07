<?php 
class Contacto extends Eloquent {
    protected $table = 'Contacto';
    protected $fillable = array('nombre',
                                'sexo', 
                                'telefono', 
                                'email', 
                                'nextel'
                                );


    public function sexo(){
        return $this->belongsTo('Sexos', 'sexo', 'id');
    }

}
?>