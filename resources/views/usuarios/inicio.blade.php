@extends('layouts.master')
@section('title')
    Usuarios
@stop

@section('contenido') 

<div class="starter-template">
	@if (Session::has('mensaje'))
	 	<div class="alert alert-danger">
	 		{{ Session::get('mensaje') }}
	 	</div>
	@endif
	<div class="row">
		<ul class="list-inline menu-opciones">
			<li>
				<a href="{{ url('sire/configuracion/usuarios/lista') }}" class="thumbnail">
					<span class="fa fa-users"></span>
					<h3>Lista de Usuarios</h3>
				</a>	
			</li>

			<li>
				<a href="{{ url('sire/configuracion/usuarios/nuevo') }}" class="thumbnail">
					<span class="fa fa-user-plus"></span>
					<h3>Agregar Usuarios</h3>
				</a>
			</li>
		</ul>

	</div>
</div>

<div class="row">
	<ul class="list-inline menu-opciones">
		<li >
			<a href="{{ url('sire/configuracion/') }}" class="return">
				<span class="glyphicon glyphicon-arrow-left" aria-hidden="true"></span>
				<h3>Volver</h3>
			</a>
		</li>
	</ul>
</div>

@stop