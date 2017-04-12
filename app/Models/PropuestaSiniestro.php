<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;
class PropuestaSiniestro extends Model {
    protected $table = 'PropuestaSiniestro';
    protected $fillable = array('asegurado',
    							'apoderado_legal', 
    							'estado', 
    							'ciudad', 
    							'domicilio', 
    							'fecha_siniestro', 
    							'num_poliza', 
    							'aseguradora', 
    							'honorarios_porcentaje', 
    							'honorarios_porcentaje_letra', 
    							'anticipo_cantidad', 
    							'anticipo_cantidad_letra', 
    							'num_personas_atencion', 
    							'id_promocion_siniestro'
    							);

    


}
?>