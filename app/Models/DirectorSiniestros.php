<?php 
class DirectorSiniestros extends Eloquent {
    protected $table = 'DirectorSiniestros';
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