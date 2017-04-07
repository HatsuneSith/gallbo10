<?php 
class Aseguradora extends Eloquent {
    protected $table = 'Aseguradora';
    protected $fillable = array('nombre',
                                'domicilio', 
                                'estado', 
                                'ciudad', 
                                'codigo_postal', 
                                'telefono', 
                                'fax', 
                                'email'
                                );


    
    public function estado(){
        return $this->belongsTo('Estados', 'estado', 'id');
    }

    public function gerencia_siniestros(){
        return $this->hasOne('GerenciaSiniestros', 'id_aseguradora');
    }

    public function director_siniestros(){
        return $this->hasOne('DirectorSiniestros', 'id_aseguradora');
    }



}
?>