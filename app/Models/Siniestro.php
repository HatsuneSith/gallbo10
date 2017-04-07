<?php 
class Siniestro extends Eloquent {
    protected $table = 'Siniestros';
    protected $fillable = array('fecha',
                                'num_siniestro', 
                                'domicilio', 
                                'estado', 
                                'ciudad', 
                                'codigo_postal', 
                                'tipo_siniestro', 
                                'id_asegurado', 
                                'id_aseguradora', 
                                'id_agente_seguros', 
                                'id_ajustadora', 
                                'id_ajustador_designado', 
                                'id_poliza', 
                                'id_averiguacion_previa'
                                );


    public function estado(){
    	return $this->belongsTo('Estados', 'estado', 'id');
    }

    public function tipo_siniestro(){
        return $this->belongsTo('TiposSiniestros', 'tipo_siniestro', 'id');
    }

    public function contrato(){
    	return $this->hasOne('ContratoSiniestro', 'id_siniestro');
    }

    public function asegurado(){
        return $this->belongsTo('Asegurado', 'id_asegurado', 'id');
    }

    public function aseguradora(){
        return $this->belongsTo('Aseguradora', 'id_aseguradora', 'id');
    }

    public function agente_seguros(){
        return $this->belongsTo('AgenteSeguroSiniestro', 'id_agente_seguros', 'id');
    }

    public function ajustadora(){
        return $this->belongsTo('Ajustadora', 'id_ajustadora', 'id');
    }

    public function ajustador_designado(){
        return $this->belongsTo('AjustadorDesignado', 'id_ajustador_designado', 'id');
    }

    public function poliza(){
        return $this->belongsTo('Poliza', 'id_poliza', 'id');
    }

    public function averiguacion_previa(){
        return $this->belongsTo('AveriguacionPrevia', 'id_averiguacion_previa', 'id');
    }

    public function clasificacion_documentos(){
        return $this->belongsToMany('ClasificacionDocumentos', 'ClasificacionDocumentosSiniestros', 'id_siniestro', 'id_clasificacion');
    }

    public function bitacora(){
        return $this->hasMany('Bitacora', 'id_siniestro');
    }

    public function ejecutivo_asignado(){
        return $this->belongsToMany('Usuario', 'EjecutivoAsignado', 'id_siniestro', 'id_usuario');
    }

    public function responsable(){
        return $this->belongsToMany('Usuario', 'ResponsableSiniestro', 'id_siniestro', 'id_usuario');
    }

    public function documentos(){
        return $this->belongsToMany('Documentos', 'DocumentosSiniestros', 'id_siniestro', 'id_documento')->withPivot('id_responsable', 'nombre_responsable', 'fecha_entrega', 'entregado', 'archivo', 'observaciones');
    }

    public function tablero(){
        return $this->hasOne('TableroFechas', 'id_siniestro');
    }


    

}
?>