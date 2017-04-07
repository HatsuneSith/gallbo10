@extends('layouts.master')

@section('title')
    Editar Tarea {{$tarea->id}}
@stop


@section('contenido') 
    <div class="row">

        <div class="col-md-12">

            <?php if (isset($_COOKIE["success"])){ ?>
                <audio src="../../audio/tarea_success.mp3" autoplay>
                </audio>
            <?php } ?>

            
            
                <h2>
                    <a href="../lista?<?php if(Session::get('id_responsable')){echo'id_responsable='.Session::get('id_responsable');} if(Session::get('estado')){echo'&estado='.Session::get('estado');} if(Session::get('indicador')){echo '&indicador=' . Session::get('indicador');} if(Session::get('page')){echo '&page=' . Session::get('page');} ?> ">

                        <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                    </a>
                    Editar Tarea
                </h2>
                
                <hr>

                <div class="well">
                @if(Session::get('danger'))
                <div class="alert alert-danger" >
                    {{Session::get('danger')}}
                </div>
                @endif
                {{ Form::open(array('url' => 'tareas/actualizar_eg/'.$tarea->id)) }}

                <div class="row">               
                    <div class="col-md-6">

                        <div class="form-group">
                            {{Form::label('tarea', 'Tarea')}}<br>
                            {{Form::textarea('tarea', $tarea->tarea, array('class'=>'form-control', 'rows'=>3, 'placeholder'=>'descripcion de la tarea', 'autocomplete'=>'off'))}}
                        </div>
                        @if( $errors->has('tarea') )
                            <div class="alert alert-danger">
                            @foreach($errors->get('tarea') as $error )
                                {{ $error }}<br>
                            @endforeach
                            </div>
                        @endif
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            {{Form::label('objetivo', 'Objetivo')}}<br>
                            {{Form::textarea('objetivo', $tarea->objetivo, array('class'=>'form-control', 'rows'=>3, 'placeholder'=>'objetivo de la tarea', 'autocomplete'=>'off'))}}
                        </div>
                        @if( $errors->has('objetivo') )
                            <div class="alert alert-danger">
                            @foreach($errors->get('objetivo') as $error )
                                {{ $error }}<br>
                            @endforeach
                            </div>
                        @endif
                    </div>

                    <?php $fecha = new DateTime($tarea->fecha); ?>
                    
                    <div class="col-md-4 form-dia">
                        <div class="form-group">
                        {{Form::label('dia', 'Fecha Dia', array('aria-hidden'=>'true'))}}
                        {{Form::text('dia', $fecha->format('d'), array('class'=>'form-control', 'placeholder' => 'Dia', 'autocomplete'=>'off', 'aria-label'=>'Fecha Dia'))}}
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
                              <option <?php if($fecha->format('m') == '01'){echo("selected");}?> value="01">Enero</option>
                              <option <?php if($fecha->format('m') == '02'){echo("selected");}?> value="02">Febrero</option>
                              <option <?php if($fecha->format('m') == '03'){echo("selected");}?> value="03">Marzo</option>
                              <option <?php if($fecha->format('m') == '04'){echo("selected");}?> value="04">Abril</option>
                              <option <?php if($fecha->format('m') == '05'){echo("selected");}?> value="05">Mayo</option>
                              <option <?php if($fecha->format('m') == '06'){echo("selected");}?> value="06">Junio</option>
                              <option <?php if($fecha->format('m') == '07'){echo("selected");}?> value="07">Julio</option>
                              <option <?php if($fecha->format('m') == '08'){echo("selected");}?> value="08">Agosto</option>
                              <option <?php if($fecha->format('m') == '09'){echo("selected");}?> value="09">Septiembre</option>
                              <option <?php if($fecha->format('m') == '10'){echo("selected");}?> value="10">Octubre</option>
                              <option <?php if($fecha->format('m') == '11'){echo("selected");}?> value="11">Noviembre</option>
                              <option <?php if($fecha->format('m') == '12'){echo("selected");}?> value="12">Diciembre</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4 form-año">
                        <div class="form-group formaño" id="formaño">
                            {{Form::label('año', 'Fecha Año', array('aria-hidden'=>'true'))}}
                            <select class="form-control" name="año" id="año">
                                <option value="{{$fecha->format('Y')}}">{{$fecha->format('Y')}}</option>
                                <option value="{{$fecha->format('Y')+1}}">{{$fecha->format('Y')+1}}</option>
                                <option value="{{$fecha->format('Y')+2}}">{{$fecha->format('Y')+2   }}</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-md-4 form-dia">
                        <div class="form-group">
                            {{Form::label('fecha_concluida', 'Fecha Concluida')}}<br>
                            <input type="text" name="fecha_concluida" class="datetimepicker1 form-control" value=" <?php echo date_format(date_create($tarea->fecha_concluida), 'd/m/Y H:i');?> "> 
                        </div>
                    </div>

                    <div class="col-md-4 form-dia">
                        <div class="form-group">
                            {{Form::label('created_at', 'Fecha Creacion')}}<br>
                            <input type="text" name="created_at" class="datetimepicker1 form-control" value=" <?php echo date_format(date_create($tarea->created_at), 'd/m/Y H:i'); ?> "> 
                        </div>
                    </div>

                
                </div>
                <div class="form-btns">
                    {{Form::submit('Actualizar', array('class'=>'btn btn-success'))}}
                </div>
                
                {{ Form::close() }}
            </div>

        </div>

    </div>



@stop
