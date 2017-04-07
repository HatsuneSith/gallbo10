<?php 
class ClientesJuridico extends Eloquent {
    protected $table = 'ClientesJuridico';
    protected $fillable = array('cliente',
                                'aseguradora', 
                                'juzgado', 
                                'expediente', 
                                'tipo_juicio'
                                );


    public function acuerdo(){
        return $this->hasMany('AcuerdosJuridico', 'id_cliente');
    }

    public function juicio(){
        return $this->hasOne('FechasJuicios', 'id_cliente');
    }

    

}
?>