@extends('layouts.master')

@section('title')
    Crear Usuario
@stop


@section('contenido') 
    <div class="row">

        <div class="col-md-12">
            <h2 aria-hidden="true"><a href="{{ url('sire/configuracion/usuarios') }}"><span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span></a>Asignar personal a cargo a {{$user->nombre . " " . $user->apellido}}</h2>
            <hr aria-hidden="true">
            <div class="well">
                
                {{ Form::open(array('url' => 'sire/configuracion/usuarios/asignacion')) }}
                @foreach($usuarios as $usuario)
                <div class="row">               
                    <div class="col-md-6">
                        <div class="form-group">
                            <input type="checkbox" name="checkuser[]" value="{{$usuario->id}}" <?php if(isset($asignados[$usuario->id])){?> checked <?php } ?> >
                            {{Form::label($usuario->nombre . " " . $usuario->apellido)}}
                           
                        </div>
                    </div>

                </div>
                 @endforeach 
                 <div class="hidden">
                    {{Form::text('id_coordinador', $user->id)}}
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