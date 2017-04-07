@extends('layouts.master')

@section('title')
    Captura de Siniestro
@stop

@section('js')
    {{HTML::script('js/promocion.js')}}
@stop


@section('contenido') 
    <div class="row">

        <div class="col-md-12">
            <h2 aria-hidden="true"><a href="{{ url('sire/promocion/siniestros') }}"><span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span></a>Capturar Siniestro <img src="/img/logo_gallbo.png" alt="Gallbo"  align="right" class="img-responsive" style="max-height: 50px;"></h2>
            <hr aria-hidden="true">
            <div class="well">
                @if(Session::get('info'))
                <div class="alert alert-success" >
                    {{Session::get('info')}} {{HTML::link('sire/promocion/siniestros', 'Ver Siniestros', array('class' => 'btn btn-primary badge', 'aria-hidden'=>'true'))}}
                </div>
                <audio src="../audio/success.mp3" autoplay>
                </audio>
                @endif
                @if(Session::get('danger'))
                <div class="alert alert-danger" >
                    {{Session::get('danger')}}
                </div>
                @endif


                {{ Form::open(array('url' => 'sire/promocion/siniestros/nuevo')) }}
                <div class="row">

                    <div class="col-sm-6 col-md-4">
                        <div class="form-group">
                            {{Form::label('fecha_siniestro', 'Fecha del Siniestro', array('aria-hidden'=>'true'))}}
                            {{Form::text('fecha_siniestro', Input::old('fecha_siniestro'), array('class'=>'form-control datetimepicker1', 'aria-label'=>''))}}
                        </div>
                        @if( $errors->has('fecha_siniestro') )
                            <div class="alert alert-danger">
                            @foreach($errors->get('fecha_siniestro') as $error )
                                {{ $error }}<br>
                            @endforeach
                            </div>
                        @endif
                    </div>

                    <div class="col-sm-6 col-md-8">
                        <div class="form-group">
                            {{Form::label('nombre', 'Empresa', array('aria-hidden'=>'true'))}}
                            {{Form::text('nombre', Input::old('nombre'), array('class'=>'form-control', 'placeholder'=>'Nombre de la empresa', 'autocomplete'=>'off', 'aria-label'=>'nombre de la empresa'))}}
                            
                        </div>
                        @if( $errors->has('nombre') )
                            <div class="alert alert-danger">
                            @foreach($errors->get('nombre') as $error )
                                {{ $error }}<br>
                            @endforeach
                            </div>
                        @endif
                    </div>

                    <div class="col-sm-6 col-md-6">
                        <div class="form-group">
                            {{Form::label('director_general', 'Director General', array('aria-hidden'=>'true'))}}
                            {{Form::text('director_general', Input::old('director_general'), array('class'=>'form-control', 'placeholder'=>'Nombre del Director General', 'autocomplete'=>'off', 'aria-label'=>'Nombre del Director General'))}}
                            
                        </div>
                        @if( $errors->has('director_general') )
                            <div class="alert alert-danger">
                            @foreach($errors->get('director_general') as $error )
                                {{ $error }}<br>
                            @endforeach
                            </div>
                        @endif
                    </div>

                    <div class="col-sm-6 col-md-6">
                        <div class="form-group">
                            {{Form::label('asistente_director_general', 'Asistente Director General', array('aria-hidden'=>'true'))}}
                            {{Form::text('asistente_director_general', Input::old('asistente_director_general'), array('class'=>'form-control', 'placeholder'=>'Nombre del Asistente del Director General', 'autocomplete'=>'off', 'aria-label'=>'Nombre del Asistente del Director General'))}}
                            
                        </div>
                        @if( $errors->has('asistente_director_general') )
                            <div class="alert alert-danger">
                            @foreach($errors->get('asistente_director_general') as $error )
                                {{ $error }}<br>
                            @endforeach
                            </div>
                        @endif
                    </div>

                    <div class="col-sm-6 col-md-4">
                        <div class="form-group form-select" id="form-select">
                            {{Form::label('tipo_siniestro', 'Tipo de Siniestro', array('aria-hidden'=>'true'))}}
                            
                            <select class="form-control" name="tipo_siniestro" id="tipo_siniestro" >
                                <option value="">Seleccione el Tipo de Siniestro</option>
                                @foreach($tipos_siniestros as $tipo)
                                    <option <?php if(Input::old('tipo_siniestro') == $tipo->id){echo("selected");}?> value="{{$tipo->id}}"> {{$tipo->tipo}}</option>
                                @endforeach                        
                            </select>
                            
                        </div>
                        @if( $errors->has('tipo_siniestro') )
                            <div class="alert alert-danger">
                            @foreach($errors->get('tipo_siniestro') as $error )
                                {{ $error }}<br>
                            @endforeach
                            </div>
                        @endif
                    </div>

                    <div class="col-sm-6 col-md-4">
                        <div class="form-group form-select" id="form-select">
                            {{Form::label('magnitud_siniestro', 'Magnitud de Siniestro', array('aria-hidden'=>'true'))}}
                            
                            <select class="form-control" name="magnitud_siniestro" id="magnitud_siniestro" >
                                <option value="">Seleccione la Magnitud del Siniestro</option>
                                <option <?php if(Input::old('magnitud_siniestro') == '1'){echo("selected");}?> value="1">Baja</option>
                                <option <?php if(Input::old('magnitud_siniestro') == '2'){echo("selected");}?> value="2">Media</option>
                                <option <?php if(Input::old('magnitud_siniestro') == '3'){echo("selected");}?> value="3">Alta</option>
                            </select>
                            
                        </div>
                        @if( $errors->has('magnitud_siniestro') )
                            <div class="alert alert-danger">
                            @foreach($errors->get('magnitud_siniestro') as $error )
                                {{ $error }}<br>
                            @endforeach
                            </div>
                        @endif
                    </div>

                    <div class="col-sm-6 col-md-4">
                        <div class="form-group form-select" id="form-select">
                            {{Form::label('giro_empresa', 'Giro de la Empresa', array('aria-hidden'=>'true'))}}
                            
                            <select class="form-control" name="giro_empresa" id="giro_empresa" >
                                <option value="">Seleccione el giro de la empresa</option>
                                @foreach($giros_empresas as $giro)
                                    <option <?php if(Input::old('giro_empresa') == $giro->id){echo("selected");}?> value="{{$giro->id}}"> {{$giro->giro}}</option>
                                @endforeach     
                            </select>
                            
                        </div>
                        @if( $errors->has('giro_empresa') )
                            <div class="alert alert-danger">
                            @foreach($errors->get('giro_empresa') as $error )
                                {{ $error }}<br>
                            @endforeach
                            </div>
                        @endif
                    </div>

                    <div class="col-sm-6 col-md-4">
                        <div class="form-group form-select" id="form-select">
                            {{Form::label('estado', 'Estado', array('aria-hidden'=>'true'))}}
                            
                            <select class="form-control" name="estado" id="estado" >
                                <option value="">Seleccione el Estado</option>
                                @foreach($estados as $estado)
                                    <option <?php if(Input::old('estado') == $estado->id){echo("selected");}?> value="{{$estado->id}}">{{$estado->nombre}}</option>
                                @endforeach 
                               
                            </select>
                            
                        </div>
                        @if( $errors->has('estado') )
                            <div class="alert alert-danger">
                            @foreach($errors->get('estado') as $error )
                                {{ $error }}<br>
                            @endforeach
                            </div>
                        @endif
                    </div>

                    <div class="col-sm-6 col-md-4">
                        <div class="form-group">
                            {{Form::label('ciudad', 'Ciudad', array('aria-hidden'=>'true'))}}
                            {{Form::text('ciudad', Input::old('ciudad'), array('class'=>'form-control', 'placeholder'=>'Ciudad', 'autocomplete'=>'off', 'aria-label'=>'Ciudad'))}}
                            
                        </div>
                        @if( $errors->has('ciudad') )
                            <div class="alert alert-danger">
                            @foreach($errors->get('ciudad') as $error )
                                {{ $error }}<br>
                            @endforeach
                            </div>
                        @endif
                    </div>

                    <div class="col-sm-6 col-md-4">
                        <div class="form-group">
                            {{Form::label('domicilio', 'Domicilio', array('aria-hidden'=>'true'))}}
                            {{Form::text('domicilio', Input::old('domicilio'), array('class'=>'form-control', 'placeholder'=>'Calle, Numero y Colonia', 'autocomplete'=>'off', 'aria-label'=>'Domicilio'))}}
                            
                        </div>
                        @if( $errors->has('domicilio') )
                            <div class="alert alert-danger">
                            @foreach($errors->get('domicilio') as $error )
                                {{ $error }}<br>
                            @endforeach
                            </div>
                        @endif
                    </div>

                    <div class="col-sm-6 col-md-6">
                        <div class="form-group">
                            {{Form::label('telefonos', 'Telefonos', array('aria-hidden'=>'true'))}}
                            {{Form::text('telefonos', Input::old('telefonos'), array('class'=>'form-control', 'placeholder'=>'Telefonos', 'autocomplete'=>'off', 'aria-label'=>'Telefonos'))}}
                            
                        </div>
                        @if( $errors->has('telefonos') )
                            <div class="alert alert-danger">
                            @foreach($errors->get('telefonos') as $error )
                                {{ $error }}<br>
                            @endforeach
                            </div>
                        @endif
                    </div>

                    <div class="col-sm-6 col-md-6">
                        <div class="form-group">
                            {{Form::label('email', 'Email', array('aria-hidden'=>'true'))}}
                            {{Form::text('email', Input::old('email'), array('class'=>'form-control', 'placeholder'=>'Email', 'autocomplete'=>'off', 'aria-label'=>'Email'))}}
                            
                        </div>
                        @if( $errors->has('email') )
                            <div class="alert alert-danger">
                            @foreach($errors->get('email') as $error )
                                {{ $error }}<br>
                            @endforeach
                            </div>
                        @endif
                    </div>

                    <div class="col-sm-12 col-md-12">
                        <div class="form-group">
                            {{Form::label('fuente_informacion', 'Fuente de Información', array('aria-hidden'=>'true'))}}
                            {{Form::text('fuente_informacion', Input::old('fuente_informacion'), array('class'=>'form-control', 'placeholder'=>'Fuente de Información', 'autocomplete'=>'off', 'aria-label'=>'Fuente de Información'))}}
                            
                        </div>
                        @if( $errors->has('fuente_informacion') )
                            <div class="alert alert-danger">
                            @foreach($errors->get('fuente_informacion') as $error )
                                {{ $error }}<br>
                            @endforeach
                            </div>
                        @endif
                    </div>




                </div>
                <div class="form-btns">
                    {{Form::submit('Guardar', array('class'=>'btn btn-success', 'id'=>'btnSubmit'))}}
                    {{Form::reset('Cancelar', array('class'=>'btn btn-default'))}}
                </div>
                
                {{ Form::close() }}
            </div>

        </div>

    </div>



@stop

