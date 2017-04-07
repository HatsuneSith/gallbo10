@extends('layouts.master')

@section('title')
    Busqueda de Siniestros
@stop

@section('js')
    {{HTML::script('js/promocion.js')}}
@stop

@section('contenido')

	<div class="row">
		<div class="col-md-12">
			<h2 aria-hidden="true"><a href="{{ url('sire/promocion') }}"><span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span></a>Búsqueda de Siniestros por Estado <img src="/img/logo_gallbo.png" alt="Gallbo"  align="right" class="img-responsive" style="max-height: 50px;"></h2> 
			<hr>
			
			<div class="form-group">
				<label>Ver Periodicos de:</label>
				<select class="form-control" name="lista_estados" id="lista_estados">
					<option value="">Seleccione un Estado</option>
	                @foreach($estados as $estado)
	                    <option value="{{$estado->id}}">{{$estado->nombre }}</option>
	                @endforeach 
				</select>
			</div>

			<div class='load_periodicos'></div>
		</div>
		
	</div>

@stop


