<?php 
class PropuestaSiniestro extends Eloquent {
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