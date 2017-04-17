<?php namespace App\Models;
use View;
use Auth;

use Illuminate\Database\Eloquent\Model;
class AgentesSeguros extends Model {
    protected $table = 'AgentesSeguros';
    protected $fillable = array('nombre',
    							'domicilio',
    							'estado',
    							'ciudad',
    							'codigo_postal',
                                'telefono_oficina',
                                'telefono_celular', 
                                'email', 
                                'nextel'
                                );

    public function estado(){
        return $this->belongsTo('App\Models\Estados', 'estado', 'id');
    }



}
?>