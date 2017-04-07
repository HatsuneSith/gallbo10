<?php 
class AcuerdosJuridico extends Eloquent {
    protected $table = 'AcuerdosJuridico';
    protected $fillable = array('id_cliente',
                                'mes',
                                'año',
                                'acuerdo',
                                'detalle',
                                'fecha_publicacion',
                                'fecha_surte_efecto',
                                'fecha_vencimiento_impulso',
                                'fecha_impulso',
                                'fecha_limite_acuerdo_impulso',
                                'fecha_acuerdo_impulso'
                                );

}
?>