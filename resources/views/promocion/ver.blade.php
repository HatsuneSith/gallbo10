@extends('layouts.master')

@section('title')
    Detalles de Siniestro {{$siniestro->id}} 
@stop

@section('js')
    {{HTML::script('js/promocion.js')}}
@stop

@section('contenido') 
    <div class="row">

        <div class="col-md-12">
            <h2 aria-hidden="true"><a href="{{ url('sire/promocion/siniestros') }}"><span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span></a>Informacion del  Siniestro {{$siniestro->id}} <img src="/img/logo_gallbo.png" alt="Gallbo"  align="right" class="img-responsive" style="max-height: 50px;"></h2>
            <hr aria-hidden="true">

            <ol class="breadcrumb">
              <li><a href="#" class="btnPropuesta" data-toggle="modal" data-target="#formPropuesta-modal" data-id="{{$siniestro->id}}">Imprimir Propuesta</a></li>
            </ol>

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


                {{ Form::open(array('url' => 'sire/promocion/siniestros/actualizar/'.$siniestro->id)) }}
                <fieldset id="form-edit-sin" disabled>
                <div class="row">
                    

                    <div class="col-sm-6 col-md-4">
                        <div class="form-group">
                            <?php $fecha_siniestro = new DateTime($siniestro->fecha_siniestro);?>
                            {{Form::label('fecha_siniestro', 'Fecha del Siniestro')}}
                            {{Form::text('fecha_siniestro', $fecha_siniestro->format('d/m/Y H:i'), ['class' => 'datetimepicker1 form-control form-sin', 'placeholder' => 'Date']);}}
                        </div>


                        @if( $errors->has('fecha_siniestro') )
                            <div class="alert alert-danger">
                            @foreach($errors->get('fecha_siniestro') as $error )
                                {{ $error }}
                            @endforeach
                            </div>
                        @endif
                    </div>

                    <div class="col-sm-6 col-md-8">
                        <div class="form-group">
                            {{Form::label('nombre', 'Empresa', array('aria-hidden'=>'true'))}}
                            {{Form::text('nombre', $siniestro->nombre, array('class'=>'form-control form-sin', 'placeholder'=>'Nombre de la empresa', 'autocomplete'=>'off', 'aria-label'=>'nombre de la empresa'))}}
                            
                        </div>
                        @if( $errors->has('nombre') )
                            <div class="alert alert-danger">
                            @foreach($errors->get('nombre') as $error )
                                {{ $error }}
                            @endforeach
                            </div>
                        @endif
                    </div>

                    <div class="col-sm-6 col-md-6">
                        <div class="form-group">
                            {{Form::label('director_general', 'Director General', array('aria-hidden'=>'true'))}}
                            {{Form::text('director_general', $siniestro->director_general, array('class'=>'form-control form-sin', 'placeholder'=>'Nombre del Director General', 'autocomplete'=>'off', 'aria-label'=>'Nombre del Director General'))}}
                            
                        </div>
                        @if( $errors->has('director_general') )
                            <div class="alert alert-danger">
                            @foreach($errors->get('director_general') as $error )
                                {{ $error }}
                            @endforeach
                            </div>
                        @endif
                    </div>

                    <div class="col-sm-6 col-md-6">
                        <div class="form-group">
                            {{Form::label('asistente_director_general', 'Asistente Director General', array('aria-hidden'=>'true'))}}
                            {{Form::text('asistente_director_general', $siniestro->asistente_director_general, array('class'=>'form-control form-sin', 'placeholder'=>'Nombre del Asistente del Director General', 'autocomplete'=>'off', 'aria-label'=>'Nombre del Asistente del Director General'))}}
                            
                        </div>
                        @if( $errors->has('asistente_director_general') )
                            <div class="alert alert-danger">
                            @foreach($errors->get('asistente_director_general') as $error )
                                {{ $error }}
                            @endforeach
                            </div>
                        @endif
                    </div>

                    <div class="col-sm-6 col-md-4">
                        <div class="form-group form-select" id="form-select">
                            {{Form::label('tipo_siniestro', 'Tipo de Siniestro', array('aria-hidden'=>'true'))}}
                            <select class="form-control form-sin" name="tipo_siniestro" id="tipo_siniestro" >
                                <option value="">Seleccione el Tipo de Siniestro</option>
                                @foreach($tipos_siniestros as $tipo)
                                    <option <?php if($siniestro->tipo_siniestro == $tipo->id){echo("selected");}?> value="{{$tipo->id}}"> {{$tipo->tipo}}</option>
                                @endforeach    
                            </select>
                            
                        </div>
                        @if( $errors->has('tipo_siniestro') )
                            <div class="alert alert-danger">
                            @foreach($errors->get('tipo_siniestro') as $error )
                                {{ $error }}
                            @endforeach
                            </div>
                        @endif
                    </div>

                    <div class="col-sm-6 col-md-4">
                        <div class="form-group form-select" id="form-select">
                            {{Form::label('magnitud_siniestro', 'Magnitud de Siniestro', array('aria-hidden'=>'true'))}}
                            
                            <select class="form-control form-sin" name="magnitud_siniestro" id="magnitud_siniestro" >
                                <option value="">Seleccione la Magnitud del Siniestro</option>
                                <option <?php if($siniestro->magnitud_siniestro == '1'){echo("selected");}?> value="1">Baja</option>
                                <option <?php if($siniestro->magnitud_siniestro == '2'){echo("selected");}?> value="2">Media</option>
                                <option <?php if($siniestro->magnitud_siniestro == '3'){echo("selected");}?> value="3">Alta</option>
                            </select>
                            
                        </div>
                        @if( $errors->has('magnitud_siniestro') )
                            <div class="alert alert-danger">
                            @foreach($errors->get('magnitud_siniestro') as $error )
                                {{ $error }}
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
                                    <option <?php if($siniestro->giro_empresa == $giro->id){echo("selected");}?> value="{{$giro->id}}"> {{$giro->giro}}</option>
                                @endforeach    
                            </select>
                            
                        </div>
                        @if( $errors->has('giro_empresa') )
                            <div class="alert alert-danger">
                            @foreach($errors->get('giro_empresa') as $error )
                                {{ $error }}
                            @endforeach
                            </div>
                        @endif
                    </div>

                    <div class="col-sm-6 col-md-4">
                        <div class="form-group form-select" id="form-select">
                            {{Form::label('estado', 'Estado', array('aria-hidden'=>'true'))}}
                            <select class="form-control form-sin" name="estado" id="estado" >
                                <option value="">Seleccione el Estado</option>
                                @foreach($estados as $estado)
                                    <option <?php if($siniestro->estado == $estado->id){echo("selected");}?> value="{{$estado->id}}">{{$estado->nombre}}</option>
                                @endforeach 
                            </select>
                        </div>
                        @if( $errors->has('estado') )
                            <div class="alert alert-danger">
                            @foreach($errors->get('estado') as $error )
                                {{ $error }}
                            @endforeach
                            </div>
                        @endif
                    </div>


                    <div class="col-sm-6 col-md-4">
                        <div class="form-group">
                            {{Form::label('ciudad', 'Ciudad', array('aria-hidden'=>'true'))}}
                            {{Form::text('ciudad', $siniestro->ciudad, array('class'=>'form-control form-sin', 'placeholder'=>'Ciudad', 'autocomplete'=>'off', 'aria-label'=>'Ciudad'))}}
                            
                        </div>
                        @if( $errors->has('ciudad') )
                            <div class="alert alert-danger">
                            @foreach($errors->get('ciudad') as $error )
                                {{ $error }}
                            @endforeach
                            </div>
                        @endif
                    </div>

                    <div class="col-sm-6 col-md-4">
                        <div class="form-group">
                            {{Form::label('domicilio', 'Domicilio', array('aria-hidden'=>'true'))}}
                            {{Form::text('domicilio', $siniestro->domicilio, array('class'=>'form-control form-sin', 'placeholder'=>'Calle, Numero y Colonia', 'autocomplete'=>'off', 'aria-label'=>'Domicilio'))}}
                            
                        </div>
                        @if( $errors->has('domicilio') )
                            <div class="alert alert-danger">
                            @foreach($errors->get('domicilio') as $error )
                                {{ $error }}
                            @endforeach
                            </div>
                        @endif
                    </div>

                    <div class="col-sm-6 col-md-6">
                        <div class="form-group">
                            {{Form::label('telefonos', 'Telefonos', array('aria-hidden'=>'true'))}}
                            {{Form::text('telefonos', $siniestro->telefonos, array('class'=>'form-control form-sin', 'placeholder'=>'Telefonos', 'autocomplete'=>'off', 'aria-label'=>'Telefonos'))}}
                            
                        </div>
                        @if( $errors->has('telefonos') )
                            <div class="alert alert-danger">
                            @foreach($errors->get('telefonos') as $error )
                                {{ $error }}
                            @endforeach
                            </div>
                        @endif
                    </div>

                    <div class="col-sm-6 col-md-6">
                        <div class="form-group">
                            {{Form::label('email', 'Email', array('aria-hidden'=>'true'))}}
                            {{Form::text('email', $siniestro->email, array('class'=>'form-control form-sin', 'placeholder'=>'Email', 'autocomplete'=>'off', 'aria-label'=>'Email'))}}
                            
                        </div>
                        @if( $errors->has('email') )
                            <div class="alert alert-danger">
                            @foreach($errors->get('email') as $error )
                                {{ $error }}
                            @endforeach
                            </div>
                        @endif
                    </div>

                    <div class="col-sm-12 col-md-12">
                        <div class="form-group">
                            {{Form::label('fuente_informacion', 'Fuente de Información', array('aria-hidden'=>'true'))}}
                            {{Form::text('fuente_informacion', $siniestro->fuente_informacion, array('class'=>'form-control form-sin', 'placeholder'=>'Fuente de Información', 'autocomplete'=>'off', 'aria-label'=>'Fuente de Información'))}}
                            
                        </div>
                        @if( $errors->has('fuente_informacion') )
                            <div class="alert alert-danger">
                            @foreach($errors->get('fuente_informacion') as $error )
                                {{ $error }}
                            @endforeach
                            </div>
                        @endif
                    </div>

                    


                </div>
                <div id="form-btns-editar" class="hidden">
                    {{Form::submit('Actualizar', array('class'=>'btn btn-success', 'id'=>'btnActPromSin'))}}
                    <button type="button" id="btnCanPromSin" class="btn btn-success" value="">Cancelar</button>
                </div>
                </fieldset>
                {{ Form::close() }}

                <fieldset>
                    <div class="form-group">
                        <button type="button" id="btnEditarPromSin" class="btn btn-success" value="">Editar Informacion</button>
                    </div>
                </fieldset>


                <!--formulario para cita-->
                {{ Form::open(array('url' => 'sire/promocion/siniestros/actualizar/cita/'.$siniestro->id)) }}
                <fieldset id="form-cita-sin" disabled>
                    <h3>Datos Sobre Cita</h3>
                    <div class="row">

                        <div class="col-sm-6 col-md-6">
                            <div class="form-group">
                                <?php 
                                    if ($siniestro->fecha_cita_realizada != null) {
                                        $fecha_cita_realizada = new DateTime($siniestro->fecha_cita_realizada);
                                        $fecha_cita_realizada=$fecha_cita_realizada->format('d/m/Y H:i');
                                    }
                                    else{
                                        $fecha_cita_realizada=$siniestro->fecha_cita_realizada;
                                    }
                                ?>
                                {{Form::label('fecha_cita_realizada', 'Fecha en que se realizo la cita')}}
                                {{Form::text('fecha_cita_realizada', $fecha_cita_realizada, ['class' => 'datetimepicker1 form-control form-sin']);}}
                            </div>
                            @if( $errors->has('fecha_cita_realizada') )
                                <div class="alert alert-danger">
                                @foreach($errors->get('fecha_cita_realizada') as $error )
                                    {{ $error }}
                                @endforeach
                                </div>
                            @endif
                        </div>
                        <div class="col-sm-6 col-md-6">
                            <div class="form-group">
                                <?php 
                                if ($siniestro->fecha_cita_agendada != null) {
                                    $fecha_cita_agendada = new DateTime($siniestro->fecha_cita_agendada);
                                    $fecha_cita_agendada=$fecha_cita_agendada->format('d/m/Y H:i');
                                }
                                else{
                                    $fecha_cita_agendada=$siniestro->fecha_cita_agendada;
                                }
                                
                                ?>
                                {{Form::label('fecha_cita_agendada', 'Fecha de la cita')}}
                                {{Form::text('fecha_cita_agendada', $fecha_cita_agendada, ['class' => 'datetimepicker1 form-control form-sin']);}}
                            </div>
                            @if( $errors->has('fecha_cita_agendada') )
                                <div class="alert alert-danger">
                                @foreach($errors->get('fecha_cita_agendada') as $error )
                                    {{ $error }}
                                @endforeach
                                </div>
                            @endif
                        </div>

                        <div class="col-sm-12 col-md-12">
                            <div class="form-group">
                                {{Form::label('lugar_cita', 'Lugar Para Cita', array('aria-hidden'=>'true'))}}
                                {{Form::text('lugar_cita', $siniestro->lugar_cita, array('class'=>'form-control form-sin', 'placeholder'=>'Lugar Para Cita', 'autocomplete'=>'off', 'aria-label'=>'Lugar Para Cita'))}}
                                
                            </div>
                            @if( $errors->has('lugar_cita') )
                                <div class="alert alert-danger">
                                @foreach($errors->get('lugar_cita') as $error )
                                    {{ $error }}
                                @endforeach
                                </div>
                            @endif
                        </div>
                    </div>

                    <div id="form-btns-cita" class="hidden">
                        {{Form::submit('Agregar/Actualizar', array('class'=>'btn btn-success', 'id'=>'btnCitaPromSin'))}}
                        <button type="button" id="btnCitaCanPromSin" class="btn btn-success" value="">Cancelar</button>
                    </div>
                </fieldset>
                {{ Form::close() }}
                

                <fieldset>
                    <div class="form-group">
                        <button type="button" id="btnAddCitaPromSin" class="btn btn-success" value="">Agregar/Editar Cita</button>
                    </div>
                </fieldset>


                <!--formulario para estatus-->
                {{ Form::open(array('url' => 'sire/promocion/siniestros/actualizar/estatus/'.$siniestro->id)) }}
                <fieldset id="form-estatus-sin" disabled>
                    <h3>Estatus</h3>
                    <div class="row">

                        <div class="col-sm-6 col-md-6">
                        <div class="form-group form-select" id="form-select">
                            {{Form::label('estatus', 'Estatus del Siniestro', array('aria-hidden'=>'true'))}}
                            
                            <select class="form-control form-sin" name="estatus" id="estatus" >
                                <option value="">Seleccione el estatus del siniestro</option>
                                <option <?php if($siniestro->estatus == 'Pendiente'){echo("selected");}?> value="Pendiente">Pendiente</option>
                                <option <?php if($siniestro->estatus == 'Aceptado'){echo("selected");}?> value="Aceptado">Aceptado</option>
                                <option <?php if($siniestro->estatus == 'Rechazado'){echo("selected");}?> value="Rechazado">Rechazado</option>
                            </select>
                            
                        </div>
                        @if( $errors->has('estatus') )
                            <div class="alert alert-danger">
                            @foreach($errors->get('estatus') as $error )
                                {{ $error }}
                            @endforeach
                            </div>
                        @endif
                        </div>
                    </div>

                    <div id="form-btns-estatus" class="hidden">
                        {{Form::submit('Actualizar Estatus', array('class'=>'btn btn-success', 'id'=>'btnEstatusPromSin'))}}
                        <button type="button" id="btnEstatusCanPromSin" class="btn btn-success" value="">Cancelar</button>
                    </div>
                </fieldset>
                {{ Form::close() }}

                @if($siniestro->estatus != "Aceptado")
                <fieldset>
                    <div class="form-group">
                        <button type="button" id="btnAddEstatusPromSin" class="btn btn-success" value="">Actualizar Estatus</button>
                    </div>
                </fieldset>
                @endif
                

            </div>

        </div>

    </div>

    <div class="row">
        <div class="col-md-12">
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
                        <h4>{{$comentario->usuario->nombre}} <small>{{$comentario->created_at}}</small></h4>
                        
                        <b>{{nl2br($comentario->comentario)}}</b>
                        
                    </div>

                @endforeach
            </div>

            <div class="well">
                
                {{ Form::open(array('url' => 'sire/promocion/siniestros/ver/comentar/'.$siniestro->id)) }}


                <div class="form-group">
                {{Form::label('comentario', 'Comentario')}}
                {{Form::textarea('comentario', Input::old('comentario'), array('class'=>'form-control', 'rows'=>3, 'placeholder'=>'Escribe algun comentario', 'autocomplete'=>'off',))}}
                </div>
                @if( $errors->has('comentario') )
                <div class="alert alert-danger">
                @foreach($errors->get('comentario') as $error )
                {{ $error }}
                @endforeach
                </div>
                @endif


                <div class="hidden">
                {{Form::text('id_promocion_siniestros', $siniestro->id)}}
                {{Form::text('id_usuario', Auth::user()->id)}}
                </div>

                {{Form::submit('Comentar', array('class'=>'btn btn-success', 'id'=>'btnSubmit'))}}
                {{Form::close() }}
                
            </div>
        </div>
    </div>



