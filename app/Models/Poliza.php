<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;
class Poliza extends Model {
    protected $table = 'Poliza';
    protected $fillable = array('num_poliza',
                                'ramo_poliza', 
                                'fecha_expedicion', 
                                'inicio_vigencia', 
                                'fin_vigencia', 
                                'tipo_moneda'
                                );


    

    public function ramo_poliza(){
        return $this->belongsTo('App\Models\RamosPolizas', 'ramo_poliza', 'id');
    }

    public function tipo_moneda(){
        return $this->belongsTo('App\Models\TiposMonedas', 'tipo_moneda', 'id');
    }

    public function medidas_seguridad(){
        return $this->hasOne('App\Models\MedidasSeguridad', 'id_poliza');
    }

    public function endosos_convenios(){
        return $this->hasMany('App\Models\EndososConvenios', 'id_poliza');
    }

    public function coberturas(){
        return $this->belongsToMany('App\Models\Coberturas', 'App\Models\CoberturasAfectadas', 'id_poliza', 'id_coberturas')->withPivot('suma_asegurada', 'valor_declarado', 'deducible', 'coaseguro');
    }

    public function perdidas_consecuenciales(){
        return $this->belongsToMany('App\Models\PerdidasConsecuenciales', 'App\Models\PerdidasConsecuencialesPoliza', 'id_poliza', 'id_perdidas_consecuenciales')->withPivot('periodo_indemnizacion');
    }

    public function clausulas_especiales(){
        return $this->belongsToMany('App\Models\ClausulasEspeciales', 'App\Models\ClausulasEspecialesPoliza', 'id_poliza', 'id_clausulas_especiales');
    }

    public function limitacion_valor_reposicion(){
        return $this->hasOne('App\Models\LimitacionValorReposicion', 'id_poliza');
    }


}
?>