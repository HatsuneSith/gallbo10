<?php 
class Poliza extends Eloquent {
    protected $table = 'Poliza';
    protected $fillable = array('num_poliza',
                                'ramo_poliza', 
                                'fecha_expedicion', 
                                'inicio_vigencia', 
                                'fin_vigencia', 
                                'tipo_moneda'
                                );


    

    public function ramo_poliza(){
        return $this->belongsTo('RamosPolizas', 'ramo_poliza', 'id');
    }

    public function tipo_moneda(){
        return $this->belongsTo('TiposMonedas', 'tipo_moneda', 'id');
    }

    public function medidas_seguridad(){
        return $this->hasOne('MedidasSeguridad', 'id_poliza');
    }

    public function endosos_convenios(){
        return $this->hasMany('EndososConvenios', 'id_poliza');
    }

    public function coberturas(){
        return $this->belongsToMany('Coberturas', 'CoberturasAfectadas', 'id_poliza', 'id_coberturas')->withPivot('suma_asegurada', 'valor_declarado', 'deducible', 'coaseguro');
    }

    public function perdidas_consecuenciales(){
        return $this->belongsToMany('PerdidasConsecuenciales', 'PerdidasConsecuencialesPoliza', 'id_poliza', 'id_perdidas_consecuenciales')->withPivot('periodo_indemnizacion');
    }

    public function clausulas_especiales(){
        return $this->belongsToMany('ClausulasEspeciales', 'ClausulasEspecialesPoliza', 'id_poliza', 'id_clausulas_especiales');
    }

    public function limitacion_valor_reposicion(){
        return $this->hasOne('LimitacionValorReposicion', 'id_poliza');
    }


}
?>