@stop

@section('modals')

    <div class="modal fade formPropuesta-modal" id="formPropuesta-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h4 class="modal-title" id="H1">Datos de Propuesta</h4>
                </div>
                {{ Form::open(array('url' => 'sire/promocion/siniestros/ver/propuesta')) }}
                    <div class="modal-body modal-body-propuesta">

                        <div class="row">
                            <div class="col-sm-6 col-md-6">
                                <div class="form-group">
                                    {{Form::label('asegurado', 'Asegurado', array('aria-hidden'=>'true'))}}
                                    {{Form::text('asegurado', Input::old('asegurado'), array('class'=>'form-control', 'placeholder'=>'Razón Social del Asegurado', 'autocomplete'=>'off', 'aria-label'=>'Razón Social del Asegurado', 'required'))}}
                                    
                                </div>
                                @if( $errors->has('asegurado') )
                                    <div class="alert alert-danger">
                                    @foreach($errors->get('asegurado') as $error )
                                        {{ $error }}<br>
                                    @endforeach
                                    </div>
                                @endif
                            </div>

                            <div class="col-sm-6 col-md-6">
                                <div class="form-group">
                                    {{Form::label('apoderado_legal', 'Apoderado Legal', array('aria-hidden'=>'true'))}}
                                    {{Form::text('apoderado_legal', Input::old('apoderado_legal'), array('class'=>'form-control', 'placeholder'=>'Nombre del Apoderado Legal', 'autocomplete'=>'off', 'aria-label'=>'Nombre del Apoderado Legal', 'required'))}}
                                    
                                </div>
                                @if( $errors->has('apoderado_legal') )
                                    <div class="alert alert-danger">
                                    @foreach($errors->get('apoderado_legal') as $error )
                                        {{ $error }}<br>
                                    @endforeach
                                    </div>
                                @endif
                            </div>

                            <div class="col-sm-6 col-md-4">
                                <div class="form-group form-select" id="form-select">
                                    {{Form::label('estado', 'Estado', array('aria-hidden'=>'true'))}}
                                    <select class="form-control form-sin" name="estado" id="estado" required>
                                        <option value="">Seleccione el Estado</option>
                                        @foreach($estados as $estado)
                                            <option value="{{$estado->id}}">{{$estado->nombre}}</option>
                                        @endforeach 
                                    </select>
                                </div>
                                @if( $errors->has('estado') )
                                    <div class="alert alert-danger">
                                    @foreach($errors->get('estado') as $error )
                                        {{ $error }}
                                    @endforeach
                                    </div>
                                @endif
                            </div>

                            <div class="col-sm-6 col-md-4">
                                <div class="form-group">
                                    {{Form::label('ciudad', 'Ciudad Siniestro', array('aria-hidden'=>'true'))}}
                                    {{Form::text('ciudad', Input::old('ciudad'), array('class'=>'form-control', 'placeholder'=>'Ciudad del siniestro', 'autocomplete'=>'off', 'aria-label'=>'Ciudad del siniestro', 'required'))}}
                                    
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
                                    {{Form::text('domicilio', '', array('class'=>'form-control form-sin', 'placeholder'=>'Calle, Numero y Colonia', 'autocomplete'=>'off', 'aria-label'=>'Domicilio', 'required'))}}
                                    
                                </div>
                                @if( $errors->has('domicilio') )
                                    <div class="alert alert-danger">
                                    @foreach($errors->get('domicilio') as $error )
                                        {{ $error }}
                                    @endforeach
                                    </div>
                                @endif
                            </div>

                            <div class="col-sm-6 col-md-4">
                                <div class="form-group">
                                    {{Form::label('fecha_siniestro', 'Fecha del Siniestro', array('aria-hidden'=>'true'))}}
                                    {{Form::text('fecha_siniestro', Input::old('fecha_siniestro'), array('class'=>'form-control datetimepicker1', 'aria-label'=>'', 'required'))}}
                                </div>
                                @if( $errors->has('fecha_siniestro') )
                                    <div class="alert alert-danger">
                                    @foreach($errors->get('fecha_siniestro') as $error )
                                        {{ $error }}<br>
                                    @endforeach
                                    </div>
                                @endif
                            </div>

                            <div class="col-sm-6 col-md-4">
                                <div class="form-group">
                                    {{Form::label('num_poliza', 'Numero de Poliza', array('aria-hidden'=>'true'))}}
                                    {{Form::text('num_poliza', Input::old('num_poliza'), array('class'=>'form-control', 'placeholder'=>'Numero de Poliza', 'autocomplete'=>'off', 'aria-label'=>'Numero de Poliza', 'required'))}}
                                    
                                </div>
                                @if( $errors->has('num_poliza') )
                                    <div class="alert alert-danger">
                                    @foreach($errors->get('num_poliza') as $error )
                                        {{ $error }}<br>
                                    @endforeach
                                    </div>
                                @endif
                            </div>

                            <div class="col-sm-6 col-md-4">
                                <div class="form-group">
                                    {{Form::label('aseguradora', 'Aseguradora', array('aria-hidden'=>'true'))}}
                                    {{Form::text('aseguradora', Input::old('aseguradora'), array('class'=>'form-control', 'placeholder'=>'Aseguradora', 'autocomplete'=>'off', 'aria-label'=>'Aseguradora', 'required'))}}
                                    
                                </div>
                                @if( $errors->has('aseguradora') )
                                    <div class="alert alert-danger">
                                    @foreach($errors->get('aseguradora') as $error )
                                        {{ $error }}<br>
                                    @endforeach
                                    </div>
                                @endif
                            </div>

                            <div class="col-sm-6 col-md-2">
                                <div class="form-group">
                                    {{Form::label('honorarios_porcentaje', '% Honorarios', array('aria-hidden'=>'true'))}}
                                    {{Form::number('honorarios_porcentaje', Input::old('honorarios_porcentaje'), array('class'=>'form-control', 'placeholder'=>'%', 'autocomplete'=>'off', 'aria-label'=>'Porcentaje de honorarios', 'required'))}}
                                    
                                </div>
                                @if( $errors->has('honorarios_porcentaje') )
                                    <div class="alert alert-danger">
                                    @foreach($errors->get('honorarios_porcentaje') as $error )
                                        {{ $error }}<br>
                                    @endforeach
                                    </div>
                                @endif
                            </div>

                            <div class="col-sm-6 col-md-10">
                                <div class="form-group">
                                    {{Form::label('honorarios_porcentaje_letra', 'Honorarios (letra)', array('aria-hidden'=>'true'))}}
                                    {{Form::text('honorarios_porcentaje_letra', Input::old('honorarios_porcentaje_letra'), array('class'=>'form-control', 'placeholder'=>'% Honorarios en letra', 'autocomplete'=>'off', 'aria-label'=>'porcentaje de honorarios en letra', 'required'))}}
                                    
                                </div>
                                @if( $errors->has('honorarios_porcentaje_letra') )
                                    <div class="alert alert-danger">
                                    @foreach($errors->get('honorarios_porcentaje_letra') as $error )
                                        {{ $error }}<br>
                                    @endforeach
                                    </div>
                                @endif
                            </div>

                            <div class="col-sm-6 col-md-2">
                                <div class="form-group">
                                    {{Form::label('anticipo_cantidad', 'Anticipo', array('aria-hidden'=>'true'))}}
                                    {{Form::number('anticipo_cantidad', Input::old('anticipo_cantidad'), array('class'=>'form-control', 'placeholder'=>'Anticipo', 'autocomplete'=>'off', 'aria-label'=>'anticipo', 'required'))}}
                                    
                                </div>
                                @if( $errors->has('anticipo_cantidad') )
                                    <div class="alert alert-danger">
                                    @foreach($errors->get('anticipo_cantidad') as $error )
                                        {{ $error }}<br>
                                    @endforeach
                                    </div>
                                @endif
                            </div>

                            <div class="col-sm-6 col-md-10">
                                <div class="form-group">
                                    {{Form::label('anticipo_cantidad_letra', 'Anticipo (letra)', array('aria-hidden'=>'true'))}}
                                    {{Form::text('anticipo_cantidad_letra', Input::old('anticipo_cantidad_letra'), array('class'=>'form-control', 'placeholder'=>'Cantidad Anticipo Letra', 'autocomplete'=>'off', 'aria-label'=>'cantidad de anticipo en letra', 'required'))}}
                                    
                                </div>
                                @if( $errors->has('anticipo_cantidad_letra') )
                                    <div class="alert alert-danger">
                                    @foreach($errors->get('anticipo_cantidad_letra') as $error )
                                        {{ $error }}<br>
                                    @endforeach
                                    </div>
                                @endif
                            </div>

                            <div class="col-sm-6 col-md-4">
                                <div class="form-group">
                                    {{Form::label('num_personas_atencion', 'Num Personas Atencion', array('aria-hidden'=>'true'))}}
                                    {{Form::number('num_personas_atencion', Input::old('num_personas_atencion'), array('class'=>'form-control', 'placeholder'=>'Num Personas Atencion', 'autocomplete'=>'off', 'aria-label'=>'numero de personas que atenderan el siniestro', 'required'))}}
                                    
                                </div>
                                @if( $errors->has('num_personas_atencion') )
                                    <div class="alert alert-danger">
                                    @foreach($errors->get('num_personas_atencion') as $error )
                                        {{ $error }}<br>
                                    @endforeach
                                    </div>
                                @endif
                            </div>

                            <div class="col-sm-6 col-md-4">
                                <div class="form-group form-select" id="form-select">
                                    {{Form::label('estado_propuesta', 'Estado Propuesta', array('aria-hidden'=>'true'))}}
                                    <select class="form-control form-sin" name="estado_propuesta" id="estado_propuesta" required>
                                        <option value="">Seleccione el Estado</option>
                                        @foreach($estados as $estado)
                                            <option value="{{$estado->id}}">{{$estado->nombre}}</option>
                                        @endforeach 
                                    </select>
                                </div>
                                @if( $errors->has('estado_propuesta') )
                                    <div class="alert alert-danger">
                                    @foreach($errors->get('estado_propuesta') as $error )
                                        {{ $error }}
                                    @endforeach
                                    </div>
                                @endif
                            </div>

                            <div class="col-sm-6 col-md-4">
                                <div class="form-group">
                                    {{Form::label('ciudad_propuesta', 'Ciudad Propuesta', array('aria-hidden'=>'true'))}}
                                    {{Form::text('ciudad_propuesta', Input::old('ciudad_propuesta'), array('class'=>'form-control', 'placeholder'=>'Ciudad Propuesta', 'autocomplete'=>'off', 'aria-label'=>'Ciudad donde se hara la propuesta', 'required'))}}
                                    
                                </div>
                                @if( $errors->has('ciudad_propuesta') )
                                    <div class="alert alert-danger">
                                    @foreach($errors->get('ciudad_propuesta') as $error )
                                        {{ $error }}<br>
                                    @endforeach
                                    </div>
                                @endif
                            </div>


                            <div class="hidden">
                                
                                <input type="text" name="id_promocion_siniestro" id="id_promocion_siniestro" value=""/>

                            </div>
                            

                        
                        </div>      
        
                    </div>
                    <div class="modal-footer">
                        {{Form::submit('Guardar', array('class'=>'btn btn-success', 'id'=>''))}}
                        {{Form::reset('Cancelar', array('class'=>'btn btn-default', 'data-dismiss'=> 'modal'))}}
                    </div>
                {{ Form::close() }}
            </div>
        </div>
    </div>



@stop

