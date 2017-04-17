<?php namespace App\Models;
use View;
use Auth;

use Illuminate\Database\Eloquent\Model;
class AgenteSeguroSiniestro extends Model {
    protected $table = 'AgenteSeguroSiniestro';
    protected $fillable = array('id_agente',
    							'id_aseguradora'
                                );

    public function agente(){
        return $this->belongsTo('App\Models\AgentesSeguros', 'id_agente', 'id');
    }

    public function aseguradora(){
        return $this->belongsTo('App\Models\Aseguradora', 'id_aseguradora', 'id');
    }




}
?>