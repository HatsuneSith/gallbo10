<?php 
class ApoderadoLegal extends Eloquent {
    protected $table = 'ApoderadoLegal';
    protected $fillable = array('nombre',
                                'sexo', 
                                'telefono', 
                                'email', 
                                'nextel',
                                'num_escritura',
                                'fecha_escritura',
                                'num_notario',
                                'nombre_notario',
                                'ciudad_noario'
                                );


    public function sexo(){
        return $this->belongsTo('Sexos', 'sexo', 'id');
    }

}
?>