{{{--nuevo averiguacion--}}}
<div class="modal fade nuevoAveriguacionR-modal" id="nuevoAveriguacionR-modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="H1">Agregar Informacion de Averiguacion</h4>
            </div>
            <div class="modal-body">
                {{ Form::open(array('url' => 'sire/reclamacion/siniestro/agregar/averiguacion/')) }}
                    <div class="row">
                        
                        <div class="col-sm-6 col-sm-offset-3 col-md-6 col-md-offset-3">
                            <div class="form-group">
                                {{Form::label('num_averiguacion', 'Numero de Averiguacion', array('aria-hidden'=>'true'))}}
                                {{Form::text('num_averiguacion', '',  array('class'=>'form-control form-sin', 'placeholder'=>'Numero de Averiguacion', 'autocomplete'=>'off', 'aria-label'=>'Numero de Averiguacion', 'required'))}}
                            </div>
                        </div>

                        <div class="col-sm-6 col-sm-offset-3 col-md-6 col-md-offset-3">
                            <div class="form-group">
                                {{Form::label('dependencia_judicial', 'Dependencia Judicial', array('aria-hidden'=>'true'))}}
                                {{Form::text('dependencia_judicial', '',  array('class'=>'form-control form-sin', 'placeholder'=>'Dependencia Judicial', 'autocomplete'=>'off', 'aria-label'=>'Dependencia Judicial', 'required'))}}
                            </div>
                        </div>

                        <div class="col-sm-6 col-sm-offset-3 col-md-6 col-md-offset-3">
                            <div class="form-group">
                                {{Form::label('titular_dependencia', 'Titular de la Dependencia', array('aria-hidden'=>'true'))}}
                                {{Form::text('titular_dependencia', '', array('class'=>'form-control form-sin', 'placeholder'=>'Titular de la Dependencia', 'autocomplete'=>'off', 'aria-label'=>'Titular de la Dependencia', 'required'))}}
                            </div>
                        </div>

                    </div>

                <div class="hidden">
                    <input type="text" name="id_siniestro" id="id_siniestro" value="{{$siniestro->id}}"/>
                </div>

                <div>
                    {{Form::submit('Agregar', array('class'=>'btn btn-success'))}}
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                </div>
                {{ Form::close() }}
            </div>

        </div>
    </div>
</div>

{{{--editar averiguacion--}}}
<div class="modal fade editarAveriguacionR-modal" id="editarAveriguacionR-modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="H1">Editar Averiguacion Previa</h4>
            </div>
            <div class="modal-body">
                {{ Form::open(array('url' => 'sire/reclamacion/siniestro/actualizar/averiguacion/')) }}
                    <div class="row">
                        
                        <div class="col-sm-6 col-sm-offset-3 col-md-6 col-md-offset-3">
                            <div class="form-group">
                                {{Form::label('num_averiguacion', 'Numero de Averiguacion', array('aria-hidden'=>'true'))}}
                                {{Form::text('num_averiguacion', '',  array('class'=>'form-control form-sin', 'placeholder'=>'Numero de Averiguacion', 'autocomplete'=>'off', 'aria-label'=>'Numero de Averiguacion', 'required'))}}
                            </div>
                        </div>

                        <div class="col-sm-6 col-sm-offset-3 col-md-6 col-md-offset-3">
                            <div class="form-group">
                                {{Form::label('dependencia_judicial', 'Dependencia Judicial', array('aria-hidden'=>'true'))}}
                                {{Form::text('dependencia_judicial', '',  array('class'=>'form-control form-sin', 'placeholder'=>'Dependencia Judicial', 'autocomplete'=>'off', 'aria-label'=>'Dependencia Judicial', 'required'))}}
                            </div>
                        </div>

                        <div class="col-sm-6 col-sm-offset-3 col-md-6 col-md-offset-3">
                            <div class="form-group">
                                {{Form::label('titular_dependencia', 'Titular de la Dependencia', array('aria-hidden'=>'true'))}}
                                {{Form::text('titular_dependencia', '', array('class'=>'form-control form-sin', 'placeholder'=>'Titular de la Dependencia', 'autocomplete'=>'off', 'aria-label'=>'Titular de la Dependencia', 'required'))}}
                            </div>
                        </div>

                    </div>

                <div class="hidden">
                    <input type="text" name="id_averiguacion" id="id_averiguacion" value="{{$siniestro->id_averiguacion_previa}}"/>
                </div>

                <div>
                    {{Form::submit('Actualizar', array('class'=>'btn btn-success'))}}
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                </div>
                {{ Form::close() }}
            </div>
        </div>
    </div>
</div>

