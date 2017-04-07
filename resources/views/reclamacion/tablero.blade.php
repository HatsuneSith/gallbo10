@extends('layouts.master')

@section('title')
    Tablero de Seguimientos
@stop

@section('js')
    {{HTML::script('js/promocion.js')}}
@stop

@section('contenido')

	<div class="row">
		<div class="col-md-12">
			<h2 aria-hidden="true"><a href="{{ url('sire/reclamacion') }}"><span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span></a>Tablero de Seguimiento <img src="/img/logo_gallbo.png" alt="Gallbo"  align="right" class="img-responsive" style="max-height: 50px;"></h2> 
			{{Form::button('Agregar Siniestro No Registrado a Tablero', array('class'=>'btn-nuevoSinTableroR btn btn-success', 'data-toggle' => 'modal', 'data-target'=>'#nuevoSinTableroR-modal', 'data-backdrop' => 'static', 'data-keyboard' => 'false'))}}
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

            <ul>
            	<li>Numero de Clientes: {{count($siniestros) + count($siniestros_noresgistrados)}}</li>
            	<li>Días promedio fase de documentación: {{$dias_prom_doc}}</li>
				<li>% de avance a tiempo promedio: {{round($porc_avance_tiempo, 2)}}%</li>
				<li>% de casos con documentación entregada a tiempo: {{round($porc_casos_doc_tiempo, 2)}}%</li>
				<li>% de casos con fase de ajustador a tiempo: {{round($porc_casos_aju_tiempo, 2)}}%</li>
				<li>Días promedio de proceso de reclamación: {{$dias_prom_recl}}</li>
            </ul>

			<hr>
			
			<div class="table-responsive">
				<table id="tabla_tableroReclamacion" class="table table-hover table-striped table-bordered">
					<thead>
						<tr>
							<th>Id</th>
							<th>Cliente</th>
							<th>Ejecutivo</th>
							<th>Fecha de cierre de trato</th>
							<th>Firma de Contrato (fecha)</th>
							<th>Entrega de cartas a aseguradora (fecha)</th>
							<th>Elaboración de solicitud de documentos (fecha)</th>
							<th>Elaboración de cronograma (fecha)</th>
							<th>Documentos TOTALES por recabar</th>
							<th>Documentos por recabar AL DIA</th>
							<th>Documentos recabados AL DIA</th>
							<th>% de avance a tiempo</th>
							<th>Días fase de documentación</th>
							<th>Entrega  de reclamación parcial al ajustador (fecha)</th>
							<th>Entrega de reclamación total al ajustador (fecha)</th>
							<th>Fase de documentación a tiempo (S/N)</th>
							<th>Inicio de fase de ajustador (fecha)</th>
							<th>Registro de seguimientos al Ajustador</th>
							<th>Días fase ajustador</th>
							<th>Firma de convenio (fecha)</th>
							<th>Fase de ajustador a tiempo (S/N)</th>
							<th>Días TOTALES de proceso de reclamación</th>

							<th>Opciones</th>
						</tr>
					</thead>
					<tbody>
						@foreach($siniestros as $siniestro)
						<tr>
							<td>{{$siniestro->id }}</td>
							<td>
								@if($siniestro->id_asegurado != NULL)
									{{$siniestro->asegurado->nombre}}
								@endif
							</td>
							<td>
								@if(count($siniestro->ejecutivo_asignado()->get()) != 0)
									@foreach ($siniestro->ejecutivo_asignado()->get() as $ejecutivos)
										<li>{{$ejecutivos->nombre . " " . $ejecutivos->apellido}}</li>
									@endforeach
								@endif
							</td>
							<td>
								@if($siniestro->tablero != Null)
									@if($siniestro->tablero()->first()->cierre_trato != '0000-00-00 00:00:00')
										{{(new DateTime($siniestro->tablero()->first()->cierre_trato))->format('d/m/Y')}}
									@endif
								@endif
							</td>
							<td>
								@if($siniestro->tablero != Null)
									@if($siniestro->tablero()->first()->firma_contrato != '0000-00-00 00:00:00')
										{{(new DateTime($siniestro->tablero()->first()->firma_contrato))->format('d/m/Y')}}
									@endif
								@endif
							</td>
							<td>
								@if($siniestro->tablero != Null)
									@if($siniestro->tablero()->first()->entrega_cartas != '0000-00-00 00:00:00')
										{{(new DateTime($siniestro->tablero()->first()->entrega_cartas))->format('d/m/Y')}}
									@endif
								@endif
							</td>
							<td>
								@if($siniestro->tablero != Null)
									@if($siniestro->tablero()->first()->solicitud_documentos != '0000-00-00 00:00:00')
										{{(new DateTime($siniestro->tablero()->first()->solicitud_documentos))->format('d/m/Y')}}
									@endif
								@endif
							</td>
							<td>
								@if($siniestro->tablero != Null)
									@if($siniestro->tablero()->first()->elaboracion_cronograma != '0000-00-00 00:00:00')
										{{(new DateTime($siniestro->tablero()->first()->elaboracion_cronograma))->format('d/m/Y')}}
									@endif
								@endif
							</td>
							<td>
								{{count($siniestro->documentos()->get())}}
							</td>
							<td>
								{{count($siniestro->documentos()->wherePivot('entregado', Null)->get())}}
							</td>
							<td>
								{{count($siniestro->documentos()->wherePivot('entregado', 'OK')->get())}}
							</td>
							<td>
								@if(count($siniestro->documentos()->get()) > 0)
									{{round((100/count($siniestro->documentos()->get()))*count($siniestro->documentos()->wherePivot('entregado', 'OK')->get()), 2)}}%
								@endif
							</td>
							<td>
								@if($siniestro->tablero != Null)
									@if($siniestro->tablero()->first()->solicitud_documentos != '0000-00-00 00:00:00')
										@if($siniestro->tablero()->first()->entrega_reclamacion_total != '0000-00-00 00:00:00')
										{{(new DateTime($siniestro->tablero()->first()->solicitud_documentos))->diff(new DateTime($siniestro->tablero()->first()->entrega_reclamacion_total))->format('%a dias')}}
										@else
											{{(new DateTime($siniestro->tablero()->first()->solicitud_documentos))->diff(new DateTime())->format('%a dias')}}
										@endif
									@endif
								@endif
							</td>
							<td>
								@if($siniestro->tablero != Null)
									@if($siniestro->tablero()->first()->entrega_reclamacion_parcial != '0000-00-00 00:00:00')
										{{(new DateTime($siniestro->tablero()->first()->entrega_reclamacion_parcial))->format('d/m/Y')}}
									@endif
								@endif
							</td>
							<td>
								@if($siniestro->tablero != Null)
									@if($siniestro->tablero()->first()->entrega_reclamacion_total != '0000-00-00 00:00:00')
										{{(new DateTime($siniestro->tablero()->first()->entrega_reclamacion_total))->format('d/m/Y')}}
									@endif
								@endif
							</td>
							<td>
								@if($siniestro->tablero != Null)
									@if($siniestro->tablero()->first()->solicitud_documentos != '0000-00-00 00:00:00')
										@if($siniestro->tablero()->first()->entrega_reclamacion_total != '0000-00-00 00:00:00')
											@if((new DateTime($siniestro->tablero()->first()->solicitud_documentos))->diff(new DateTime($siniestro->tablero()->first()->entrega_reclamacion_total))->format('%a') <= 60)
												{{'Si'}}
											@else
												{{'NO'}}
											@endif
										@else
											@if((new DateTime($siniestro->tablero()->first()->solicitud_documentos))->diff(new DateTime())->format('%a') <= 60)
												{{'Si'}}
											@else
												{{'NO'}}
											@endif
										@endif
									@endif
								@endif
							</td>
							<td>
								@if($siniestro->tablero != Null)
									@if($siniestro->tablero()->first()->inicio_fase_ajustador != '0000-00-00 00:00:00')
										{{(new DateTime($siniestro->tablero()->first()->inicio_fase_ajustador))->format('d/m/Y')}}
									@endif
								@endif
							</td>
							<td>
								@if(count($siniestro->bitacora()->get()) > 0)
								<ul>
							        @foreach($siniestro->bitacora()->get() as $bitacora)
							        	<li>{{$bitacora->comentario}}</li>
							        @endforeach
							    </ul>
							    @endif
							</td>
							<td>
								@if($siniestro->tablero != Null)
									@if($siniestro->tablero()->first()->inicio_fase_ajustador != '0000-00-00 00:00:00')
										@if($siniestro->tablero()->first()->firma_convenio != '0000-00-00 00:00:00')
										{{(new DateTime($siniestro->tablero()->first()->inicio_fase_ajustador))->diff(new DateTime($siniestro->tablero()->first()->firma_convenio))->format('%a dias')}}
										@else
											{{(new DateTime($siniestro->tablero()->first()->inicio_fase_ajustador))->diff(new DateTime())->format('%a dias')}}
										@endif
									@else
									{{'En etapa de documentación'}}
									@endif
								@endif
							</td>
							<td>
								@if($siniestro->tablero != Null)
									@if($siniestro->tablero()->first()->firma_convenio != '0000-00-00 00:00:00')
									{{(new DateTime($siniestro->tablero()->first()->firma_convenio))->format('d/m/Y')}}
									@endif
								@endif
							</td>
							<td>
								@if($siniestro->tablero != Null)
									@if($siniestro->tablero()->first()->inicio_fase_ajustador != '0000-00-00 00:00:00')
										@if($siniestro->tablero()->first()->firma_convenio != '0000-00-00 00:00:00')
											@if((new DateTime($siniestro->tablero()->first()->inicio_fase_ajustador))->diff(new DateTime($siniestro->tablero()->first()->firma_convenio))->format('%a') <= 150)
												{{'Si'}}
											@else
												{{'NO'}}
											@endif
										@else
											@if((new DateTime($siniestro->tablero()->first()->inicio_fase_ajustador))->diff(new DateTime())->format('%a') <= 150)
												{{'Si'}}
											@else
												{{'NO'}}
											@endif
										@endif
									@endif
								@endif
							</td>
							<td>
								@if($siniestro->tablero != Null)
									@if($siniestro->tablero()->first()->cierre_trato != '0000-00-00 00:00:00')
										@if($siniestro->tablero()->first()->firma_convenio != '0000-00-00 00:00:00')
										{{(new DateTime($siniestro->tablero()->first()->cierre_trato))->diff(new DateTime($siniestro->tablero()->first()->firma_convenio))->format('%a dias')}}
										@else
											{{(new DateTime($siniestro->tablero()->first()->cierre_trato))->diff(new DateTime())->format('%a dias')}}
										@endif
									@endif
								@endif
							</td>
							<td>
								{{Form::button('Editar', array('class'=>'btn-editarTableroR btn btn-primary btn-xs', 'data-toggle' => 'modal', 'data-target'=>'#editarTableroR-modal', 'data-backdrop' => 'static', 'data-keyboard' => 'false', 'data-id' => $siniestro->id))}}
							</td>
						</tr>
						@endforeach
					</tbody>
				</table>
			</div>
			<hr>
			<div class="table-responsive">
				<table id="tabla_tableroSiniestrosNR" class="table table-hover table-striped table-bordered">
					<thead>
						<tr>
							<th>Id</th>
							<th>Cliente</th>
							<th>Ejecutivo</th>
							<th>Fecha de cierre de trato</th>
							<th>Firma de Contrato (fecha)</th>
							<th>Entrega de cartas a aseguradora (fecha)</th>
							<th>Elaboración de solicitud de documentos (fecha)</th>
							<th>Elaboración de cronograma (fecha)</th>
							<th>Documentos TOTALES por recabar</th>
							<th>Documentos por recabar AL DIA</th>
							<th>Documentos recabados AL DIA</th>
							<th>% de avance a tiempo</th>
							<th>Días fase de documentación</th>
							<th>Entrega  de reclamación parcial al ajustador (fecha)</th>
							<th>Entrega de reclamación total al ajustador (fecha)</th>
							<th>Fase de documentación a tiempo (S/N)</th>
							<th>Inicio de fase de ajustador (fecha)</th>
							<th>Registro de seguimientos al Ajustador</th>
							<th>Días fase ajustador</th>
							<th>Firma de convenio (fecha)</th>
							<th>Fase de ajustador a tiempo (S/N)</th>
							<th>Días TOTALES de proceso de reclamación</th>
							<th>Opciones</th>
						</tr>
					</thead>
					<tbody>
						@foreach($siniestros_noresgistrados as $snr)
						<tr>
							<td>{{$snr->id }}</td>
							<td>
								{{$snr->asegurado}}
							</td>
							<td>
								<li>{{$snr->ejecutivo}}</li>
							</td>
							<td>
								@if($snr->cierre_trato != '0000-00-00 00:00:00')
									{{(new DateTime($snr->cierre_trato))->format('d/m/Y')}}
								@endif
							</td>
							<td>
								@if($snr->firma_contrato != '0000-00-00 00:00:00')
									{{(new DateTime($snr->firma_contrato))->format('d/m/Y')}}
								@endif
							</td>
							<td>
								@if($snr->entrega_cartas != '0000-00-00 00:00:00')
									{{(new DateTime($snr->entrega_cartas))->format('d/m/Y')}}
								@endif
							</td>
							<td>
								@if($snr->solicitud_documentos != '0000-00-00 00:00:00')
									{{(new DateTime($snr->solicitud_documentos))->format('d/m/Y')}}
								@endif
							</td>
							<td>
								@if($snr->elaboracion_cronograma != '0000-00-00 00:00:00')
									{{(new DateTime($snr->elaboracion_cronograma))->format('d/m/Y')}}
								@endif
							</td>
							<td>
								{{$snr->doc_totales}}
							</td>
							<td>
								{{$snr->doc_totales - $snr->doc_recabados}}
							</td>
							<td>
								{{$snr->doc_recabados}}
							</td>
							<td>
								@if($snr->doc_totales > 0)
									{{round((100/$snr->doc_totales)*$snr->doc_recabados, 2)}}%
								@endif
							</td>
							<td>
								@if($snr->solicitud_documentos != '0000-00-00 00:00:00')
									@if($snr->entrega_reclamacion_total != '0000-00-00 00:00:00')
									{{(new DateTime($snr->solicitud_documentos))->diff(new DateTime($snr->entrega_reclamacion_total))->format('%a dias')}}
									@else
										{{(new DateTime($snr->solicitud_documentos))->diff(new DateTime())->format('%a dias')}}
									@endif
								@endif
							</td>
							<td>
								@if($snr->entrega_reclamacion_parcial != '0000-00-00 00:00:00')
									{{(new DateTime($snr->entrega_reclamacion_parcial))->format('d/m/Y')}}
								@endif
							</td>
							<td>
								@if($snr->entrega_reclamacion_total != '0000-00-00 00:00:00')
									{{(new DateTime($snr->entrega_reclamacion_total))->format('d/m/Y')}}
								@endif
							</td>
							<td>
								@if($snr->solicitud_documentos != '0000-00-00 00:00:00')
									@if($snr->entrega_reclamacion_total != '0000-00-00 00:00:00')
										@if((new DateTime($snr->solicitud_documentos))->diff(new DateTime($snr->entrega_reclamacion_total))->format('%a') <= 60)
											{{'Si'}}
										@else
											{{'NO'}}
										@endif
									@else
										@if((new DateTime($snr->solicitud_documentos))->diff(new DateTime())->format('%a') <= 60)
											{{'Si'}}
										@else
											{{'NO'}}
										@endif
									@endif
								@endif
							</td>
							<td>
								@if($snr->inicio_fase_ajustador != '0000-00-00 00:00:00')
									{{(new DateTime($snr->inicio_fase_ajustador))->format('d/m/Y')}}
								@endif
							</td>
							<td>
								{{nl2br($snr->bitacora)}}
							</td>
							<td>
								@if($snr->inicio_fase_ajustador != '0000-00-00 00:00:00')
									@if($snr->firma_convenio != '0000-00-00 00:00:00')
									{{(new DateTime($snr->inicio_fase_ajustador))->diff(new DateTime($snr->firma_convenio))->format('%a dias')}}
									@else
										{{(new DateTime($snr->inicio_fase_ajustador))->diff(new DateTime())->format('%a dias')}}
									@endif
								@else
								{{'En etapa de documentación'}}
								@endif
							</td>
							<td>
								@if($snr->firma_convenio != '0000-00-00 00:00:00')
								{{(new DateTime($snr->firma_convenio))->format('d/m/Y')}}
								@endif
							</td>
							<td>
								@if($snr->inicio_fase_ajustador != '0000-00-00 00:00:00')
									@if($snr->firma_convenio != '0000-00-00 00:00:00')
										@if((new DateTime($snr->inicio_fase_ajustador))->diff(new DateTime($snr->firma_convenio))->format('%a') <= 150)
											{{'Si'}}
										@else
											{{'NO'}}
										@endif
									@else
										@if((new DateTime($snr->inicio_fase_ajustador))->diff(new DateTime())->format('%a') <= 150)
											{{'Si'}}
										@else
											{{'NO'}}
										@endif
									@endif
								@endif
							</td>
							<td>
								@if($snr->cierre_trato != '0000-00-00 00:00:00')
									@if($snr->firma_convenio != '0000-00-00 00:00:00')
									{{(new DateTime($snr->cierre_trato))->diff(new DateTime($snr->firma_convenio))->format('%a dias')}}
									@else
										{{(new DateTime($snr->cierre_trato))->diff(new DateTime())->format('%a dias')}}
									@endif
								@endif
							</td>
							<td>
								{{Form::button('Editar', array('class'=>'btn-editarSinTableroR btn btn-primary btn-xs', 'data-toggle' => 'modal', 'data-target'=>'#editarSinTableroR-modal', 'data-backdrop' => 'static', 'data-keyboard' => 'false', 'data-id' => $snr->id))}}
							</td>
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
<div class="modal fade editarTableroR-modal" id="editarTableroR-modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="H1">Actualizar Tablero</h4>
            </div>
            <div class="modal-body">
                {{ Form::open(array('url' => 'sire/reclamacion/siniestro/actualizar/tablero/')) }}
                
                <div class="row">
                    <div class="col-sm-6 col-md-4">
                        <div class="form-group">
                            {{Form::label('cierre_trato', 'Cierre de Trato')}}
                            {{Form::input('date', 'cierre_trato', '', ['class' => 'form-control', 'placeholder' => 'Date']);}}
                        </div>
                    </div>

                    <div class="col-sm-6 col-md-4">
                        <div class="form-group">
                            {{Form::label('firma_contrato', 'Firma de Contrato')}}
                            {{Form::input('date', 'firma_contrato', '', ['class' => 'form-control', 'placeholder' => 'Date']);}}
                        </div>
                    </div>

                    <div class="col-sm-6 col-md-4">
                        <div class="form-group">
                            {{Form::label('entrega_cartas', 'Fecha Entrega de Cartas')}}
                            {{Form::input('date', 'entrega_cartas', '', ['class' => 'form-control', 'placeholder' => 'Date']);}}
                        </div>
                    </div>

                    <div class="col-sm-6 col-md-4">
                        <div class="form-group">
                            {{Form::label('solicitud_documentos', 'Solicitud de Documentos')}}
                            {{Form::input('date', 'solicitud_documentos', '', ['class' => 'form-control', 'placeholder' => 'Date']);}}
                        </div>
                    </div>

                    <div class="col-sm-6 col-md-4">
                        <div class="form-group">
                            {{Form::label('elaboracion_cronograma', 'Elaboracion de Cronograma')}}
                            {{Form::input('date', 'elaboracion_cronograma', '', ['class' => 'form-control', 'placeholder' => 'Date']);}}
                        </div>
                    </div>

                    <div class="col-sm-6 col-md-4">
                        <div class="form-group">
                            {{Form::label('entrega_reclamacion_parcial', 'Entrega Reclamacion Parcial')}}
                            {{Form::input('date', 'entrega_reclamacion_parcial', '', ['class' => 'form-control', 'placeholder' => 'Date']);}}
                        </div>
                    </div>

                    <div class="col-sm-6 col-md-4">
                        <div class="form-group">
                            {{Form::label('entrega_reclamacion_total', 'Entrega Reclamacion Total')}}
                            {{Form::input('date', 'entrega_reclamacion_total', '', ['class' => 'form-control', 'placeholder' => 'Date']);}}
                        </div>
                    </div>

                    <div class="col-sm-6 col-md-4">
                        <div class="form-group">
                            {{Form::label('inicio_fase_ajustador', 'Inicio Fase Ajustador')}}
                            {{Form::input('date', 'inicio_fase_ajustador', '', ['class' => 'form-control', 'placeholder' => 'Date']);}}
                        </div>
                    </div>

                    <div class="col-sm-6 col-md-4">
                        <div class="form-group">
                            {{Form::label('firma_convenio', 'Firma del Convenio')}}
                            {{Form::input('date', 'firma_convenio', '', ['class' => 'form-control', 'placeholder' => 'Date']);}}
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

