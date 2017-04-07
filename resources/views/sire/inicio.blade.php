@extends('layouts.master')

@section('title')
    SIRE
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
				<a href="{{ url('sire/promocion') }}" class="thumbnail">
					<span class="glyphicon glyphicon-bullhorn"></span>
					<h3>Promoción</h3>
				</a>	
			</li>

			<!--<li>
				<a href="{{ url('sire/administracion') }}" class="thumbnail">
					<span class="glyphicon glyphicon-usd"></span>
					<h3>Cobranza y Admin.</h3>
				</a>	
			</li>
		-->
			<li>
				<a href="{{ url('sire/reclamacion') }}" class="thumbnail">
					<span class="glyphicon glyphicon-folder-open"></span>
					<h3>Reclamacion</h3>
				</a>	
			</li>

			<li>
				<a href="{{ url('sire/juridico') }}" class="thumbnail">
					<i class="fa fa-balance-scale" aria-hidden="true"></i>
					<h3>Jurídico</h3>
				</a>	
			</li>

			<li>
				<a href="{{ url('sire/indicadores') }}" class="thumbnail">
					<span class="glyphicon glyphicon-stats"></span>
					<h3>Metas</h3>
				</a>	
			</li>

			<li>
				<a href="{{ url('sire/configuracion') }}" class="thumbnail">
					<span class="glyphicon glyphicon-cog"></span>
					<h3>Configuración</h3>
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