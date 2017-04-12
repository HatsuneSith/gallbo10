<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;
class Asignacion extends Model { //Todos los modelos deben extender la clase Eloquent
    protected $table = 'asignacion';
    protected $fillable = array('id_coordinador', 'id_personal');

}
?>