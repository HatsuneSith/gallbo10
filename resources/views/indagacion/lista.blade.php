@extends('layouts.master')


@section('contenido') 

	<h2>Indagación de sitios por estado</h2>

	<div class="form-group">
		<label>Ver Periodicos de:</label>
		<select class="form-control" name="lista_estados" id="lista_estados">
			<option value="">Seleccione un Estado</option>
                @foreach($estados as $estado)
                    <option value="{{$estado->id}}">{{$estado->estado }}</option>
                @endforeach 
		</select>
	</div>

	<div class='load_periodicos'></div>



@stop


