<?php 
class GerenciaSiniestros extends Eloquent {
    protected $table = 'GerenciaSiniestros';
    protected $fillable = array('id_aseguradora',
    							'nombre',
                                'telefono', 
                                'email', 
                                'nextel'
                                );

    public function aseguradora(){
        return $this->belongsTo('Aseguradora', 'id_aseguradora', 'id');
    }



}
?>