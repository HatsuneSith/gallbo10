<div class="modal fade" id="avisoFormatos-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel"></h4>
            </div>
            <div class="modal-body">
                <h5 class="mensaje"></h5>
                <div class="lista_variables" id="lista_variables">
                </div>
                <div class="row">
                <div class="error col-sm-6">
                </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Aceptar/Cancelar</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade formContrato-modal" id="formContrato-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="H1">Datos de Contrato</h4>
            </div>
            {{ Form::open(array('url' => 'sire/reclamacion/formatos/contrato/imprimir')) }}
                <div class="modal-body modal-body-contrato-sin">

                    <div class="row">

                        <div class="col-sm-6 col-md-2">
                            <div class="form-group">
                                {{Form::label('honorarios_porcentaje', '% Honorarios', array('aria-hidden'=>'true'))}}
                                {{Form::number('honorarios_porcentaje', Input::old('honorarios_porcentaje'), array('class'=>'form-control', 'placeholder'=>'%', 'autocomplete'=>'off', 'aria-label'=>'Porcentaje de honorarios', 'required'))}}
                                
                            </div>
                        </div>

                        <div class="col-sm-6 col-md-10">
                            <div class="form-group">
                                {{Form::label('honorarios_porcentaje_letra', 'Honorarios (letra)', array('aria-hidden'=>'true'))}}
                                {{Form::text('honorarios_porcentaje_letra', Input::old('honorarios_porcentaje_letra'), array('class'=>'form-control', 'placeholder'=>'% Honorarios en letra', 'autocomplete'=>'off', 'aria-label'=>'porcentaje de honorarios en letra', 'required'))}}
                                
                            </div>
                        </div>

                        <div class="col-sm-6 col-md-2">
                            <div class="form-group">
                                {{Form::label('anticipo_cantidad', 'Anticipo', array('aria-hidden'=>'true'))}}
                                {{Form::number('anticipo_cantidad', Input::old('anticipo_cantidad'), array('class'=>'form-control', 'placeholder'=>'Anticipo', 'autocomplete'=>'off', 'aria-label'=>'anticipo', 'required'))}}
                                
                            </div>
                        </div>

                        <div class="col-sm-6 col-md-10">
                            <div class="form-group">
                                {{Form::label('anticipo_cantidad_letra', 'Anticipo (letra)', array('aria-hidden'=>'true'))}}
                                {{Form::text('anticipo_cantidad_letra', Input::old('anticipo_cantidad_letra'), array('class'=>'form-control', 'placeholder'=>'Cantidad Anticipo Letra', 'autocomplete'=>'off', 'aria-label'=>'cantidad de anticipo en letra', 'required'))}}
                                
                            </div>
                        </div>

                        <div class="col-sm-6 col-md-4">
                            <div class="form-group">
                                {{Form::label('num_personas_atencion', 'Num Personas Atencion', array('aria-hidden'=>'true'))}}
                                {{Form::number('num_personas_atencion', Input::old('num_personas_atencion'), array('class'=>'form-control', 'placeholder'=>'Num Personas Atencion', 'autocomplete'=>'off', 'aria-label'=>'numero de personas que atenderan el siniestro', 'required'))}}
                                
                            </div>
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
                        </div>

                        <div class="col-sm-6 col-md-4">
                            <div class="form-group">
                                {{Form::label('ciudad_propuesta', 'Ciudad Propuesta', array('aria-hidden'=>'true'))}}
                                {{Form::text('ciudad_propuesta', Input::old('ciudad_propuesta'), array('class'=>'form-control', 'placeholder'=>'Ciudad Propuesta', 'autocomplete'=>'off', 'aria-label'=>'Ciudad donde se hara la propuesta', 'required'))}}
                                
                            </div>
                        </div>


                        <div class="hidden">
                            <input type="text" name="id_siniestro" id="id_siniestro" value="{{$siniestro->id}}"/>
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

<div class="modal fade formAnticipoIndemnizacion-modal" id="formAnticipoIndemnizacion-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="H1">Solicitud de Anticipo de Indemnizacion</h4>
            </div>
            {{ Form::open(array('url' => 'sire/reclamacion/formatos/descargar/anticipo_indemnizacion')) }}
                <div class="modal-body modal-body-contrato-sin">

                    <div class="row">

                        <div class="col-sm-6 col-md-2">
                            <div class="form-group">
                                {{Form::label('cantidad_anticipo', 'Cantidad Anticipo', array('aria-hidden'=>'true'))}}
                                {{Form::number('cantidad_anticipo', Input::old('cantidad_anticipo'), array('class'=>'form-control', 'placeholder'=>'$', 'autocomplete'=>'off', 'aria-label'=>'Cantidad de Anticipo', 'required'))}}
                                
                            </div>
                        </div>

                        <div class="col-sm-6 col-md-10">
                            <div class="form-group">
                                {{Form::label('cantidad_anticipo_letra', 'Cantidad Anticipo (letra)', array('aria-hidden'=>'true'))}}
                                {{Form::text('cantidad_anticipo_letra', Input::old('cantidad_anticipo_letra'), array('class'=>'form-control', 'placeholder'=>'$ Cantidad Anticipo en letra', 'autocomplete'=>'off', 'aria-label'=>'Cantidad Anticipo en letra', 'required'))}}
                                
                            </div>
                        </div>

                        <div class="hidden">
                            <input type="text" name="id_siniestro" id="id_siniestro" value="{{$siniestro->id}}"/>
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

<div class="modal fade formSolicitudProrroga-modal" id="formSolicitudProrroga-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="H1">Solicitud de Prorroga</h4>
            </div>
            {{ Form::open(array('url' => 'sire/reclamacion/formatos/descargar/solicitud_prorroga')) }}
                <div class="modal-body modal-body-contrato-sin">

                    <div class="row">

                        <div class="col-sm-6 col-md-6">
                            <div class="form-group">
                                {{Form::label('fecha_carta', 'Fecha de Carta')}}
                                {{Form::input('date', 'fecha_carta', '', ['class' => 'form-control', 'placeholder' => 'Date', 'required']);}}
                            </div>
                        </div>

                        <div class="col-sm-6 col-md-6">
                            <div class="form-group">
                                {{Form::label('dias_prorroga', 'Dias de Prorroga', array('aria-hidden'=>'true'))}}
                                {{Form::number('dias_prorroga', Input::old('dias_prorroga'), array('class'=>'form-control', 'placeholder'=>'', 'autocomplete'=>'off', 'aria-label'=>'Dias Prorroga', 'required'))}}
                            </div>
                        </div>

                        <div class="hidden">
                            <input type="text" name="id_siniestro" id="id_siniestro" value="{{$siniestro->id}}"/>
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