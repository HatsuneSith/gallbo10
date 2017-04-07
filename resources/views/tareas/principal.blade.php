@extends('layouts.master')

@section('title')
    Modulo de Tareas
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
			<li >
				<a href="{{ url('tareas/nueva') }}" class="thumbnail">
					<span class="glyphicon glyphicon-plus-sign" aria-hidden="true"></span>
					<h3>Crear Tarea</h3>
				</a>
			</li>
			<li>
				<a href="{{ url('tareas/lista') }}" class="thumbnail" >
					<span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span>
					<h3>Ver Tareas</h3>
				</a>	
			</li>
			<li>
				<a href="{{ url('tareas/reportes') }}" class="thumbnail" >
					<span class="glyphicon glyphicon-tasks" aria-hidden="true"></span>
					<h3>Analytics</h3>
				</a>	
			</li>
		</ul>

	</div>
</div>

<div class="row">
	<ul class="list-inline menu-opciones">
		<li >
			<a href="{{ url('/') }}" class="return">
				<span class="glyphicon glyphicon-arrow-left" aria-hidden="true"></span>
				<h3>Volver</h3>
			</a>
		</li>
	</ul>
</div>

@stop