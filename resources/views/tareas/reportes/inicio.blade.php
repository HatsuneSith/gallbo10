@extends('layouts.master')
@section('title')
    Analytics
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
				<a href="{{url('tareas/reportes/usuarios')}}" class="thumbnail">
					<span class="fa fa-user"></span>
					<h3>Reporte por Usuario</h3>
				</a>	
			</li>

			<li>
				<a href="{{url('tareas/reportes/departamento')}}" class="thumbnail">
					<span class="fa fa-users"></span>
					<h3>R. por Departamento</h3>
				</a>
			</li>
		</ul>

	</div>
</div>

<div class="row">
	<ul class="list-inline menu-opciones">
		<li >
			<a href="{{ url('tareas') }}" class="return">
				<span class="glyphicon glyphicon-arrow-left" aria-hidden="true"></span>
				<h3>Volver</h3>
			</a>
		</li>
	</ul>
</div>

@stop