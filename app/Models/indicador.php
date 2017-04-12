<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;
class Indicador extends Model { //Todos los modelos deben extender la clase Eloquent
    protected $table = 'indicadores';
    protected $fillable = array('id_indicador', 'mes', 'año', 'objetivo', 'semana1', 'semana2', 'semana3', 'semana4', 'semana5');

}
?>