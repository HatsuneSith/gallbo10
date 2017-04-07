@extends('layouts.master')

@section('title')
    Detalles De Tarea {{$tarea->id}}
@stop


@section('contenido')
    
    <div class="row">
        <div class="col-md-12">
            <?php if (isset($_COOKIE["success"])){ ?>
                <audio src="../../audio/tarea_success.mp3" autoplay>
                </audio>
            <?php } ?>
            
            <div class="well">
                <h3>
                    <a href="../lista?<?php if(Session::get('id_responsable')){echo'id_responsable='.Session::get('id_responsable');} if(Session::get('estado')){echo'&estado='.Session::get('estado');} if(Session::get('indicador')){echo '&indicador=' . Session::get('indicador');} if(Session::get('page')){echo '&page=' . Session::get('page');} ?> ">

                        <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                    </a>
                    Detalles de Tarea {{$tarea->id}}
                </h3>
                
                <hr>
                
                <dl class="dl-horizontal">
                    <dt>Tarea: </dt>
                    <dd>{{ $tarea->tarea}}</dd><br>
                    <dt>Objetivo: </dt>
                    <dd>{{{ $tarea->objetivo}}}</dd><br>
                    <dt>Responsable: </dt>
                    <dd>{{{ $tarea->nombre_responsable}}}</dd><br>
                    <dt>Estado: </dt>
                    <dd>{{ $tarea->estado}}</dd><br>
                    <dt>Indicador: </dt>
                    <dd>{{ $tarea->indicador}}</dd><br>
                    <dt>Fecha Inicio: </dt>
                    <dd>{{ $tarea->created_at}}</dd><br>
                    <dt>Fecha Asignada: </dt>
                    <dd>{{ $tarea->fecha}}</dd><br>
                    <dt>Asignador: </dt>
                    <dd>{{ $tarea->nombre_asignador}}</dd>
                </dl>

                @if ((($tarea->indicador != 'Verde')) && (Auth::user()->id == $tarea->id_responsable))
                    {{Form::button('Concluir Tarea', array('class'=>'btnConcluir btn btn-success btn-primary', 'value' => $tarea->id))}}
                @endif

                
                @if(Auth::user()->id == $tarea->id_responsable && $tarea->indicador != 'Verde')
                
                    @if($prorroga)
                        {{$prorroga->fecha_peticion}}
                    @else
                        <button type="button" class="btn btn-primary hidden" id="btn_cambiarfecha" disabled>Solicitar cambio de fecha</button>

                        <div class="hidden" id="form_fecha">

                            {{ Form::open(array('url' => 'tareas/solicitarfecha')) }}
                                <div class="row">
                                    <div class="col-xs-8 col-sm-4 col-md-4">
                                        <div class="form-group">
                                            {{Form::label('fecha_peticion', 'Fecha Prorroga')}}
                                            {{Form::input('date', 'fecha_peticion', '', ['class' => 'form-control']);}}
                                        </div>
                                    </div>
                                </div>
                                
                                {{Form::hidden('id_tarea', $tarea->id)}}
                                {{Form::hidden('fecha_anterior', $tarea->fecha)}}
                                {{Form::hidden('estado', 'Pendiente')}}
                                
                                {{Form::submit('Solicitar', array('class'=>'btn btn-primary'))}}
                                <button type="button" class="btn btn-default" id="btn_cancelarfecha">Cancelar</button>
                            {{ Form::close() }}

                        </div>
                    @endif
                @endif
                

                @if(Auth::user()->id == $tarea->id_asignador)
                
                    @if($prorroga)
                        {{'Hay una peticion de cambio de fecha'}}
                        {{$prorroga->fecha_peticion}}
                    @endif

                @endif


                @if($tarea->indicador == 'Verde')

                    @if (Auth::user()->rol == 'Directivo' )

                        {{ Form::open(array('url' => 'tareas/tareasinconcluir')) }}
                            {{Form::hidden('id_tarea', $tarea->id)}}
                            {{Form::submit('Tarea Sin Concluir', array('class'=>'btn btn-primary'))}}
                        {{ Form::close() }}

                    @endif
                    @if ((Auth::user()->rol == 'Coordinador') && isset($ejecutivos[$tarea->id_responsable]))

                        {{ Form::open(array('url' => 'tareas/tareasinconcluir')) }}
                            {{Form::hidden('id_tarea', $tarea->id)}}
                            {{Form::submit('Tarea Sin Concluir', array('class'=>'btn btn-primary'))}}
                        {{ Form::close() }}

                    @endif

                
                    

                @endif
                

                

            </div>

            @if(Session::get('info'))
                <div class="alert alert-success" >
                    {{Session::get('info')}}
                </div>
                <audio src="../../audio/success.mp3" autoplay>
                </audio>
            @endif

            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title">Comentarios:</h3>
                </div>
                @foreach($comentarios as $comentario)

                    <div class="panel-body">
                        <h4>{{$comentario->nombre_usuario}} <small>{{$comentario->created_at}}</small></h4>
                        
                        <b>{{nl2br($comentario->comentario)}}</b>
                        
                    </div>

                @endforeach
            </div>

            <div class="well">
                
                {{ Form::open(array('url' => 'tareas/comentar')) }}


                <div class="form-group">
                {{Form::label('comentario', 'Comentario')}}<br>
                {{Form::textarea('comentario', Input::old('comentario'), array('class'=>'form-control', 'rows'=>3, 'placeholder'=>'Escribe algun comentario', 'autocomplete'=>'off',))}}
                </div>
                @if( $errors->has('comentario') )
                <div class="alert alert-danger">
                @foreach($errors->get('comentario') as $error )
                {{ $error }}<br>
                @endforeach
                </div>
                @endif


                <div class="hidden">
                {{Form::text('id_tarea', $tarea->id)}}
                {{Form::text('id_usuario', Auth::user()->id)}}
                {{Form::text('nombre_usuario', Auth::user()->nombre)}}
                </div>

                {{Form::submit('Comentar', array('class'=>'btn btn-success', 'id'=>'btnSubmit'))}}
                {{HTML::link( 'tareas' , 'Volver a menu tareas', ['class' => 'btn btn-primary', 'role' => 'button']) }}
                {{ Form::close() }}
                
            </div>

        </div>
    </div> 

    



@stop