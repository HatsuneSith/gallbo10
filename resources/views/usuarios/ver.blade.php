@extends('layouts.master')
@section('title')
    Detalles de Usuario {{$usuario->nombre}}
@stop

@section('contenido')
    
    <div class="row">
        <div class="col-md-12">
            <div class="well">
            	@if(Session::get('message'))
                <div class="alert alert-success">
                     <a href="#" class="close" data-dismiss="alert">&times;</a>
                    {{Session::get('message')}}
                </div>
                @endif
                <h3><a href="{{ url('/') }}" title="Regresar"><i class="glyphicon glyphicon glyphicon-chevron-left"></i></a>Detalles de Usuario</h3>
                <hr>
                <dl class="dl-horizontal">
                    <dt>Nombre: </dt>
                    <dd>{{ $usuario->nombre}}</dd><br>
                    <dt>Apellido: </dt>
                    <dd>{{{ $usuario->apellido}}}</dd><br>
                    <dt>Email: </dt>
                    <dd>{{ $usuario->email}}</dd><br>
                    <dt>Departamento: </dt>
                    <dd>{{ $usuario->departamento}}</dd><br>
                    <dt>Rol: </dt>
                    <dd>{{ $usuario->rol}}</dd><br>
                </dl>
                <div class="form_password">
                	<button type="button" class="btn btn-primary" id="btn_cambiarpass">Modificar contraseña</button>
                </div>
            </div>
        </div>
    </div> 

@stop