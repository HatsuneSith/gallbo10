@extends('layouts.master')

@section('title')
    Crear Tarea
@stop


@section('contenido') 
    <div class="row">

        <div class="col-md-12">
            <h2 aria-hidden="true"><a href="{{ url('tareas') }}"><span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span></a>Crear Tarea</h2>
            <hr aria-hidden="true">
            <div class="well">
                @if(Session::get('info'))
                <div class="alert alert-success" >
                    {{Session::get('info')}} {{HTML::link('tareas/lista', 'Ver lista de Tareas', array('class' => 'btn btn-primary badge', 'aria-hidden'=>'true'))}}
                </div>
                <audio src="../audio/success.mp3" autoplay>
                </audio>
                @endif
                @if(Session::get('danger'))
                <div class="alert alert-danger" >
                    {{Session::get('danger')}}
                </div>
                @endif
                {{ Form::open(array('url' => 'tareas/crear')) }}
                <div class="row">               
                    <div class="col-md-12">
                        <div class="form-group form-select" id="form-select">
                            {{Form::label('id_responsable', 'Responsable', array('aria-hidden'=>'true'))}}
                            
                            <select class="form-control" name="id_responsable" id="id_responsable" autofocus>
                                <option value="">Seleccione un Responsable</option>
                                @foreach($usuarios as $usuario)
                                    <?php if (isset($asignados[$usuario->id])) { ?>
                                        <option <?php if(Input::old('id_responsable') == $usuario->id){echo("selected");}?> value="{{$usuario->id}}"> {{$usuario->nombre.' '.$usuario->apellido}}
                                        </option>
                                    <?php } ?>

                                @endforeach 
                            </select>
                            
                        </div>
                        @if( $errors->has('id_responsable') )
                            <div class="alert alert-danger">
                            @foreach($errors->get('id_responsable') as $error )
                                {{ $error }}<br>
                            @endforeach
                            </div>
                        @endif
                    </div>

                    <div class="col-md-6 form-tarea">
                        <div class="form-group">
                            {{Form::label('tarea', 'Tarea', array('aria-hidden'=>'true'))}}
                            {{Form::textarea('tarea', Input::old('tarea'), array('class'=>'form-control', 'rows'=>3, 'placeholder'=>'Descripcion de la tarea', 'autocomplete'=>'off', 'aria-label'=>'descripcion de la tarea'))}}
                            
                        </div>
                        @if( $errors->has('tarea') )
                            <div class="alert alert-danger">
                            @foreach($errors->get('tarea') as $error )
                                {{ $error }}<br>
                            @endforeach
                            </div>
                        @endif
                    </div>

                    <div class="col-md-6 form-objetivo">
                        <div class="form-group">
                            {{Form::label('objetivo', 'Objetivo', array('aria-hidden'=>'true'))}}
                            {{Form::textarea('objetivo', Input::old('objetivo'), array('class'=>'form-control', 'rows'=>3, 'placeholder'=>'objetivo de la tarea', 'autocomplete'=>'off', 'aria-label'=>'objetivo de la tarea'))}}
                        </div>
                        @if( $errors->has('objetivo') )
                            <div class="alert alert-danger">
                            @foreach($errors->get('objetivo') as $error )
                                {{ $error }}<br>
                            @endforeach
                            </div>
                        @endif
                    </div>

                    <div class="col-md-4 form-dia">
                        <div class="form-group">
                        {{Form::label('dia', 'Fecha Dia', array('aria-hidden'=>'true'))}}
                        {{Form::text('dia', Input::old('dia'), array('class'=>'form-control', 'placeholder' => 'Dia', 'autocomplete'=>'off', 'aria-label'=>'Fecha Dia'))}}
                        </div>
                        @if( $errors->has('dia') )
                            <div class="alert alert-danger">
                            @foreach($errors->get('dia') as $error )
                                {{ $error }}<br>
                            @endforeach
                            </div>
                        @endif
                    </div>

                    <div class="col-md-4 form-mes">
                        <div class="form-group formmes" id="formmes">
                            {{Form::label('mes', 'Fecha Mes', array('aria-hidden'=>'true'))}}
                            <select class="form-control" name="mes" id="mes">
                              <option <?php if($mes_actual == '01'){echo("selected");}?> value="01">Enero</option>
                              <option <?php if($mes_actual == '02'){echo("selected");}?> value="02">Febrero</option>
                              <option <?php if($mes_actual == '03'){echo("selected");}?> value="03">Marzo</option>
                              <option <?php if($mes_actual == '04'){echo("selected");}?> value="04">Abril</option>
                              <option <?php if($mes_actual == '05'){echo("selected");}?> value="05">Mayo</option>
                              <option <?php if($mes_actual == '06'){echo("selected");}?> value="06">Junio</option>
                              <option <?php if($mes_actual == '07'){echo("selected");}?> value="07">Julio</option>
                              <option <?php if($mes_actual == '08'){echo("selected");}?> value="08">Agosto</option>
                              <option <?php if($mes_actual == '09'){echo("selected");}?> value="09">Septiembre</option>
                              <option <?php if($mes_actual == '10'){echo("selected");}?> value="10">Octubre</option>
                              <option <?php if($mes_actual == '11'){echo("selected");}?> value="11">Noviembre</option>
                              <option <?php if($mes_actual == '12'){echo("selected");}?> value="12">Diciembre</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4 form-año">
                        <div class="form-group formaño" id="formaño">
                            {{Form::label('año', 'Fecha Año', array('aria-hidden'=>'true'))}}
                            <select class="form-control" name="año" id="año">
                                <option value="{{$año_actual}}">{{$año_actual}}</option>
                                <option value="{{$año_actual+1}}">{{$año_actual+1}}</option>
                                <option value="{{$año_actual+2}}">{{$año_actual+2   }}</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-md-12" aria-hidden="true">
                        <div class="checkbox form-group">
                            <label>                               
                                {{Form::checkbox('check_prog', 'yes', Input::old('check_prog'), array('id' => 'check_prog'))}}
                                Guardar la misma tarea varias veces
                            </label>
                            <span class="glyphicon glyphicon-question-sign" data-toggle="tooltip" data-container: 'body' title="Tienes tareas que se repiten semanal, quincenal o mensualmente?, utiliza esta opcion para guardar la misma tarea las veces que sea necesario" data-original-title=""></span>
                        </div>
                    </div>

                    <div id="masopciones" style="display:none" aria-hidden="true">
                        

                        <div class="col-md-4">
                            <div class="form-group" id="">
                                {{Form::label('veces', 'Numero de Veces', array('aria-hidden'=>'true'))}}
                                {{Form::text('veces', Input::old('veces'), array('class'=>'form-control', 'placeholder' => 'N° Veces', 'autocomplete'=>'off', 'aria-label'=>'Numero de veces'))}}
                            </div>
                            @if( $errors->has('veces') )
                                <div class="alert alert-danger">
                                @foreach($errors->get('veces') as $error )
                                    {{ $error }}<br>
                                @endforeach
                                </div>
                            @endif
                        </div>

                        <div class="col-md-4">
                            <div class="form-group" id="">
                                {{Form::label('periodo', 'Frecuencia', array('aria-hidden'=>'true'))}}
                                <select class="form-control" name="periodo" id="periodo">
                                    <option value="">Seleccione un Periodo</option>
                                    <option value="Diario">Diario</option>
                                    <option value="Semanal">Semanal</option>
                                    <option value="Quincenal">Quincenal</option>
                                    <option value="Mensual">Mensual</option>
                                </select>
                            </div>
                            @if( $errors->has('periodo') )
                                <div class="alert alert-danger">
                                @foreach($errors->get('periodo') as $error )
                                    {{ $error }}<br>
                                @endforeach
                                </div>
                            @endif
                        </div>
                    </div>
                    

                    <div class="hidden">
                        {{Form::text('estado', 'Sin Ver', array('id'=>'estado'))}}
                        {{Form::text('indicador', 'Amarillo', array('id'=>'indicador'))}}
                        {{Form::text('id_asignador', Auth::user()->id)}}
                        {{Form::text('nombre_asignador', Auth::user()->nombre.' '.Auth::user()->apellido)}}
                    </div>

                </div>
                <div class="form-btns">
                    {{Form::submit('Guardar', array('class'=>'btn btn-success', 'id'=>'btnSubmit'))}}
                    {{Form::reset('Cancelar', array('class'=>'btn btn-default'))}}
                    {{HTML::link( 'tareas' , 'Volver', ['class' => 'btn btn-primary', 'role' => 'button']) }}
                </div>
                
                {{ Form::close() }}
            </div>

        </div>

    </div>



@stop

