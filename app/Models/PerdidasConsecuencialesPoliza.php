<?php 
class PerdidasConsecuencialesPoliza extends Eloquent {
    protected $table = 'PerdidasConsecuencialesPoliza';
    protected $fillable = array('id_poliza',
                                'id_perdidas_consecuenciales', 
                                'periodo_indemnizacion'
                                );


    



}
?>