@extends('layouts.master')

@section('title')
    Jurídico
@stop

@section('js')
    {{HTML::script('js/promocion.js')}}
@stop

@section('contenido')

	<div class="row">
		<div class="col-md-12">
			<h2 aria-hidden="true"><a href="{{ url('sire') }}"><span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span></a>Jurídico<img src="/img/logo_gallbo.png" alt="Gallbo"  align="right" class="img-responsive" style="max-height: 50px;"></h2> 

			<ol class="breadcrumb">
              <li>{{HTML::link( 'sire/juridico/tablero', 'Ver Tablero de Seguimientos',  ['class' => '', 'role' => '']) }}</li>
            </ol>
            {{Form::button('Agregar Nuevo Cliente', array('class'=>'btn-nuevoClienteJ btn btn-success', 'data-toggle' => 'modal', 'data-target'=>'#nuevoClienteJ-modal', 'data-backdrop' => 'static', 'data-keyboard' => 'false'))}} 

            <hr>
			@if(Session::get('info'))
            <div class="alert alert-success" >
                {{Session::get('info')}}
            </div>
            @endif
            @if(Session::get('danger'))
            <div class="alert alert-danger" >
                {{Session::get('danger')}}
            </div>
            @endif
			
            <h3>Juicios Provenientes De Asesoría Extrajudicial </h3>
			<div class="table-responsive">
				<table id="tabla_JuiciosExtrajudicial" class="table table-hover table-striped table-bordered">
					<thead>
						<tr>
							<th>Cliente</th>
							<th>Aseguradora</th>
							<th>Juzgado</th>
							<th>Expediente</th>
							<th>Fecha de Rechazo</th>
							<th>Presentación de Demanda</th>
							<th>Radicación de la Demanda</th>
                            <th>Fecha de Emplazamiento</th>
                            <th>Fecha de Contestación de la Demanda</th>
                            <th>Fecha de Notificación de Contestación de la Demanda</th>
                            <th>Fecha de Desahogo de Vista</th>
                            <th>Fecha de Apertura de Periodo Probatorio</th>
                            <th>Fecha de Ofrecimiento de Pruebas</th>
                            <th>Fechas y Detalles de Audiencias (Observaciones)</th>
                            <th>Fecha de Presentación de Alegatos</th>
                            <th>Fecha de Citación para Sentencia</th>
                            <th>Fecha de Sentencia Primera Instancia 1A</th>
                            <th>Fecha de Notificación de Sentencia</th>
                            <th>Fecha Presentación de Recurso de Apelación</th>
                            <th>Fecha de Recepción de Expediente en Supremo Tribunal</th>
                            <th>Fecha de Ejecutoria 2A</th>
                            <th>Fecha de Notificación de Ejecutoria STJ</th>
                            <th>Fecha de Presentación de Amparo Directo</th>
                            <th>Fecha de Resolución de Amparo</th>
                            <th>Fecha de Interposición de Incidente par Liquidar Suerte Principal</th>
                            <th>Fecha de Pago de Suerte Principal</th>
                            <th>Fecha de Interposición de Incidentes de Liquidación de Intereses</th>
                            <th>Fecha de Liquidación de Intereses</th>
                            <th>Fecha de Interposición de Incidente de Costas</th>
                            <th>Fecha de Liquidación de Incidente de Costas</th>
                            <th>Fecha de Ultimo Seguimiento</th>
                            <th>Días Transcurridos desde Ultimo Seguimiento</th>
                            <th>Observación de Ultimo Seguimiento</th>
                            <th>Actividad por Realizar De Acuerdo a Ultimo Seguimiento</th>
                            <th>Fecha de Conclusión</th>
                            <th>Tiempo Total de Juicio</th>
                            <th>Opciones</th>
						</tr>
					</thead>
					<tbody>
                        @foreach($juicios1 as $j1)
						<tr>
							<td>{{HTML::link( 'sire/juridico/juicio/'.$j1->id, $j1->cliente,  ['class' => '', 'role' => '']) }}</td>
							<td>{{$j1->aseguradora}}</td>
							<td>{{$j1->juzgado}}</td>
							<td>{{$j1->expediente}}</td>
							<td>
                                {{($j1->juicio()->first() != null) ? ($j1->juicio()->first()->fecha_contrato_rechazo != '0000-00-00 00:00:00') ? (new DateTime($j1->juicio()->first()->fecha_contrato_rechazo))->format('d/m/Y') : '' : '' }}
                            </td>
							<td>
                                {{($j1->juicio()->first() != null) ? ($j1->juicio()->first()->fecha_presentacion_demanda != '0000-00-00 00:00:00') ? (new DateTime($j1->juicio()->first()->fecha_presentacion_demanda))->format('d/m/Y') : '' : '' }}
                            </td>
							<td>
                                {{($j1->juicio()->first() != null) ? ($j1->juicio()->first()->fecha_radicacion_demanda != '0000-00-00 00:00:00') ? (new DateTime($j1->juicio()->first()->fecha_radicacion_demanda))->format('d/m/Y') : '' : '' }}
                            </td>
                            <td>
                                {{($j1->juicio()->first() != null) ? ($j1->juicio()->first()->fecha_emplazamiento != '0000-00-00 00:00:00') ? (new DateTime($j1->juicio()->first()->fecha_emplazamiento))->format('d/m/Y') : '' : '' }}
                            </td>
                            <td>
                                {{($j1->juicio()->first() != null) ? ($j1->juicio()->first()->fecha_contestacion_demanda != '0000-00-00 00:00:00') ? (new DateTime($j1->juicio()->first()->fecha_contestacion_demanda))->format('d/m/Y') : '' : '' }}
                            </td>
                            <td>
                                {{($j1->juicio()->first() != null) ? ($j1->juicio()->first()->fecha_notificacion_contestacion_demanda != '0000-00-00 00:00:00') ? (new DateTime($j1->juicio()->first()->fecha_notificacion_contestacion_demanda))->format('d/m/Y') : '' : '' }}
                            </td>
                            <td>
                                {{($j1->juicio()->first() != null) ? ($j1->juicio()->first()->fecha_desahogo_vista != '0000-00-00 00:00:00') ? (new DateTime($j1->juicio()->first()->fecha_desahogo_vista))->format('d/m/Y') : '' : '' }}
                            </td>
                            <td>
                                {{($j1->juicio()->first() != null) ? ($j1->juicio()->first()->fecha_apertura_periodo_probatorio != '0000-00-00 00:00:00') ? (new DateTime($j1->juicio()->first()->fecha_apertura_periodo_probatorio))->format('d/m/Y') : '' : '' }}
                            </td>
                            <td>
                                {{($j1->juicio()->first() != null) ? ($j1->juicio()->first()->fecha_ofrecimiento_pruebas != '0000-00-00 00:00:00') ? (new DateTime($j1->juicio()->first()->fecha_ofrecimiento_pruebas))->format('d/m/Y') : '' : '' }}
                            </td>
                            <td>{{$j1->juicio()->first()->observaciones or ''}}</td>
                            <td>
                                {{($j1->juicio()->first() != null) ? ($j1->juicio()->first()->fecha_presentacion_alegatos != '0000-00-00 00:00:00') ? (new DateTime($j1->juicio()->first()->fecha_presentacion_alegatos))->format('d/m/Y') : '' : '' }}
                            </td>
                            <td>
                                {{($j1->juicio()->first() != null) ? ($j1->juicio()->first()->fecha_citacion_sentencia != '0000-00-00 00:00:00') ? (new DateTime($j1->juicio()->first()->fecha_citacion_sentencia))->format('d/m/Y') : '' : '' }}
                            </td>
                            <td>
                                {{($j1->juicio()->first() != null) ? ($j1->juicio()->first()->fecha_sentencia_primera_instancia != '0000-00-00 00:00:00') ? (new DateTime($j1->juicio()->first()->fecha_sentencia_primera_instancia))->format('d/m/Y') : '' : '' }}
                            </td>
                            <td>
                                {{($j1->juicio()->first() != null) ? ($j1->juicio()->first()->fecha_notificacion_sentencia != '0000-00-00 00:00:00') ? (new DateTime($j1->juicio()->first()->fecha_notificacion_sentencia))->format('d/m/Y') : '' : '' }}
                            </td>
                            <td>
                                {{($j1->juicio()->first() != null) ? ($j1->juicio()->first()->fecha_presentacion_recursos_apelacion != '0000-00-00 00:00:00') ? (new DateTime($j1->juicio()->first()->fecha_presentacion_recursos_apelacion))->format('d/m/Y') : '' : '' }}
                            </td>
                            <td>
                                {{($j1->juicio()->first() != null) ? ($j1->juicio()->first()->fecha_recepcion_expediente_supremo_tribunal != '0000-00-00 00:00:00') ? (new DateTime($j1->juicio()->first()->fecha_recepcion_expediente_supremo_tribunal))->format('d/m/Y') : '' : '' }}
                            </td>
                            <td>
                                {{($j1->juicio()->first() != null) ? ($j1->juicio()->first()->fecha_ejecutoria != '0000-00-00 00:00:00') ? (new DateTime($j1->juicio()->first()->fecha_ejecutoria))->format('d/m/Y') : '' : '' }}
                            </td>
                            <td>
                                {{($j1->juicio()->first() != null) ? ($j1->juicio()->first()->fecha_notificacion_ejecutoria != '0000-00-00 00:00:00') ? (new DateTime($j1->juicio()->first()->fecha_notificacion_ejecutoria))->format('d/m/Y') : '' : '' }}
                            </td>
                            <td>
                                {{($j1->juicio()->first() != null) ? ($j1->juicio()->first()->fecha_presentacion_amparo_directo != '0000-00-00 00:00:00') ? (new DateTime($j1->juicio()->first()->fecha_presentacion_amparo_directo))->format('d/m/Y') : '' : '' }}
                            </td>
                            <td>
                                {{($j1->juicio()->first() != null) ? ($j1->juicio()->first()->fecha_resolucion_amparo != '0000-00-00 00:00:00') ? (new DateTime($j1->juicio()->first()->fecha_resolucion_amparo))->format('d/m/Y') : '' : '' }}
                            </td>
                            <td>
                                {{($j1->juicio()->first() != null) ? ($j1->juicio()->first()->fecha_interposicion_incidente_liquidacion_suerte_principal != '0000-00-00 00:00:00') ? (new DateTime($j1->juicio()->first()->fecha_interposicion_incidente_liquidacion_suerte_principal))->format('d/m/Y') : '' : '' }}
                            </td>
                            <td>
                                {{($j1->juicio()->first() != null) ? ($j1->juicio()->first()->fecha_pago_suerte_principal != '0000-00-00 00:00:00') ? (new DateTime($j1->juicio()->first()->fecha_pago_suerte_principal))->format('d/m/Y') : '' : '' }}
                            </td>
                            <td>
                                {{($j1->juicio()->first() != null) ? ($j1->juicio()->first()->fecha_interposicion_incidente_liquidacion_intereses != '0000-00-00 00:00:00') ? (new DateTime($j1->juicio()->first()->fecha_interposicion_incidente_liquidacion_intereses))->format('d/m/Y') : '' : '' }}
                            </td>
                            <td>
                                {{($j1->juicio()->first() != null) ? ($j1->juicio()->first()->fecha_pago_intereses != '0000-00-00 00:00:00') ? (new DateTime($j1->juicio()->first()->fecha_pago_intereses))->format('d/m/Y') : '' : '' }}
                            </td>
                            <td>
                                {{($j1->juicio()->first() != null) ? ($j1->juicio()->first()->fecha_interposicion_incidente_costas != '0000-00-00 00:00:00') ? (new DateTime($j1->juicio()->first()->fecha_interposicion_incidente_costas))->format('d/m/Y') : '' : '' }}
                            </td>
                            <td>
                                {{($j1->juicio()->first() != null) ? ($j1->juicio()->first()->fecha_pago_incidente_costas != '0000-00-00 00:00:00') ? (new DateTime($j1->juicio()->first()->fecha_pago_incidente_costas))->format('d/m/Y') : '' : '' }}
                            </td>
                            <td>
                                {{($j1->juicio()->first() != null) ? ($j1->juicio()->first()->fecha_ultimo_seguimiento != '0000-00-00 00:00:00') ? (new DateTime($j1->juicio()->first()->fecha_ultimo_seguimiento))->format('d/m/Y') : '' : '' }}
                            </td>
                            <td></td>
                            <td>{{$j1->juicio()->first()->observaciones_ultimo_seguimiento or ''}}</td>
                            <td>{{$j1->juicio()->first()->actividad_realizar_ultimo_seguimiento or ''}}</td>
                            <td>
                                {{($j1->juicio()->first() != null) ? ($j1->juicio()->first()->fecha_conclusion != '0000-00-00 00:00:00') ? (new DateTime($j1->juicio()->first()->fecha_conclusion))->format('d/m/Y') : '' : '' }}
                            </td>
                            <td></td>
                            <td>{{Form::button('Editar', array('class'=>'btn-editarFechasJ btn btn-primary btn-xs', 'data-toggle' => 'modal', 'data-target'=>'#editarFechasJ-modal', 'data-backdrop' => 'static', 'data-keyboard' => 'false', 'data-id' => $j1->id))}}</td>
						</tr>
                        @endforeach
					</tbody>
				</table>
			</div>
		</div>
	</div>
    <hr>
    <div class="row">
        <div class="col-md-12">
            <h3>Juicios Directamente Judicial</h3>
            <div class="table-responsive">
                <table id="tabla_JuiciosDirectamenteJudicial" class="table table-hover table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>Cliente</th>
                            <th>Aseguradora</th>
                            <th>Juzgado</th>
                            <th>Expediente</th>
                            <th>Fecha de Contrato</th>
                            <th>Presentación de Demanda</th>
                            <th>Radicación de la Demanda</th>
                            <th>Fecha de Emplazamiento</th>
                            <th>Fecha de Contestación a la Demanda</th>
                            <th>Fecha de Notificación de Contestación a la Demanda</th>
                            <th>Fecha de Desahogo de Vista</th>
                            <th>Fecha de Apertura de Periodo Probatorio</th>
                            <th>Fecha de Ofrecimiento de Pruebas</th>
                            <th>Fechas y Detalles de Audiencias (Observaciones)</th>
                            <th>Fecha de Presentación de Alegatos</th>
                            <th>Fecha de Citación para Sentencia</th>
                            <th>Fecha de Sentencia Primera Instancia 1A</th>
                            <th>Fecha de Notificación de Sentencia</th>
                            <th>Fecha Presentación de Recurso de Apelación</th>
                            <th>Fecha de Recepción de Expediente en Supremo Tribunal</th>
                            <th>Fecha de Ejecutoria 2A</th>
                            <th>Fecha de Notificación de Ejecutoria STJ</th>
                            <th>Fecha de Presentación de Amparo Directo</th>
                            <th>Fecha de Resolución de Amparo</th>
                            <th>Fecha de Interposición de Incidente par Liquidar Suerte Principal</th>
                            <th>Fecha de Pago de Suerte Principal</th>
                            <th>Fecha de Interposición de Incidentes de Liquidación de Intereses</th>
                            <th>Fecha de Liquidación de Intereses</th>
                            <th>Fecha de Interposición de Incidente de Costas</th>
                            <th>Fecha de Liquidación de Incidente de Costas</th>
                            <th>Fecha de Ultimo Seguimiento</th>
                            <th>Días Transcurridos desde Ultimo Seguimiento</th>
                            <th>Observación de Ultimo Seguimiento</th>
                            <th>Actividad por Realizar De Acuerdo a Ultimo Seguimiento</th>
                            <th>Fecha de Conclusión</th>
                            <th>Tiempo Total de Juicio</th>
                            <th>Opciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($juicios2 as $j2)
                        <tr>
                            <td>{{HTML::link( 'sire/juridico/juicio/'.$j2->id, $j2->cliente,  ['class' => '', 'role' => '']) }}</td>
                            <td>{{$j2->aseguradora}}</td>
                            <td>{{$j2->juzgado}}</td>
                            <td>{{$j2->expediente}}</td>
                            <td>
                                {{($j2->juicio()->first() != null) ? ($j2->juicio()->first()->fecha_contrato_rechazo != '0000-00-00 00:00:00') ? (new DateTime($j2->juicio()->first()->fecha_contrato_rechazo))->format('d/m/Y') : '' : '' }}
                            </td>
                            <td>
                                {{($j2->juicio()->first() != null) ? ($j2->juicio()->first()->fecha_presentacion_demanda != '0000-00-00 00:00:00') ? (new DateTime($j2->juicio()->first()->fecha_presentacion_demanda))->format('d/m/Y') : '' : '' }}
                            </td>
                            <td>
                                {{($j2->juicio()->first() != null) ? ($j2->juicio()->first()->fecha_radicacion_demanda != '0000-00-00 00:00:00') ? (new DateTime($j2->juicio()->first()->fecha_radicacion_demanda))->format('d/m/Y') : '' : '' }}
                            </td>
                            <td>
                                {{($j2->juicio()->first() != null) ? ($j2->juicio()->first()->fecha_emplazamiento != '0000-00-00 00:00:00') ? (new DateTime($j2->juicio()->first()->fecha_emplazamiento))->format('d/m/Y') : '' : '' }}
                            </td>
                            <td>
                                {{($j2->juicio()->first() != null) ? ($j2->juicio()->first()->fecha_contestacion_demanda != '0000-00-00 00:00:00') ? (new DateTime($j2->juicio()->first()->fecha_contestacion_demanda))->format('d/m/Y') : '' : '' }}
                            </td>
                            <td>
                                {{($j2->juicio()->first() != null) ? ($j2->juicio()->first()->fecha_notificacion_contestacion_demanda != '0000-00-00 00:00:00') ? (new DateTime($j2->juicio()->first()->fecha_notificacion_contestacion_demanda))->format('d/m/Y') : '' : '' }}
                            </td>
                            <td>
                                {{($j2->juicio()->first() != null) ? ($j2->juicio()->first()->fecha_desahogo_vista != '0000-00-00 00:00:00') ? (new DateTime($j2->juicio()->first()->fecha_desahogo_vista))->format('d/m/Y') : '' : '' }}
                            </td>
                            <td>
                                {{($j2->juicio()->first() != null) ? ($j2->juicio()->first()->fecha_apertura_periodo_probatorio != '0000-00-00 00:00:00') ? (new DateTime($j2->juicio()->first()->fecha_apertura_periodo_probatorio))->format('d/m/Y') : '' : '' }}
                            </td>
                            <td>
                                {{($j2->juicio()->first() != null) ? ($j2->juicio()->first()->fecha_ofrecimiento_pruebas != '0000-00-00 00:00:00') ? (new DateTime($j2->juicio()->first()->fecha_ofrecimiento_pruebas))->format('d/m/Y') : '' : '' }}
                            </td>
                            <td>{{$j2->juicio()->first()->observaciones or ''}}</td>
                            <td>
                                {{($j2->juicio()->first() != null) ? ($j2->juicio()->first()->fecha_presentacion_alegatos != '0000-00-00 00:00:00') ? (new DateTime($j2->juicio()->first()->fecha_presentacion_alegatos))->format('d/m/Y') : '' : '' }}
                            </td>
                            <td>
                                {{($j2->juicio()->first() != null) ? ($j2->juicio()->first()->fecha_citacion_sentencia != '0000-00-00 00:00:00') ? (new DateTime($j2->juicio()->first()->fecha_citacion_sentencia))->format('d/m/Y') : '' : '' }}
                            </td>
                            <td>
                                {{($j2->juicio()->first() != null) ? ($j2->juicio()->first()->fecha_sentencia_primera_instancia != '0000-00-00 00:00:00') ? (new DateTime($j2->juicio()->first()->fecha_sentencia_primera_instancia))->format('d/m/Y') : '' : '' }}
                            </td>
                            <td>
                                {{($j2->juicio()->first() != null) ? ($j2->juicio()->first()->fecha_notificacion_sentencia != '0000-00-00 00:00:00') ? (new DateTime($j2->juicio()->first()->fecha_notificacion_sentencia))->format('d/m/Y') : '' : '' }}
                            </td>
                            <td>
                                {{($j2->juicio()->first() != null) ? ($j2->juicio()->first()->fecha_presentacion_recursos_apelacion != '0000-00-00 00:00:00') ? (new DateTime($j2->juicio()->first()->fecha_presentacion_recursos_apelacion))->format('d/m/Y') : '' : '' }}
                            </td>
                            <td>
                                {{($j2->juicio()->first() != null) ? ($j2->juicio()->first()->fecha_recepcion_expediente_supremo_tribunal != '0000-00-00 00:00:00') ? (new DateTime($j2->juicio()->first()->fecha_recepcion_expediente_supremo_tribunal))->format('d/m/Y') : '' : '' }}
                            </td>
                            <td>
                                {{($j2->juicio()->first() != null) ? ($j2->juicio()->first()->fecha_ejecutoria != '0000-00-00 00:00:00') ? (new DateTime($j2->juicio()->first()->fecha_ejecutoria))->format('d/m/Y') : '' : '' }}
                            </td>
                            <td>
                                {{($j2->juicio()->first() != null) ? ($j2->juicio()->first()->fecha_notificacion_ejecutoria != '0000-00-00 00:00:00') ? (new DateTime($j2->juicio()->first()->fecha_notificacion_ejecutoria))->format('d/m/Y') : '' : '' }}
                            </td>
                            <td>
                                {{($j2->juicio()->first() != null) ? ($j2->juicio()->first()->fecha_presentacion_amparo_directo != '0000-00-00 00:00:00') ? (new DateTime($j2->juicio()->first()->fecha_presentacion_amparo_directo))->format('d/m/Y') : '' : '' }}
                            </td>
                            <td>
                                {{($j2->juicio()->first() != null) ? ($j2->juicio()->first()->fecha_resolucion_amparo != '0000-00-00 00:00:00') ? (new DateTime($j2->juicio()->first()->fecha_resolucion_amparo))->format('d/m/Y') : '' : '' }}
                            </td>
                            <td>
                                {{($j2->juicio()->first() != null) ? ($j2->juicio()->first()->fecha_interposicion_incidente_liquidacion_suerte_principal != '0000-00-00 00:00:00') ? (new DateTime($j2->juicio()->first()->fecha_interposicion_incidente_liquidacion_suerte_principal))->format('d/m/Y') : '' : '' }}
                            </td>
                            <td>
                                {{($j2->juicio()->first() != null) ? ($j2->juicio()->first()->fecha_pago_suerte_principal != '0000-00-00 00:00:00') ? (new DateTime($j2->juicio()->first()->fecha_pago_suerte_principal))->format('d/m/Y') : '' : '' }}
                            </td>
                            <td>
                                {{($j2->juicio()->first() != null) ? ($j2->juicio()->first()->fecha_interposicion_incidente_liquidacion_intereses != '0000-00-00 00:00:00') ? (new DateTime($j2->juicio()->first()->fecha_interposicion_incidente_liquidacion_intereses))->format('d/m/Y') : '' : '' }}
                            </td>
                            <td>
                                {{($j2->juicio()->first() != null) ? ($j2->juicio()->first()->fecha_pago_intereses != '0000-00-00 00:00:00') ? (new DateTime($j2->juicio()->first()->fecha_pago_intereses))->format('d/m/Y') : '' : '' }}
                            </td>
                            <td>
                                {{($j2->juicio()->first() != null) ? ($j2->juicio()->first()->fecha_interposicion_incidente_costas != '0000-00-00 00:00:00') ? (new DateTime($j2->juicio()->first()->fecha_interposicion_incidente_costas))->format('d/m/Y') : '' : '' }}
                            </td>
                            <td>
                                {{($j2->juicio()->first() != null) ? ($j2->juicio()->first()->fecha_pago_incidente_costas != '0000-00-00 00:00:00') ? (new DateTime($j2->juicio()->first()->fecha_pago_incidente_costas))->format('d/m/Y') : '' : '' }}
                            </td>
                            <td>
                                {{($j2->juicio()->first() != null) ? ($j2->juicio()->first()->fecha_ultimo_seguimiento != '0000-00-00 00:00:00') ? (new DateTime($j2->juicio()->first()->fecha_ultimo_seguimiento))->format('d/m/Y') : '' : '' }}
                            </td>
                            <td></td>
                            <td>{{$j2->juicio()->first()->observaciones_ultimo_seguimiento or ''}}</td>
                            <td>{{$j2->juicio()->first()->actividad_realizar_ultimo_seguimiento or ''}}</td>
                            <td>
                                {{($j2->juicio()->first() != null) ? ($j2->juicio()->first()->fecha_conclusion != '0000-00-00 00:00:00') ? (new DateTime($j2->juicio()->first()->fecha_conclusion))->format('d/m/Y') : '' : '' }}
                            </td>
                            <td></td>
                            <td>{{Form::button('Editar', array('class'=>'btn-editarFechasJ btn btn-primary btn-xs', 'data-toggle' => 'modal', 'data-target'=>'#editarFechasJ-modal', 'data-backdrop' => 'static', 'data-keyboard' => 'false', 'data-id' => $j2->id))}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <hr>
@stop


@section('modals')

<div class="modal fade nuevoClienteJ-modal" id="nuevoClienteJ-modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="H1">Agregar Cliente</h4>
            </div>
            <div class="modal-body">
                {{ Form::open(array('url' => 'sire/juridico/agregar')) }}
                
                <div class="row">
                    <div class="col-sm-6 col-md-12">
                        <div class="form-group">
                            {{Form::label('cliente', 'Nombre del Cliente', array('aria-hidden'=>'true'))}}
                            {{Form::text('cliente', '',  array('class'=>'form-control form-sin', 'placeholder'=>'Nombre del Cliente', 'autocomplete'=>'off', 'aria-label'=>'Nombre del Cliente', 'required'))}}
                            
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-12">
                        <div class="form-group">
                            {{Form::label('aseguradora', 'Nombre de la Aseguradora', array('aria-hidden'=>'true'))}}
                            {{Form::text('aseguradora', '',  array('class'=>'form-control form-sin', 'placeholder'=>'Nombre de la Aseguradora', 'autocomplete'=>'off', 'aria-label'=>'Nombre de la Aseguradora', 'required'))}}
                            
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-6">
                        <div class="form-group">
                            {{Form::label('juzgado', 'Juzgado', array('aria-hidden'=>'true'))}}
                            {{Form::text('juzgado', '',  array('class'=>'form-control form-sin', 'placeholder'=>'Juzgado', 'autocomplete'=>'off', 'aria-label'=>'Juzgado', 'required'))}}
                            
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-6">
                        <div class="form-group">
                            {{Form::label('expediente', 'Expediente', array('aria-hidden'=>'true'))}}
                            {{Form::text('expediente', '',  array('class'=>'form-control form-sin', 'placeholder'=>'Expediente', 'autocomplete'=>'off', 'aria-label'=>'Expediente', 'required'))}}
                            
                        </div>
                    </div>

                    <div class="col-sm-6 col-md-6">
                        <div class="form-group form-select" id="form-select">
                            {{Form::label('tipo_juicio', 'Tipo de Juicio', array('aria-hidden'=>'true'))}}
                            <select class="form-control form-sin" name="tipo_juicio" id="tipo_juicio" required>
                                <option value="">Seleccione el Tipo de Juicio </option>
                                <option value="1">Juicios Provenientes De Asesoría Extrajudicial</option>
                                <option value="2">Juicios Directamente Judicial</option>
                            </select>
                        </div>
                    </div>

                </div>


                <div id="form-btns-editar">
                    {{Form::submit('Aceptar', array('class'=>'btn btn-success', 'id'=>'btnActReclSin'))}}
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                </div>
                {{ Form::close() }}
            </div>

        </div>
    </div>
</div>

<div class="modal fade editarFechasJ-modal" id="editarFechasJ-modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="H1">Editar Fechas</h4>
            </div>
            <div class="modal-body">
                {{ Form::open(array('url' => 'sire/juridico/actualizar/juicio')) }}
                
                <div class="row">
                    <div class="col-sm-6 col-md-6">
                        <div class="form-group">
                            {{Form::label('fecha_contrato_rechazo', 'Fecha de Contrato/Rechazo')}}
                            {{Form::input('date', 'fecha_contrato_rechazo', '', ['class' => 'form-control', 'placeholder' => 'Date']);}}
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-6">
                        <div class="form-group">
                            {{Form::label('fecha_presentacion_demanda', 'Presentación de Demanda')}}
                            {{Form::input('date', 'fecha_presentacion_demanda', '', ['class' => 'form-control', 'placeholder' => 'Date']);}}
                        </div>
                    </div>

                    <div class="col-sm-6 col-md-6">
                        <div class="form-group">
                            {{Form::label('fecha_radicacion_demanda', 'Radicación de la Demanda')}}
                            {{Form::input('date', 'fecha_radicacion_demanda', '', ['class' => 'form-control', 'placeholder' => 'Date']);}}
                        </div>
                    </div>

                    <div class="col-sm-6 col-md-6">
                        <div class="form-group">
                            {{Form::label('fecha_emplazamiento', 'Fecha de Emplazamiento')}}
                            {{Form::input('date', 'fecha_emplazamiento', '', ['class' => 'form-control', 'placeholder' => 'Date']);}}
                        </div>
                    </div>

                    <div class="col-sm-6 col-md-6">
                        <div class="form-group">
                            {{Form::label('fecha_contestacion_demanda', 'Fecha de Contestación de la Demanda')}}
                            {{Form::input('date', 'fecha_contestacion_demanda', '', ['class' => 'form-control', 'placeholder' => 'Date']);}}
                        </div>
                    </div>

                    <div class="col-sm-6 col-md-6">
                        <div class="form-group">
                            {{Form::label('fecha_notificacion_contestacion_demanda', 'Fecha de Notificación de Contestación de la Demanda')}}
                            {{Form::input('date', 'fecha_notificacion_contestacion_demanda', '', ['class' => 'form-control', 'placeholder' => 'Date']);}}
                        </div>
                    </div>

                    <div class="col-sm-6 col-md-6">
                        <div class="form-group">
                            {{Form::label('fecha_desahogo_vista', 'Fecha de Desahogo de Vista')}}
                            {{Form::input('date', 'fecha_desahogo_vista', '', ['class' => 'form-control', 'placeholder' => 'Date']);}}
                        </div>
                    </div>

                    <div class="col-sm-6 col-md-6">
                        <div class="form-group">
                            {{Form::label('fecha_apertura_periodo_probatorio', 'Fecha de Apertura de Periodo Probatorio')}}
                            {{Form::input('date', 'fecha_apertura_periodo_probatorio', '', ['class' => 'form-control', 'placeholder' => 'Date']);}}
                        </div>
                    </div>

                    <div class="col-sm-6 col-md-6">
                        <div class="form-group">
                            {{Form::label('fecha_ofrecimiento_pruebas', 'Fecha de Ofrecimiento de Pruebas')}}
                            {{Form::input('date', 'fecha_ofrecimiento_pruebas', '', ['class' => 'form-control', 'placeholder' => 'Date']);}}
                        </div>
                    </div>

                    <div class="col-sm-12 col-md-12">
                        <div class="form-group">
                            {{Form::label('observaciones', 'Fechas y Detalles de Audiencias (Observaciones)', array('aria-hidden'=>'true'))}}
                            {{Form::textarea('observaciones', '', array('class'=>'form-control', 'rows'=>3, 'placeholder'=>'', 'autocomplete'=>'off', 'aria-label'=>''))}}
                        </div>
                    </div>

                    <div class="col-sm-6 col-md-6">
                        <div class="form-group">
                            {{Form::label('fecha_presentacion_alegatos', 'Fecha de Presentación de Alegatos')}}
                            {{Form::input('date', 'fecha_presentacion_alegatos', '', ['class' => 'form-control', 'placeholder' => 'Date']);}}
                        </div>
                    </div>

                    <div class="col-sm-6 col-md-6">
                        <div class="form-group">
                            {{Form::label('fecha_citacion_sentencia', 'Fecha de Citación para Sentencia')}}
                            {{Form::input('date', 'fecha_citacion_sentencia', '', ['class' => 'form-control', 'placeholder' => 'Date']);}}
                        </div>
                    </div>

                    <div class="col-sm-6 col-md-6">
                        <div class="form-group">
                            {{Form::label('fecha_sentencia_primera_instancia', 'Fecha de Sentencia Primera Instancia 1A')}}
                            {{Form::input('date', 'fecha_sentencia_primera_instancia', '', ['class' => 'form-control', 'placeholder' => 'Date']);}}
                        </div>
                    </div>

                    <div class="col-sm-6 col-md-6">
                        <div class="form-group">
                            {{Form::label('fecha_notificacion_sentencia', 'Fecha de Notificación de Sentencia')}}
                            {{Form::input('date', 'fecha_notificacion_sentencia', '', ['class' => 'form-control', 'placeholder' => 'Date']);}}
                        </div>
                    </div>

                    <div class="col-sm-6 col-md-6">
                        <div class="form-group">
                            {{Form::label('fecha_presentacion_recursos_apelacion', 'Fecha Presentación de Recurso de Apelación')}}
                            {{Form::input('date', 'fecha_presentacion_recursos_apelacion', '', ['class' => 'form-control', 'placeholder' => 'Date']);}}
                        </div>
                    </div>

                    <div class="col-sm-6 col-md-6">
                        <div class="form-group">
                            {{Form::label('fecha_recepcion_expediente_supremo_tribunal', 'Fecha de Recepción de Expediente en Supremo Tribunal')}}
                            {{Form::input('date', 'fecha_recepcion_expediente_supremo_tribunal', '', ['class' => 'form-control', 'placeholder' => 'Date']);}}
                        </div>
                    </div>

                    <div class="col-sm-6 col-md-6">
                        <div class="form-group">
                            {{Form::label('fecha_ejecutoria', 'Fecha de Ejecutoria 2A')}}
                            {{Form::input('date', 'fecha_ejecutoria', '', ['class' => 'form-control', 'placeholder' => 'Date']);}}
                        </div>
                    </div>

                    <div class="col-sm-6 col-md-6">
                        <div class="form-group">
                            {{Form::label('fecha_notificacion_ejecutoria', 'Fecha de Notificación de Ejecutoria STJ')}}
                            {{Form::input('date', 'fecha_notificacion_ejecutoria', '', ['class' => 'form-control', 'placeholder' => 'Date']);}}
                        </div>
                    </div>

                    <div class="col-sm-6 col-md-6">
                        <div class="form-group">
                            {{Form::label('fecha_presentacion_amparo_directo', 'Fecha de Presentación de Amparo Directo')}}
                            {{Form::input('date', 'fecha_presentacion_amparo_directo', '', ['class' => 'form-control', 'placeholder' => 'Date']);}}
                        </div>
                    </div>

                    <div class="col-sm-6 col-md-6">
                        <div class="form-group">
                            {{Form::label('fecha_resolucion_amparo', 'Fecha de Resolución de Amparo')}}
                            {{Form::input('date', 'fecha_resolucion_amparo', '', ['class' => 'form-control', 'placeholder' => 'Date']);}}
                        </div>
                    </div>

                    <div class="col-sm-6 col-md-6">
                        <div class="form-group">
                            {{Form::label('fecha_interposicion_incidente_liquidacion_suerte_principal', 'Fecha de Interposición de Incidente par Liquidar Suerte Principal')}}
                            {{Form::input('date', 'fecha_interposicion_incidente_liquidacion_suerte_principal', '', ['class' => 'form-control', 'placeholder' => 'Date']);}}
                        </div>
                    </div>

                    <div class="col-sm-6 col-md-6">
                        <div class="form-group">
                            {{Form::label('fecha_pago_suerte_principal', 'Fecha de Pago de Suerte Principal')}}
                            {{Form::input('date', 'fecha_pago_suerte_principal', '', ['class' => 'form-control', 'placeholder' => 'Date']);}}
                        </div>
                    </div>

                    <div class="col-sm-6 col-md-6">
                        <div class="form-group">
                            {{Form::label('fecha_interposicion_incidente_liquidacion_intereses', 'Fecha de Interposición de Incidentes de Liquidación de Intereses')}}
                            {{Form::input('date', 'fecha_interposicion_incidente_liquidacion_intereses', '', ['class' => 'form-control', 'placeholder' => 'Date']);}}
                        </div>
                    </div>

                    <div class="col-sm-6 col-md-6">
                        <div class="form-group">
                            {{Form::label('fecha_pago_intereses', 'Fecha de Liquidación de Intereses')}}
                            {{Form::input('date', 'fecha_pago_intereses', '', ['class' => 'form-control', 'placeholder' => 'Date']);}}
                        </div>
                    </div>

                    <div class="col-sm-6 col-md-6">
                        <div class="form-group">
                            {{Form::label('fecha_interposicion_incidente_costas', 'Fecha de Interposición de Incidente de Costas')}}
                            {{Form::input('date', 'fecha_interposicion_incidente_costas', '', ['class' => 'form-control', 'placeholder' => 'Date']);}}
                        </div>
                    </div>

                    <div class="col-sm-6 col-md-6">
                        <div class="form-group">
                            {{Form::label('fecha_pago_incidente_costas', 'Fecha de Liquidación de Incidente de Costas')}}
                            {{Form::input('date', 'fecha_pago_incidente_costas', '', ['class' => 'form-control', 'placeholder' => 'Date']);}}
                        </div>
                    </div>

                    <div class="col-sm-6 col-md-6">
                        <div class="form-group">
                            {{Form::label('fecha_ultimo_seguimiento', 'Fecha de Ultimo Seguimiento')}}
                            {{Form::input('date', 'fecha_ultimo_seguimiento', '', ['class' => 'form-control', 'placeholder' => 'Date']);}}
                        </div>
                    </div>

                    <div class="col-sm-12 col-md-12">
                        <div class="form-group">
                            {{Form::label('observaciones_ultimo_seguimiento', 'Observacion de Ultimo Seguimiento', array('aria-hidden'=>'true'))}}
                            {{Form::textarea('observaciones_ultimo_seguimiento', '', array('class'=>'form-control', 'rows'=>3, 'placeholder'=>'', 'autocomplete'=>'off', 'aria-label'=>''))}}
                        </div>
                    </div>

                    <div class="col-sm-12 col-md-12">
                        <div class="form-group">
                            {{Form::label('actividad_realizar_ultimo_seguimiento', 'Actividad por Realizar de Acuerdo a Ultimo Seguimiento', array('aria-hidden'=>'true'))}}
                            {{Form::textarea('actividad_realizar_ultimo_seguimiento', '', array('class'=>'form-control', 'rows'=>3, 'placeholder'=>'', 'autocomplete'=>'off', 'aria-label'=>''))}}
                        </div>
                    </div>

                    <div class="col-sm-6 col-md-6">
                        <div class="form-group">
                            {{Form::label('fecha_conclusion', 'Fecha de Conclusión')}}
                            {{Form::input('date', 'fecha_conclusion', '', ['class' => 'form-control', 'placeholder' => 'Date']);}}
                        </div>
                    </div>

                </div>

                <div class="hidden">
                    <input type="text" name="id" id="id" value=""/>
                </div>

                <div id="form-btns-editar">
                    {{Form::submit('Actualizar', array('class'=>'btn btn-success', 'id'=>'btnActReclSin'))}}
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                </div>
                {{ Form::close() }}
            </div>

        </div>
    </div>
</div>

@stop