@extends('layouts.master')

@section('title')
    Inicio
@stop

@section('contenido') 

<div class="starter-template">
	@if (Session::has('mensaje'))
	 	<div class="alert alert-danger">
	 		{{ Session::get('mensaje') }}
	 	</div>
	@endif
	<div class="row" >
		<ul class="list-inline menu-opciones">
			<li >
				<a href="{{ url('tareas') }}" class="thumbnail" autofocus >
					<span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span>
					<h3>Tareas</h3>
				</a>
			</li>
			<li>
				<a href="{{ url('sire') }}" class="thumbnail">
					<span class="glyphicon glyphicon-briefcase" aria-hidden="true"></span>
					<h3>SIRE</h3>
				</a>	
			</li>
		</ul>

	</div>
</div>

@stop