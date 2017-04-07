<?php 
class DirectorDespacho extends Eloquent {
    protected $table = 'DirectorDespacho';
    protected $fillable = array('id_ajustadora',
    							'nombre',
                                'telefono_oficina', 
                                'telefono_celular', 
                                'email', 
                                'nextel'
                                );

    public function ajustadora(){
        return $this->belongsTo('Ajustadora', 'id_ajustadora', 'id');
    }


}
?>