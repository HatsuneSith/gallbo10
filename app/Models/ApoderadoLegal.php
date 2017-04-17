<?php namespace App\Models;
use View;
use Auth;

use Illuminate\Database\Eloquent\Model;
class ApoderadoLegal extends Model {
    protected $table = 'ApoderadoLegal';
    protected $fillable = array('nombre',
                                'sexo', 
                                'telefono', 
                                'email', 
                                'nextel',
                                'num_escritura',
                                'fecha_escritura',
                                'num_notario',
                                'nombre_notario',
                                'ciudad_noario'
                                );


    public function sexo(){
        return $this->belongsTo('App\Models\Sexos', 'sexo', 'id');
    }

}
?>