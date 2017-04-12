<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;
class Contacto extends Model {
    protected $table = 'Contacto';
    protected $fillable = array('nombre',
                                'sexo', 
                                'telefono', 
                                'email', 
                                'nextel'
                                );


    public function sexo(){
        return $this->belongsTo('App\Models\Sexos', 'sexo', 'id');
    }

}
?>