<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;
class Bitacora extends Model { //Todos los modelos deben extender la clase Eloquent
    protected $table = 'Bitacora';
    protected $fillable = array('id_usuario', 
    							'id_siniestro', 
    							'comentario'
    							);

    public function usuario(){
    	return $this->belongsTo('App\Models\Usuario', 'id_usuario', 'id');
    }

}
?>