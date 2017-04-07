<?php 
class Ajustadora extends Eloquent {
    protected $table = 'Ajustadora';
    protected $fillable = array('nombre',
    							'domicilio',
    							'estado',
    							'ciudad',
    							'codigo_postal'
                                );

    public function estado(){
        return $this->belongsTo('Estados', 'estado', 'id');
    }

    public function director_despacho(){
        return $this->hasOne('DirectorDespacho', 'id_ajustadora');
    }



}
?>