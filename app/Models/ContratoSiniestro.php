<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;
class ContratoSiniestro extends Model {
    protected $table = 'ContratoSiniestro';
    protected $fillable = array('asegurado',
                                'apoderado_legal', 
                                'num_poliza', 
                                'aseguradora', 
                                'domicilio_siniestro', 
                                'fecha_siniestro', 
                                'tipo_siniestro', 
                                'honorarios_porcentaje', 
                                'honorarios_porcentaje_letra', 
                                'anticipo_cantidad', 
                                'anticipo_cantidad_letra', 
                                'gastos_porcentaje',
                                'gastos_concepto', 
                                'num_personas_atencion', 
                                'domicilio_asegurado',
                                'estado_contrato',
                                'ciudad_contrato',
                                'id_siniestro'
                                );


    

    public function tipo_siniestro(){
        return $this->belongsTo('App\Models\TiposSiniestros', 'tipo_siniestro', 'id');
    }

    public function estado(){
        return $this->belongsTo('App\Models\Estados', 'estado_contrato', 'id');
    }

    public function siniestro(){
        return $this->belongsTo('App\Models\Siniestro', 'id_siniestro', 'id');
    }
 

}
?>