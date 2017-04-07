<?php 
class FechasJuicios extends Eloquent {
    protected $table = 'FechasJuicios';
    protected $fillable = array('id_cliente',
                                'fecha_contrato_rechazo',
                                'fecha_presentacion_demanda',
                                'fecha_radicacion_demanda',
                                'fecha_emplazamiento',
                                'fecha_contestacion_demanda',
                                'fecha_notificacion_contestacion_demanda',
                                'fecha_desahogo_vista',
                                'fecha_apertura_periodo_probatorio',
                                'fecha_ofrecimiento_pruebas',
                                'observaciones',
                                'fecha_presentacion_alegatos',
                                'fecha_citacion_sentencia',
                                'fecha_sentencia_primera_instancia',
                                'fecha_notificacion_sentencia',
                                'fecha_presentacion_recursos_apelacion',
                                'fecha_recepcion_expediente_supremo_tribunal',
                                'fecha_ejecutoria',
                                'fecha_notificacion_ejecutoria',
                                'fecha_presentacion_amparo_directo',
                                'fecha_resolucion_amparo',
                                'fecha_interposicion_incidente_liquidacion_suerte_principal',
                                'fecha_pago_suerte_principal',
                                'fecha_interposicion_incidente_liquidacion_intereses',
                                'fecha_pago_intereses',
                                'fecha_interposicion_incidente_costas',
                                'fecha_pago_incidente_costas',
                                'fecha_ultimo_seguimiento',
                                'observaciones_ultimo_seguimiento',
                                'actividad_realizar_ultimo_seguimiento',
                                'fecha_conclusion'
                                );


}
?>