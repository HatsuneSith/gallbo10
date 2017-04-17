<?php namespace App\Models;
use View;
use Auth;

use Illuminate\Database\Eloquent\Model;
class Siniestro extends Model {
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
    	return $this->belongsTo('App\Models\Estados', 'estado', 'id');
    }

    public function tipo_siniestro(){
        return $this->belongsTo('App\Models\TiposSiniestros', 'tipo_siniestro', 'id');
    }

    public function contrato(){
    	return $this->hasOne('App\Models\ContratoSiniestro', 'id_siniestro');
    }

    public function asegurado(){
        return $this->belongsTo('App\Models\Asegurado', 'id_asegurado', 'id');
    }

    public function aseguradora(){
        return $this->belongsTo('App\Models\Aseguradora', 'id_aseguradora', 'id');
    }

    public function agente_seguros(){
        return $this->belongsTo('App\Models\AgenteSeguroSiniestro', 'id_agente_seguros', 'id');
    }

    public function ajustadora(){
        return $this->belongsTo('App\Models\Ajustadora', 'id_ajustadora', 'id');
    }

    public function ajustador_designado(){
        return $this->belongsTo('App\Models\AjustadorDesignado', 'id_ajustador_designado', 'id');
    }

    public function poliza(){
        return $this->belongsTo('App\Models\Poliza', 'id_poliza', 'id');
    }

    public function averiguacion_previa(){
        return $this->belongsTo('App\Models\AveriguacionPrevia', 'id_averiguacion_previa', 'id');
    }

    public function clasificacion_documentos(){
        return $this->belongsToMany('App\Models\ClasificacionDocumentos', 'App\Models\ClasificacionDocumentosSiniestros', 'id_siniestro', 'id_clasificacion');
    }

    public function bitacora(){
        return $this->hasMany('App\Models\Bitacora', 'id_siniestro');
    }

    public function ejecutivo_asignado(){
        return $this->belongsToMany('App\Models\Usuario', 'App\Models\EjecutivoAsignado', 'id_siniestro', 'id_usuario');
    }

    public function responsable(){
        return $this->belongsToMany('App\Models\Usuario', 'App\Models\ResponsableSiniestro', 'id_siniestro', 'id_usuario');
    }

    public function documentos(){
        return $this->belongsToMany('App\Models\Documentos', 'App\Models\DocumentosSiniestros', 'id_siniestro', 'id_documento')->withPivot('id_responsable', 'nombre_responsable', 'fecha_entrega', 'entregado', 'archivo', 'observaciones');
    }

    public function tablero(){
        return $this->hasOne('App\Models\TableroFechas', 'id_siniestro');
    }


    

}
?>