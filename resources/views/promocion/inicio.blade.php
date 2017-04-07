@extends('layouts.master')
@section('title')
    Promocion
@stop

@section('contenido')

@section('js')
    {{HTML::script('js/promocion.js')}}
@stop 

<div class="starter-template">
	@if (Session::has('mensaje'))
	 	<div class="alert alert-danger">
	 		{{ Session::get('mensaje') }}
	 	</div>
	@endif
	<div class="row">
		<ul class="list-inline menu-opciones">
			<li>
				<a href="{{ url('sire/promocion/busqueda') }}" class="thumbnail">
					<span class="glyphicon glyphicon-search"></span>
					<h3>Búsqueda de Siniestros</h3>
				</a>	
			</li>

			<li>
				<a href="{{ url('sire/promocion/siniestros') }}" class="thumbnail">
					<span class="glyphicon glyphicon-fire"></span>
					<h3>Siniestros</h3>
				</a>
			</li>
		</ul>

	</div>
</div>

<div class="row">
	<ul class="list-inline menu-opciones">
		<li >
			<a href="{{ url('sire') }}" class="return">
				<span class="glyphicon glyphicon-arrow-left" aria-hidden="true"></span>
				<h3>Volver</h3>
			</a>
		</li>
	</ul>
</div>

@stop