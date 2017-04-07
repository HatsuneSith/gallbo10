<?php 
class Indicador extends Eloquent { //Todos los modelos deben extender la clase Eloquent
    protected $table = 'indicadores';
    protected $fillable = array('id_indicador', 'mes', 'año', 'objetivo', 'semana1', 'semana2', 'semana3', 'semana4', 'semana5');

}
?>