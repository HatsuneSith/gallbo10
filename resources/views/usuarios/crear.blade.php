@extends('layouts.master')

@section('title')
    Crear Usuario
@stop


@section('contenido') 
    <div class="row">

        <div class="col-md-12">
            <h2 aria-hidden="true"><a href="{{ url('sire/configuracion/usuarios') }}"><span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span></a>Crear Usuario</h2>
            <hr aria-hidden="true">
            <div class="well">
                
                {{ Form::open(array('url' => 'sire/configuracion/usuarios/crear')) }}
                <div class="row">               
                    <div class="col-md-6">
                        <div class="form-group">
                            {{Form::label('nombre', 'Nombre')}}<br>
                            {{Form::text('nombre', Input::old('nombre'), array('class'=>'form-control', 'placeholder'=>'Nombre', 'autocomplete'=>'off'))}}
                        </div>
                        @if( $errors->has('nombre') )
                            <div class="alert alert-danger">
                            @foreach($errors->get('nombre') as $error )
                                {{ $error }}<br>
                            @endforeach
                            </div>
                        @endif
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            {{Form::label('apellido', 'Apellido')}}<br>
                            {{Form::text('apellido', Input::old('apellido'), array('class'=>'form-control', 'placeholder'=>'Apellido', 'autocomplete'=>'off'))}}
                        </div>
                        @if( $errors->has('apellido') )
                            <div class="alert alert-danger">
                            @foreach($errors->get('apellido') as $error )
                                {{ $error }}<br>
                            @endforeach
                            </div>
                        @endif
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            {{Form::label('departamento', 'Departamento')}}<br>
                            <select class="form-control" name="departamento">
                                <option value="">Seleccione un Departamento</option>
                                <option value="Cobranza">Cobranza</option>
                                <option value="Promocion">Promocion</option>
                                <option value="Reclamacion">Reclamacion</option>
                                <option value="Juridico">Juridico</option>
                                <option value="Direccion">Direccion</option>
                                <option value="Sistemas">Sistemas</option>
                                <option value="Fundacion">Fundacion</option>
                                <option value="Gestion">Gestion</option>
                                <option value="Protesis">Protesis</option>
                                <option value="Colchon">Colchon</option>
                                <option value="Carro">Carro</option>
                            </select>
                        </div>
                        @if( $errors->has('departamento') )
                            <div class="alert alert-danger">
                            @foreach($errors->get('departamento') as $error )
                                {{ $error }}<br>
                            @endforeach
                            </div>
                        @endif
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            {{Form::label('rol', 'Rol')}}<br>
                            <select class="form-control" name="rol">
                                <option value="">Seleccione un Rol</option>
                                <option value="Practicante">Practicante</option>
                                <option value="Ejecutivo">Ejecutivo</option>
                                <option value="Coordinador">Coordinador</option>
                                <option value="Directivo">Directivo</option>
                            </select>
                        </div>
                        @if( $errors->has('rol') )
                            <div class="alert alert-danger">
                            @foreach($errors->get('rol') as $error )
                                {{ $error }}<br>
                            @endforeach
                            </div>
                        @endif
                    </div>
                    
                    <div class="col-md-6">
                        <div class="form-group">
                            {{Form::label('email', 'email')}}<br>
                            {{Form::text('email', Input::old('email'), array('class'=>'form-control', 'placeholder'=>'Email usuario', 'autocomplete'=>'off'))}}
                        </div>
                        @if( $errors->has('email') )
                            <div class="alert alert-danger">
                            @foreach($errors->get('email') as $error )
                                {{ $error }}<br>
                            @endforeach
                            </div>
                        @endif
                    </div>
                    
                    <div class="col-md-6">
                        <div class="form-group">
                            {{Form::label('password', 'Password')}}<br>
                            {{Form::input('password', 'password', Input::old('password'), array('class'=>'form-control', 'placeholder'=>'Contraseña del usuario', 'autocomplete'=>'off'))}}
                        </div>
                        @if( $errors->has('password') )
                            <div class="alert alert-danger">
                            @foreach($errors->get('password') as $error )
                                {{ $error }}<br>
                            @endforeach
                            </div>
                        @endif
                    </div>


                </div>
                <div class="form-btns">
                    {{Form::submit('Guardar', array('class'=>'btn btn-success'))}}
                    {{Form::reset('Resetear', array('class'=>'btn btn-default'))}}
                </div>
                
                {{ Form::close() }}
            </div>

        </div>

    </div>



@stop