<!-- Agregar siniestro no registrado a tablero -->

<div class="modal fade nuevoSinTableroR-modal" id="nuevoSinTableroR-modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="H1">Agregar Tablero</h4>
            </div>
            <div class="modal-body">
                {{ Form::open(array('url' => 'sire/reclamacion/siniestro/agregar/tablero/')) }}
                
                <div class="row">
                	<div class="col-sm-6 col-md-6">
                        <div class="form-group">
                            {{Form::label('asegurado', 'Nombre o Razon Social', array('aria-hidden'=>'true'))}}
                            {{Form::text('asegurado', '',  array('class'=>'form-control form-sin', 'placeholder'=>'Nombre o Razon Social', 'autocomplete'=>'off', 'aria-label'=>'Nombre o Razon Social', 'required'))}}
                        </div>
                    </div>

                    <div class="col-sm-6 col-md-6">
                        <div class="form-group">
                            {{Form::label('ejecutivo', 'Ejecutivo', array('aria-hidden'=>'true'))}}
                            {{Form::text('ejecutivo', '',  array('class'=>'form-control form-sin', 'placeholder'=>'Ejecutivo', 'autocomplete'=>'off', 'aria-label'=>'Ejecutivo', 'required'))}}
                        </div>
                    </div>

                    <div class="col-sm-6 col-md-4">
                        <div class="form-group">
                            {{Form::label('cierre_trato', 'Cierre de Trato')}}
                            {{Form::input('date', 'cierre_trato', '', ['class' => 'form-control', 'placeholder' => 'Date']);}}
                        </div>
                    </div>

                    <div class="col-sm-6 col-md-4">
                        <div class="form-group">
                            {{Form::label('firma_contrato', 'Firma de Contrato')}}
                            {{Form::input('date', 'firma_contrato', '', ['class' => 'form-control', 'placeholder' => 'Date']);}}
                        </div>
                    </div>

                    <div class="col-sm-6 col-md-4">
                        <div class="form-group">
                            {{Form::label('entrega_cartas', 'Fecha Entrega de Cartas')}}
                            {{Form::input('date', 'entrega_cartas', '', ['class' => 'form-control', 'placeholder' => 'Date']);}}
                        </div>
                    </div>

                    <div class="col-sm-6 col-md-4">
                        <div class="form-group">
                            {{Form::label('solicitud_documentos', 'Solicitud de Documentos')}}
                            {{Form::input('date', 'solicitud_documentos', '', ['class' => 'form-control', 'placeholder' => 'Date']);}}
                        </div>
                    </div>

                    <div class="col-sm-6 col-md-4">
                        <div class="form-group">
                            {{Form::label('elaboracion_cronograma', 'Elaboracion de Cronograma')}}
                            {{Form::input('date', 'elaboracion_cronograma', '', ['class' => 'form-control', 'placeholder' => 'Date']);}}
                        </div>
                    </div>

                    <div class="col-sm-4 col-md-2">
                        <div class="form-group">
                            {{Form::label('doc_totales', 'Doc Totales', array('aria-hidden'=>'true'))}}
                            {{Form::number('doc_totales', '',  array('class'=>'form-control form-sin', 'autocomplete'=>'off', 'aria-label'=>'Doc Totales'))}}
                        </div>
                    </div>

                    <div class="col-sm-4 col-md-2">
                        <div class="form-group">
                            {{Form::label('dos_recabados', 'Doc Recabados', array('aria-hidden'=>'true'))}}
                            {{Form::number('dos_recabados', '',  array('class'=>'form-control form-sin', 'autocomplete'=>'off', 'aria-label'=>'Doc Recabados'))}}
                        </div>
                    </div>

                    <div class="col-sm-6 col-md-4">
                        <div class="form-group">
                            {{Form::label('entrega_reclamacion_parcial', 'Entrega Reclamacion Parcial')}}
                            {{Form::input('date', 'entrega_reclamacion_parcial', '', ['class' => 'form-control', 'placeholder' => 'Date']);}}
                        </div>
                    </div>

                    <div class="col-sm-6 col-md-4">
                        <div class="form-group">
                            {{Form::label('entrega_reclamacion_total', 'Entrega Recl. Total / Inicio Fase Ajustador')}}
                            {{Form::input('date', 'entrega_reclamacion_total', '', ['class' => 'form-control', 'placeholder' => 'Date']);}}
                        </div>
                    </div>

                    <div class="col-sm-6 col-md-4">
                        <div class="form-group">
                            {{Form::label('firma_convenio', 'Firma del Convenio')}}
                            {{Form::input('date', 'firma_convenio', '', ['class' => 'form-control', 'placeholder' => 'Date']);}}
                        </div>
                    </div>

                    <div class="col-sm-12 col-md-12">
                        <div class="form-group">
                            {{Form::label('bitacora', 'Bitacora / Registro de seguimientos al Ajustador', array('aria-hidden'=>'true'))}}
                            {{Form::textarea('bitacora', '', array('class'=>'form-control', 'rows'=>3, 'placeholder'=>'', 'autocomplete'=>'off', 'aria-label'=>''))}}
                        </div>
                    </div>

                </div>

                <div id="form-btns-editar">
                    {{Form::submit('Agregar', array('class'=>'btn btn-success', 'id'=>'btnActReclSin'))}}
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                </div>
                {{ Form::close() }}
            </div>

        </div>
    </div>
