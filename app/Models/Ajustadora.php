<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;
class Ajustadora extends Model {
    protected $table = 'Ajustadora';
    protected $fillable = array('nombre',
    							'domicilio',
    							'estado',
    							'ciudad',
    							'codigo_postal'
                                );

    public function estado(){
        return $this->belongsTo('App\Models\Estados', 'estado', 'id');
    }

    public function director_despacho(){
        return $this->hasOne('App\Models\DirectorDespacho', 'id_ajustadora');
    }



}
?>