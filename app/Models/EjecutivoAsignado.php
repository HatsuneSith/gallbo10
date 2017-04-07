<?php 
class EjecutivoAsignado extends Eloquent {
    protected $table = 'EjecutivoAsignado';
    protected $fillable = array('id_siniestro',
    							'id_usuario'
                                );




}
?>