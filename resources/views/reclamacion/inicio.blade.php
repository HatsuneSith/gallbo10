@extends('layouts.master')

@section('title')
    Siniestros
@stop

@section('js')
    {{HTML::script('js/promocion.js')}}
@stop

@section('contenido')

	<div class="row">
		<div class="col-md-12">
			<h2 aria-hidden="true"><a href="{{ url('sire') }}"><span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span></a>Siniestros<img src="/img/logo_gallbo.png" alt="Gallbo"  align="right" class="img-responsive" style="max-height: 50px;"></h2> 

			<ol class="breadcrumb">
              <li>{{HTML::link( 'sire/reclamacion/tablero', 'Ver Tablero de Seguimientos',  ['class' => '', 'role' => '']) }}</li>
            </ol>
            {{Form::button('Agregar Nuevo Siniestro', array('class'=>'btn-nuevoSiniestroR btn btn-success', 'data-toggle' => 'modal', 'data-target'=>'#nuevoSiniestroR-modal', 'data-backdrop' => 'static', 'data-keyboard' => 'false'))}}

            <hr>
			@if(Session::get('info'))
            <div class="alert alert-success" >
                {{Session::get('info')}}
            </div>
            <audio src="../audio/success.mp3" autoplay>
            </audio>
            @endif
            @if(Session::get('danger'))
            <div class="alert alert-danger" >
                {{Session::get('danger')}}
            </div>
            @endif
			
			<div class="table-responsive">
				<table id="tabla_promSiniestros" class="table table-hover table-striped table-bordered">
					<thead>
						<tr>
							<th>Id</th>
							<th>Asegurado</th>
							<th>Aseguradora</th>
							<th>Ajustador</th>
							<th>Poliza</th>
							<th>No. de Averiguacion</th>
							<th>Opciones</th>
						</tr>
					</thead>
					<tbody>
						@foreach($siniestros as $siniestro)
						<tr>
							<td><?php echo $siniestro->id ?></td>
							<td><?php if($siniestro->id_asegurado != NULL){ echo $siniestro->asegurado->nombre; } ?></td>
							<td><?php if($siniestro->id_aseguradora != NULL){ echo $siniestro->aseguradora->nombre; } ?></td>
							<td><?php if($siniestro->ajustadora != NULL){ echo $siniestro->ajustadora->nombre; } ?></td>
							<td><?php if($siniestro->poliza != NULL){ echo $siniestro->poliza->num_poliza; } ?></td>
							<td><?php if($siniestro->id_averiguacion_previa != NULL){echo $siniestro->averiguacion_previa()->first()->num_averiguacion; } ?></td>
							<td>{{HTML::link( 'sire/reclamacion/siniestro/'.$siniestro->id, 'Ver',  ['class' => 'btn btn-primary btn-xs', 'role' => 'button']) }}</td>
						</tr>
						@endforeach
					</tbody>
				</table>
			</div>
		</div>
		
	</div>

@stop


@section('modals')

<div class="modal fade nuevoSiniestroR-modal" id="nuevoSiniestroR-modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="H1">Agregar Siniestro</h4>
            </div>
            <div class="modal-body">
                {{ Form::open(array('url' => 'sire/reclamacion/agregar')) }}
                
                <div class="row">
                    <div class="col-sm-6 col-md-8">
                        <div class="form-group">
                            {{Form::label('asegurado', 'Nombre del Asegurado', array('aria-hidden'=>'true'))}}
                            {{Form::text('asegurado', '',  array('class'=>'form-control form-sin', 'placeholder'=>'Nombre del Asegurado', 'autocomplete'=>'off', 'aria-label'=>'Nombre del Asegurado', 'required'))}}
                            
                        </div>
                    </div>

                    <div class="col-sm-6 col-md-4">
                        <div class="form-group form-select" id="form-select">
                            {{Form::label('tipo_persona', 'Tipo de Persona', array('aria-hidden'=>'true'))}}
                            <select class="form-control form-sin" name="tipo_persona" id="tipo_persona" required>
                                <option value="">Seleccione el Tipo de Persona </option>
                                @foreach($tipos_personas as $tipo)
                                    <option value="{{$tipo->id}}"> {{$tipo->tipo}}</option>
                                @endforeach    
                            </select>
                        </div>
                    </div>

                    <div class="col-sm-6 col-md-4">
                        <div class="form-group">
                            {{Form::label('fecha', 'Fecha del Siniestro')}}
                            {{Form::text('fecha', '', ['class' => 'datetimepicker1 form-control form-sin', 'placeholder' => 'Date', 'required'])}}
                        </div>
                    </div>

                    
                    <div class="col-sm-6 col-md-4">
                        <div class="form-group form-select" id="form-select">
                            {{Form::label('tipo_siniestro', 'Tipo de Siniestro', array('aria-hidden'=>'true'))}}
                            <select class="form-control form-sin" name="tipo_siniestro" id="tipo_siniestro" required>
                                <option value="">Seleccione el Tipo de Siniestro</option>
                                @foreach($tipos_siniestros as $tipo)
                                    <option value="{{$tipo->id}}"> {{$tipo->tipo}}</option>
                                @endforeach    
                            </select>
                            
                        </div>
                    </div>

                    <div class="col-sm-6 col-md-4">
                        <div class="form-group form-select" id="form-select">
                            {{Form::label('giro', 'Giro', array('aria-hidden'=>'true'))}}
                            <select class="form-control form-sin" name="giro" id="giro" required>
                                <option value="">Seleccione el Giro </option>
                                @foreach($giros_empresas as $giro)
                                    <option value="{{$giro->id}}"> {{$giro->giro}}</option>
                                @endforeach    
                            </select>
                        </div>
                    </div>

                    <div class="col-sm-12 col-md-12">
                        <div class="form-group">
                            {{Form::label('domicilio', 'Domicilio - Siniestro', array('aria-hidden'=>'true'))}}
                            {{Form::text('domicilio', '',  array('class'=>'form-control form-sin', 'placeholder'=>'Calle, Numero y Colonia', 'autocomplete'=>'off', 'aria-label'=>'Domicilio Siniestro', 'required'))}}
                            
                        </div>
                    </div>

                    <div class="col-sm-6 col-md-4">
                        <div class="form-group form-select" id="form-select">
                            {{Form::label('estado', 'Estado - Siniestro', array('aria-hidden'=>'true'))}}
                            <select class="form-control form-sin" name="estado" id="estado" required>
                                <option value="">Seleccione el Estado</option>
                                @foreach($estados as $estado)
                                    <option value="{{$estado->id}}">{{$estado->nombre}}</option>
                                @endforeach 
                            </select>
                        </div>
                    </div>

                    <div class="col-sm-6 col-md-4">
                        <div class="form-group">
                            {{Form::label('ciudad', 'Ciudad - Siniestro', array('aria-hidden'=>'true'))}}
                            {{Form::text('ciudad', '',  array('class'=>'form-control form-sin', 'placeholder'=>'Ciudad', 'autocomplete'=>'off', 'aria-label'=>'Ciudad', 'required'))}}
                            
                        </div>
                    </div>

                    <div class="col-sm-6 col-md-4">
                        <div class="form-group">
                            {{Form::label('codigo_postal', 'Codigo Postal - Siniestro', array('aria-hidden'=>'true'))}}
                            {{Form::text('codigo_postal', '',  array('class'=>'form-control form-sin', 'placeholder'=>'Codigo Postal', 'autocomplete'=>'off', 'aria-label'=>'Codigo Postal'))}}
                        </div>
                    </div>

                </div>

                <div class="hidden">    
                <input type="text" name="id" id="id" value=""/>
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

@stop