<?php namespace App\Models;
use View;
use Auth;

use Illuminate\Database\Eloquent\Model;
class ClientesJuridico extends Model {
    protected $table = 'ClientesJuridico';
    protected $fillable = array('cliente',
                                'aseguradora', 
                                'juzgado', 
                                'expediente', 
                                'tipo_juicio'
                                );


    public function acuerdo(){
        return $this->hasMany('App\Models\AcuerdosJuridico', 'id_cliente');
    }

    public function juicio(){
        return $this->hasOne('App\Models\FechasJuicios', 'id_cliente');
    }

    

}
?>