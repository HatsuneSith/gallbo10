{{{--agregar documento--}}}
<div class="modal fade nuevoDocumentoSiniestroR-modal" id="nuevoDocumentoSiniestroR-modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="H1">Agregar Logo</h4>
            </div>
            <div class="modal-body">
                {{ Form::open(array('url' => 'sire/reclamacion/siniestro/agregar/documento/', 'files'=>true)) }}
                <div class="row">
                    <div class="col-sm-12 col-md-12">
                        <div class="form-group">
                            <label class="control-label">Seleccionar archivo</label>
                            <input id="documento" name="documento" type="file" class="file" >
                        </div>
                    </div>
                </div>

                <div class="hidden">
                    <input type="text" name="id_siniestro" id="id_siniestro" value="{{$siniestro->id}}"/>
                    <input type="text" name="id_documento" id="id_documento" value=""/>
                </div>

                <div>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                </div>
                {{ Form::close() }}
            </div>

        </div>
    </div>
</div>

{{{--editar documentacion--}}}
<div class="modal fade editarDocumentacionR-modal" id="editarDocumentacionR-modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="H1">Documentos</h4>
            </div>
            {{ Form::open(array('url' => 'sire/reclamacion/siniestro/actualizar/informacion_documentos/', 'files'=>true)) }}
                <div class="modal-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th class="col-sm-4">Documento</th>
                                <th class="col-sm-2">Responsable</th>
                                <th class="col-sm-2">Fecha de Entrega</th>
                                <th class="col-sm-4">Observaciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(count($siniestro->documentos()->get()) > 0)
                            @foreach($siniestro->clasificacion_documentos()->get() as $cla)
                                <tr class="info" ><th colspan="4">{{$cla->clasificacion}}</th></tr>
                                @foreach($siniestro->documentos()->get() as $ds)
                                @if($ds->id_clasificacion == $cla->id)
                                    <tr>
                                        <td>{{$ds->documento}} <input type="hidden" name="id_documento[]" id="id_documento" value="{{$ds->id}}"/>
                                        </td>
                                        <td>
                                            <select class="form-control form-sin" name="id_responsable[]" id="id_responsable" >
                                                <option value="">Seleccione</option>
                                                @foreach($siniestro->responsable as $r)
                                                    <option <?php if($ds->pivot->id_responsable == $r->id){echo "selected";} ?> value="{{$r->id}}"> {{$r->nombre}} {{$r->apellido}}</option>
                                                @endforeach    
                                            </select>
                                        </td>
                                        <td>
                                            <input type="text" name="fecha_entrega[]" class="datetimepicker2 form-control" value=" <?php if($ds->pivot->fecha_entrega != null){echo date_format(date_create($ds->pivot->fecha_entrega), 'd/m/Y');} else{echo "NULL";} ?> "> 
                                        </td>
                                        <td>{{Form::text('observaciones[]', $ds->pivot->observaciones,  array('class'=>'form-control form-sin', 'autocomplete'=>'off', 'aria-label'=>'Observaciones'))}}
                                        </td>
                                    </tr>
                                @endif
                                @endforeach
                            @endforeach
                            @endif
                        </tbody>
                    </table>
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

{{{--nuevo contacto--}}}
<div class="modal fade nuevoResponsableR-modal" id="nuevoResponsableR-modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="H1">Agregar Responsable</h4>
            </div>
            <div class="modal-body">
                {{ Form::open(array('url' => 'sire/reclamacion/siniestro/agregar/responsable/')) }}
                <div class="row">
                    <div class="col-sm-6 col-md-4">
                        <div class="form-group">
                            {{Form::label('nombre', 'Nombre', array('aria-hidden'=>'true'))}}
                            {{Form::text('nombre', '',  array('class'=>'form-control form-sin', 'placeholder'=>'Nombre', 'autocomplete'=>'off', 'aria-label'=>'Nombre', 'required'))}}
                        </div>
                    </div>

                    <div class="col-sm-6 col-md-4">
                        <div class="form-group">
                            {{Form::label('apellido', 'Apellido', array('aria-hidden'=>'true'))}}
                            {{Form::text('apellido', '',  array('class'=>'form-control form-sin', 'placeholder'=>'Apellido', 'autocomplete'=>'off', 'aria-label'=>'Apellido', 'required'))}}
                        </div>
                    </div>

                    <div class="col-sm-6 col-md-4">
                        <div class="form-group">
                            {{Form::label('telefono', 'Telefono', array('aria-hidden'=>'true'))}}
                            {{Form::text('telefono', '',  array('class'=>'form-control form-sin', 'placeholder'=>'telefono', 'autocomplete'=>'off', 'aria-label'=>'telefono', 'required'))}}
                        </div>
                    </div>

                    <div class="col-sm-6 col-md-4">
                        <div class="form-group">
                            {{Form::label('email', 'E-mail', array('aria-hidden'=>'true'))}}
                            {{Form::text('email', '',  array('class'=>'form-control form-sin', 'placeholder'=>'e-mail', 'autocomplete'=>'off', 'aria-label'=>'email', 'required'))}}
                        </div>
                    </div>

                     <div class="col-md-6 col-md-4">
                        <div class="form-group">
                            {{Form::label('password', 'Password')}}<br>
                            {{Form::input('password', 'password', Input::old('password'), array('class'=>'form-control', 'placeholder'=>'Contraseña del usuario', 'autocomplete'=>'off', 'required'))}}
                        </div>
                    </div>

                </div>

                <div class="hidden">
                    <input type="text" name="id_siniestro" id="id_siniestro" value="{{$siniestro->id}}"/>
                    <input type="text" name="departamento" id="departamento" value="Clientes"/>
                    <input type="text" name="rol" id="rol" value="Responsable"/>
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

{{{--ver repsonsables--}}}
<div class="modal fade verResponsablesR-modal" id="verResponsablesR-modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="H1">Responsables</h4>
            </div>
                <div class="modal-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th class="col-sm-4">Nombre</th>
                                <th class="col-sm-2">Apellido</th>
                                <th class="col-sm-2">Telefono</th>
                                <th class="col-sm-4">Email</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(count($siniestro->responsable()->get()) > 0)
                                @foreach($siniestro->responsable()->get() as $r)
                                     <tr>
                                        <th>{{$r->nombre}}</th>
                                        <th>{{$r->apellido}}</th>
                                        <th>{{$r->telefono}}</th>
                                        <th>{{$r->email}}</th>
                                     </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                    
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-success" data-dismiss="modal">Aceptar</button>
                </div>

        </div>
    </div>
</div>