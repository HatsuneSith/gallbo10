<?php 
class Asignacion extends Eloquent { //Todos los modelos deben extender la clase Eloquent
    protected $table = 'asignacion';
    protected $fillable = array('id_coordinador', 'id_personal');

}
?>