</div>

<div class="modal fade editarSinTableroR-modal" id="editarSinTableroR-modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="H1">Agregar Tablero</h4>
            </div>
            <div class="modal-body">
                {{ Form::open(array('url' => 'sire/reclamacion/siniestro/actualizar/sin_tablero/')) }}
                
                <div class="row">
                	<div class="col-sm-6 col-md-6">
                        <div class="form-group">
                            {{Form::label('asegurado', 'Nombre o Razon Social', array('aria-hidden'=>'true'))}}
                            {{Form::text('asegurado', '',  array('class'=>'form-control form-sin', 'placeholder'=>'Nombre o Razon Social', 'autocomplete'=>'off', 'aria-label'=>'Nombre o Razon Social', 'required'))}}
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-6">
                        <div class="form-group">
                            {{Form::label('ejecutivo', 'Ejecutivo', array('aria-hidden'=>'true'))}}
                            {{Form::text('ejecutivo', '',  array('class'=>'form-control form-sin', 'placeholder'=>'Ejecutivo', 'autocomplete'=>'off', 'aria-label'=>'Ejecutivo', 'required'))}}
                        </div>
                    </div>

                    <div class="col-sm-6 col-md-4">
                        <div class="form-group">
                            {{Form::label('cierre_trato', 'Cierre de Trato')}}
                            {{Form::input('date', 'cierre_trato', '', ['class' => 'form-control', 'placeholder' => 'Date']);}}
                        </div>
                    </div>

                    <div class="col-sm-6 col-md-4">
                        <div class="form-group">
                            {{Form::label('firma_contrato', 'Firma de Contrato')}}
                            {{Form::input('date', 'firma_contrato', '', ['class' => 'form-control', 'placeholder' => 'Date']);}}
                        </div>
                    </div>

                    <div class="col-sm-6 col-md-4">
                        <div class="form-group">
                            {{Form::label('entrega_cartas', 'Fecha Entrega de Cartas')}}
                            {{Form::input('date', 'entrega_cartas', '', ['class' => 'form-control', 'placeholder' => 'Date']);}}
                        </div>
                    </div>

                    <div class="col-sm-6 col-md-4">
                        <div class="form-group">
                            {{Form::label('solicitud_documentos', 'Solicitud de Documentos')}}
                            {{Form::input('date', 'solicitud_documentos', '', ['class' => 'form-control', 'placeholder' => 'Date']);}}
                        </div>
                    </div>

                    <div class="col-sm-6 col-md-4">
                        <div class="form-group">
                            {{Form::label('elaboracion_cronograma', 'Elaboracion de Cronograma')}}
                            {{Form::input('date', 'elaboracion_cronograma', '', ['class' => 'form-control', 'placeholder' => 'Date']);}}
                        </div>
                    </div>

                    <div class="col-sm-4 col-md-2">
                        <div class="form-group">
                            {{Form::label('doc_totales', 'Doc Totales', array('aria-hidden'=>'true'))}}
                            {{Form::number('doc_totales', '',  array('class'=>'form-control form-sin', 'autocomplete'=>'off', 'aria-label'=>'Doc Totales'))}}
                        </div>
                    </div>

                    <div class="col-sm-4 col-md-2">
                        <div class="form-group">
                            {{Form::label('dos_recabados', 'Doc Recabados', array('aria-hidden'=>'true'))}}
                            {{Form::number('dos_recabados', '',  array('class'=>'form-control form-sin', 'autocomplete'=>'off', 'aria-label'=>'Doc Recabados'))}}
                        </div>
                    </div>

                    <div class="col-sm-6 col-md-4">
                        <div class="form-group">
                            {{Form::label('entrega_reclamacion_parcial', 'Entrega Reclamacion Parcial')}}
                            {{Form::input('date', 'entrega_reclamacion_parcial', '', ['class' => 'form-control', 'placeholder' => 'Date']);}}
                        </div>
                    </div>

                    <div class="col-sm-6 col-md-4">
                        <div class="form-group">
                            {{Form::label('entrega_reclamacion_total', 'Entrega Recl. Total / Inicio Fase Ajustador')}}
                            {{Form::input('date', 'entrega_reclamacion_total', '', ['class' => 'form-control', 'placeholder' => 'Date']);}}
                        </div>
                    </div>

                    <div class="col-sm-6 col-md-4">
                        <div class="form-group">
                            {{Form::label('firma_convenio', 'Firma del Convenio')}}
                            {{Form::input('date', 'firma_convenio', '', ['class' => 'form-control', 'placeholder' => 'Date']);}}
                        </div>
                    </div>

                    <div class="col-sm-12 col-md-12">
                        <div class="form-group">
                            {{Form::label('bitacora', 'Bitacora / Registro de seguimientos al Ajustador', array('aria-hidden'=>'true'))}}
                            {{Form::textarea('bitacora', '', array('class'=>'form-control', 'rows'=>3, 'placeholder'=>'', 'autocomplete'=>'off', 'aria-label'=>''))}}
                        </div>
                    </div>

                </div>

                <div class="hidden">
                <input type="text" name="id" id="id" value=""/>
                </div>

                <div id="form-btns-editar">
                    {{Form::submit('Agregar', array('class'=>'btn btn-success', 'id'=>'btnActReclSin'))}}
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                </div>
                {{ Form::close() }}
            </div>

        </div>
    </div>
</div>

@stop


