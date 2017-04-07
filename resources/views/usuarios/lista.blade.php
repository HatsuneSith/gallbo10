@extends('layouts.master')

@section('title')
    Lista de Usuarios
@stop


@section('contenido')

	<div class="row">
		<h2 aria-hidden="true"><a href="{{ url('sire/configuracion') }}"><span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span></a>Lista de Usuarios</h2>
		{{HTML::link( 'sire/configuracion/usuarios/nuevo' , 'Agregar Usuario', ['class' => 'btn btn-success', 'role' => 'button']) }}
		<hr>

		<div id="" class="col-md-12">


			@if(Session::get('message'))
            <div class="alert alert-success">
                 <a href="#" class="close" data-dismiss="alert">&times;</a>
                {{Session::get('message')}}
            </div>
            @endif


			<table  class="table table-hover table-striped table-bordered" >
				<thead>
					<tr>
						<th>Id</th>
						<th>Nombre</th>
						<th>Apellido</th>
						<th>Email</th>
						<th>Departamento</th>
						<th>Rol</th>
						<th>opciones</th>
						
					</tr>
				</thead>
				<tbody>
					@foreach($usuarios as $usuario)
					<tr>
						<td>{{$usuario->id}}</td>
						<td>{{$usuario->nombre}}</td>
						<td>{{$usuario->apellido}}</td>
						<td>{{$usuario->email}}</td>
						<td>{{$usuario->departamento}}</td>
						<td>{{$usuario->rol}}</td>
						<td>
							<button type="button" class="btnEliminarUser btn btn-danger btn-xs" value="{{$usuario->id}}">Eliminar</button>
							{{HTML::link( 'sire/configuracion/usuarios/asignacion/'.$usuario->id , 'Asignacion', ['class' => 'btn btn-success btn-xs', 'role' => 'button']) }}
							{{Form::button('Cambiar Password', array('class'=>'btnChangePass btn btn-primary btn-xs', 'data-toggle' => 'modal', 'data-target'=>'#changePass-modal', 'data-id' => $usuario->id))}}
						</td>
						
					</tr>
					@endforeach
				</tbody>
			</table>
		</div>
	</div>

@stop



@section('modals')

		

        <div class="modal fade changePass-modal" id="changePass-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h4 class="modal-title" id="myModalLabel">Cambiar Contraseña</h4>
					</div>
					<div class="modal-body">
						<div class="row">
						{{ Form::open(array('url' => 'sire/configuracion/usuarios/cambiopassword')) }}


						    <div class="col-md-8 form-pass">
						        <div class="form-group">
						        {{Form::label('password', 'Nueva Contraseña', array('aria-hidden'=>'true'))}}
						        {{Form::password('password', Input::old('password'), array('class'=>'form-control', 'placeholder' => 'Password', 'autocomplete'=>'off', 'aria-label'=>'Nueva Contraseña', 'required' =>'required', 'autocomplete' => 'off'))}}
						        </div>
						        @if( $errors->has('password') )
						            <div class="alert alert-danger">
						            @foreach($errors->get('password') as $error )
						                {{ $error }}<br>
						            @endforeach
						            </div>
						        @endif
						    </div>

						    <div class="hidden">
						    	<input type="text" name="id_usuario" id="id_usuario" value=""/>
		                    </div>

							<div class="col-md-12 form-btns">
							    {{Form::submit('Guardar', array('class'=>'btn btn-success btnSubmit', 'id'=>'btnSubmit'))}}
							    {{Form::reset('Cancelar', array('class'=>'btn btn-default', 'data-dismiss'=> 'modal'))}}
							</div>

						{{ Form::close() }}
						</div>
					</div>
					
				</div>
			</div>
		</div>

@stop
