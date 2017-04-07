@extends('layouts.master')
@section('title')
    Cobranza y Administración
@stop

@section('contenido') 

<div class="starter-template">
	@if (Session::has('mensaje'))
	 	<div class="alert alert-danger">
	 		{{ Session::get('mensaje') }}
	 	</div>
	@endif
	<!--<div class="row">
		<ul class="list-inline menu-opciones">
			<li>
				<a href="{{ url('sire/configuracion/usuarios') }}" class="thumbnail">
					<span class="glyphicon glyphicon-user"></span>
					<h3>Colaboradores</h3>
				</a>	
			</li>
		</ul>

	</div>
-->
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