<?php namespace App\Models;
use View;
use Auth;

use Illuminate\Database\Eloquent\Model;
class Ajustadores extends Model {
    protected $table = 'Ajustadores';
    protected $fillable = array('nombre',
    							'domicilio',
    							'estado',
    							'ciudad',
    							'codigo_postal',
                                'telefono_oficina',
                                'telefono_celular',
                                'nextel',
                                'email'
                                );

    public function estado(){
        return $this->belongsTo('App\Models\Estados', 'estado', 'id');
    }




}
?>