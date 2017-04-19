<div class="modal fade editarSiniestroR-modal" id="editarSiniestroR-modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="H1">Editar Siniestro</h4>
            </div>
            <div class="modal-body">
                {{ Form::open(array('url' => 'sire/reclamacion/siniestro/actualizar/siniestro/')) }}
                
                <div class="row">
                    <div class="col-sm-6 col-md-4">
                        <div class="form-group">
                            {{Form::label('fecha', 'Fecha del Siniestro')}}
                            {{Form::text('fecha', '', ['class' => 'datetimepicker1 form-control form-sin', 'placeholder' => 'Date', 'required'])}}
                        </div>
                    </div>

                    <div class="col-sm-6 col-md-4">
                        <div class="form-group">
                            {{Form::label('num_siniestro', 'Numero de Siniestro', array('aria-hidden'=>'true'))}}
                            {{Form::text('num_siniestro', '',  array('class'=>'form-control form-sin', 'placeholder'=>'Numero de Siniestro', 'autocomplete'=>'off', 'aria-label'=>'Numero de Siniestro'))}}
                            
                        </div>
                    </div>

                    <div class="col-sm-6 col-md-4">
                        <div class="form-group form-select" id="form-select">
                            {{Form::label('tipo_siniestro', 'Tipo de Siniestro', array('aria-hidden'=>'true'))}}
                            <select class="form-control form-sin" name="tipo_siniestro" id="tipo_siniestro" >
                                <option value="">Seleccione el Tipo de Siniestro</option>
                                @foreach($tipos_siniestros as $tipo)
                                    <option value="{{$tipo->id}}"> {{$tipo->tipo}}</option>
                                @endforeach    
                            </select>
                            
                        </div>
                    </div>

                    <div class="col-sm-12 col-md-12">
                        <div class="form-group">
                            {{Form::label('domicilio', 'Domicilio', array('aria-hidden'=>'true'))}}
                            {{Form::text('domicilio', '',  array('class'=>'form-control form-sin', 'placeholder'=>'Calle, Numero y Colonia', 'autocomplete'=>'off', 'aria-label'=>'Domicilio'))}}
                            
                        </div>
                    </div>

                    <div class="col-sm-6 col-md-4">
                        <div class="form-group form-select" id="form-select">
                            {{Form::label('estado', 'Estado', array('aria-hidden'=>'true'))}}
                            <select class="form-control form-sin" name="estado" id="estado" >
                                <option value="">Seleccione el Estado</option>
                                @foreach($estados as $estado)
                                    <option value="{{$estado->id}}">{{$estado->nombre}}</option>
                                @endforeach 
                            </select>
                        </div>
                    </div>

                    <div class="col-sm-6 col-md-4">
                        <div class="form-group">
                            {{Form::label('ciudad', 'Ciudad', array('aria-hidden'=>'true'))}}
                            {{Form::text('ciudad', '',  array('class'=>'form-control form-sin', 'placeholder'=>'Ciudad', 'autocomplete'=>'off', 'aria-label'=>'Ciudad'))}}
                            
                        </div>
                    </div>

                    <div class="col-sm-6 col-md-4">
                        <div class="form-group">
                            {{Form::label('codigo_postal', 'Codigo Postal', array('aria-hidden'=>'true'))}}
                            {{Form::text('codigo_postal', '',  array('class'=>'form-control form-sin', 'placeholder'=>'Codigo Postal', 'autocomplete'=>'off', 'aria-label'=>'Codigo Postal'))}}
                            
                        </div>
                    </div>

                </div>

                <div class="hidden">
                <input type="text" name="id" id="id" value=""/>
                </div>

                <div id="form-btns-editar">
                    {{Form::submit('Actualizar', array('class'=>'btn btn-success', 'id'=>'btnActReclSin'))}}
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                </div>
                {{ Form::close() }}
            </div>

        </div>
    </div>
</div>

{{{--agregar ejecutivo--}}}
<div class="modal fade nuevoEjecutivoAsignadoR-modal" id="nuevoEjecutivoAsignadoR-modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="H1">Asignar Ejecutivo</h4>
            </div>
            {{ Form::open(array('url' => 'sire/reclamacion/siniestro/agregar/ejecutivo_asignado/', 'files'=>true)) }}
                <div class="modal-body">
                    @foreach($ejecutivos as $ejecutivo)
                        <div class="checkbox">
                            <label><input type="checkbox" name="checkejecutivo[]" value="{{$ejecutivo->id}}">{{$ejecutivo->nombre . " " . $ejecutivo->apellido}}</label>
                        </div>
                    @endforeach 
                    <div class="hidden">
                        <input type="text" name="id_siniestro" id="id_siniestro" value="{{$siniestro->id}}"/>
                    </div>
                    
                </div>
                <div class="modal-footer">
                    {{Form::submit('Aceptar', array('class'=>'btn btn-success'))}}
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                </div>
            {{ Form::close() }}

        </div>
    </div>
</div>

{{{--editar ejecutivo--}}}
<div class="modal fade editarEjecutivoAsignadoR-modal" id="editarEjecutivoAsignadoR-modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="H1">Asignar Ejecutivo</h4>
            </div>
            {{ Form::open(array('url' => 'sire/reclamacion/siniestro/actualizar/ejecutivo_asignado/', 'files'=>true)) }}
                <div class="modal-body">
                    @foreach($ejecutivos as $ejecutivo)
                        <div class="checkbox">
                            <label><input type="checkbox" name="checkejecutivo[]" value="{{$ejecutivo->id}}" <?php if($siniestro->ejecutivo_asignado()->get()->contains($ejecutivo->id)){echo "checked";} ?> >{{$ejecutivo->nombre . " " . $ejecutivo->apellido}}</label>
                        </div>
                    @endforeach 
                    <div class="hidden">
                        <input type="text" name="id_siniestro" id="id_siniestro" value="{{$siniestro->id}}"/>
                    </div>
                    
                </div>
                <div class="modal-footer">
                    {{Form::submit('Actualizar', array('class'=>'btn btn-success'))}}
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                </div>
            {{ Form::close() }}

        </div>
    </div>
</div>