<?php namespace App\Models;
use View;
use Auth;

use Illuminate\Database\Eloquent\Model;
class comentarioPromSiniestro extends Model { //Todos los modelos deben extender la clase Eloquent
    protected $table = 'comentarios_promSiniestros';
    protected $fillable = array('id_promSiniestro', 'comentario', 'id_usuario', 'nombre_usuario');

    public function promSiniestro(){
    	return $this->belongsTo('App\Models\promSiniestro', 'id');
    }

    public function usuarios(){
    	return $this->belongsTo('App\Models\Usuario', 'id');
    }

}
?>