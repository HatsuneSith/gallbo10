<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;
class Aseguradora extends Model {
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
        return $this->belongsTo('App\Models\Estados', 'estado', 'id');
    }

    public function gerencia_siniestros(){
        return $this->hasOne('App\Models\GerenciaSiniestros', 'id_aseguradora');
    }

    public function director_siniestros(){
        return $this->hasOne('App\Models\DirectorSiniestros', 'id_aseguradora');
    }



}
?>