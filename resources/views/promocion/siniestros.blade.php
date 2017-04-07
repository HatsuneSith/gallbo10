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
			<h2 aria-hidden="true"><a href="{{ url('sire/promocion') }}"><span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span></a>Siniestros <img src="/img/logo_gallbo.png" alt="Gallbo"  align="right" class="img-responsive" style="max-height: 50px;"></h2> 
			{{HTML::link( 'sire/promocion/siniestros/nuevo' , 'Agregar Siniestro', ['class' => 'btn btn-success', 'role' => 'button']) }}
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
							<th>Fecha</th>
							<th>Empresa</th>
							<th>F. Cita Realizada</th>
							<th>F. Cita Agendada</th>
							<th>Lugar Cita</th>
							<th>Estatus</th>
							<th>Opciones</th>
						</tr>
					</thead>
					<tbody>
						@foreach($siniestros as $siniestro)
						<tr>
							<td>{{$siniestro->id}}</td>
							<td>{{$siniestro->fecha_siniestro}}</td>
							<td>{{$siniestro->nombre}}</td>
							<td>{{$siniestro->fecha_cita_realizada}}</td>
							<td>{{$siniestro->fecha_cita_agendada}}</td>
							<td>{{$siniestro->lugar_cita}}</td>
							<td>{{$siniestro->estatus}}</td>
							<td>{{HTML::link( 'sire/promocion/siniestros/ver/'.$siniestro->id, 'Ver',  ['class' => 'btn btn-primary btn-xs', 'role' => 'button']) }}</td>
						</tr>
						@endforeach
					</tbody>
				</table>
			</div>
		</div>
		
	</div>

@stop


