{{--editar asegurado--}}
<div class="modal fade editarAseguradoR-modal" id="editarAseguradoR-modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="H1">Editar Asegurado</h4>
            </div>
            <div class="modal-body">
                {{ Form::open(array('url' => 'sire/reclamacion/siniestro/actualizar/asegurado/', 'files'=>true)) }}
                <div class="row">
                    
                    <div class="col-sm-6 col-md-4">
                        <div class="form-group">
                            {{Form::label('nombre', 'Nombre o Razon Social', array('aria-hidden'=>'true'))}}
                            {{Form::text('nombre', '',  array('class'=>'form-control form-sin', 'placeholder'=>'Nombre o Razon Social', 'autocomplete'=>'off', 'aria-label'=>'Nombre o Razon Social', 'required'))}}
                        </div>
                    </div>

                    <div class="col-sm-6 col-md-4">
                        <div class="form-group form-select" id="form-select">
                            {{Form::label('tipo_persona', 'Tipo de Persona', array('aria-hidden'=>'true'))}}
                            <select class="form-control form-sin" name="tipo_persona" id="tipo_persona" required>
                                <option value="">Seleccione el Tipo de Persona </option>
                                @foreach($tipos_personas as $tipo)
                                    <option value="{{$tipo->id}}"> {{$tipo->tipo}}</option>
                                @endforeach    
                            </select>
                        </div>
                    </div>

                    <div class="col-sm-6 col-md-4">
                        <div class="form-group form-select" id="form-select">
                            {{Form::label('giro', 'Giro', array('aria-hidden'=>'true'))}}
                            <select class="form-control form-sin" name="giro" id="giro" required>
                                <option value="">Seleccione el Giro </option>
                                @foreach($giros_empresas as $giro)
                                    <option value="{{$giro->id}}"> {{$giro->giro}}</option>
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

                    <div class="col-sm-6 col-md-4">
                        <div class="form-group">
                            {{Form::label('telefono', 'Telefono', array('aria-hidden'=>'true'))}}
                            {{Form::text('telefono', '',  array('class'=>'form-control form-sin', 'placeholder'=>'telefono', 'autocomplete'=>'off', 'aria-label'=>'telefono'))}}
                        </div>
                    </div>

                    <div class="col-sm-6 col-md-4">
                        <div class="form-group">
                            {{Form::label('fax', 'Fax', array('aria-hidden'=>'true'))}}
                            {{Form::text('fax', '',  array('class'=>'form-control form-sin', 'placeholder'=>'fax', 'autocomplete'=>'off', 'aria-label'=>'fax'))}}
                        </div>
                    </div>

                    <div class="col-sm-6 col-md-4">
                        <div class="form-group">
                            {{Form::label('email', 'E-mail', array('aria-hidden'=>'true'))}}
                            {{Form::text('email', '',  array('class'=>'form-control form-sin', 'placeholder'=>'e-mail', 'autocomplete'=>'off', 'aria-label'=>'email'))}}
                        </div>
                    </div>

                    <div class="col-sm-6 col-md-4">
                        <div class="form-group">
                            {{Form::label('rfc', 'RFC', array('aria-hidden'=>'true'))}}
                            {{Form::text('rfc', '',  array('class'=>'form-control form-sin', 'placeholder'=>'RFC', 'autocomplete'=>'off', 'aria-label'=>'RFC'))}}
                        </div>
                    </div>

                    <div class="col-sm-6 col-md-4">
                        <div class="form-group form-select" id="form-select">
                            {{Form::label('sexo', 'Sexo', array('aria-hidden'=>'true'))}}
                            <select class="form-control form-sin" name="sexo" id="sexo" >
                                <option value="">Seleccione el Sexo</option>
                                @foreach($sexos as $sexo)
                                    <option value="{{$sexo->id}}">{{$sexo->sexo}}</option>
                                @endforeach 
                            </select>
                        </div>
                    </div>
                </div>

                <div class="hidden">
                    <input type="text" name="id" id="id" value=""/>
                </div>

                <div id="form-btns-editar">
                    {{Form::submit('Actualizar', array('class'=>'btn btn-success'))}}
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                </div>
                {{ Form::close() }}
            </div>

        </div>
    </div>
</div>

{{-------------------------------------------------------------------------------------------------------------}}

{{--nuevo apoderado--}}
<div class="modal fade nuevoApoderadoR-modal" id="nuevoApoderadoR-modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="H1">Agregar Apoderado Legal</h4>
            </div>
            <div class="modal-body">
                {{ Form::open(array('url' => 'sire/reclamacion/siniestro/agregar/apoderado/')) }}
                <div class="row">
                    <div class="col-sm-6 col-md-4">
                        <div class="form-group">
                            {{Form::label('nombre', 'Nombre', array('aria-hidden'=>'true'))}}
                            {{Form::text('nombre', '',  array('class'=>'form-control form-sin', 'placeholder'=>'Nombre', 'autocomplete'=>'off', 'aria-label'=>'Nombre', 'required'))}}
                        </div>
                    </div>

                    <div class="col-sm-6 col-md-4">
                        <div class="form-group form-select" id="form-select">
                            {{Form::label('sexo', 'Sexo', array('aria-hidden'=>'true'))}}
                            <select class="form-control form-sin" name="sexo" id="sexo" required>
                                <option value="">Seleccione el Sexo</option>
                                @foreach($sexos as $sexo)
                                    <option value="{{$sexo->id}}">{{$sexo->sexo}}</option>
                                @endforeach 
                            </select>
                        </div>
                    </div>

                    <div class="col-sm-6 col-md-4">
                        <div class="form-group">
                            {{Form::label('telefono', 'Telefono', array('aria-hidden'=>'true'))}}
                            {{Form::text('telefono', '',  array('class'=>'form-control form-sin', 'placeholder'=>'telefono', 'autocomplete'=>'off', 'aria-label'=>'telefono'))}}
                        </div>
                    </div>

                    <div class="col-sm-6 col-md-4">
                        <div class="form-group">
                            {{Form::label('email', 'E-mail', array('aria-hidden'=>'true'))}}
                            {{Form::text('email', '',  array('class'=>'form-control form-sin', 'placeholder'=>'e-mail', 'autocomplete'=>'off', 'aria-label'=>'email'))}}
                        </div>
                    </div>

                    <div class="col-sm-6 col-md-4">
                        <div class="form-group">
                            {{Form::label('nextel', 'Nextel', array('aria-hidden'=>'true'))}}
                            {{Form::text('nextel', '',  array('class'=>'form-control form-sin', 'placeholder'=>'Nextel', 'autocomplete'=>'off', 'aria-label'=>'Nextel'))}}
                        </div>
                    </div>
                </div>

                <div class="hidden">
                    <input type="text" name="id_asegurado" id="id_asegurado" value="{{$siniestro->id_asegurado}}"/>
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

{{--seleccionar apoderado--}}
<div class="modal fade seleccionarApoderadoR-modal" id="seleccionarApoderadoR-modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="H1">Seleccionar Apoderado Legal</h4>
            </div>
            <div class="modal-body">
                
                <div class="row">
                    <div class="col-sm-6 col-sm-offset-3 col-md-6 col-md-offset-3">
                        <div class="form-group">
                            {{Form::label('nombre', 'Nombre', array('aria-hidden'=>'true'))}}
                            {{Form::text('nombre', '',  array('class'=>'form-control form-sin', 'id'=>'nombreApoderado', 'placeholder'=>'Nombre', 'autocomplete'=>'off', 'aria-label'=>'Nombre', 'style' => 'width: 100%', 'required'))}}
                        </div>
                    </div>


                    <div class="col-sm-6 col-md-6">
                        <div class="form-group form-select" id="form-select">
                            {{Form::label('sexo', 'Sexo', array('aria-hidden'=>'true'))}}
                            <select class="form-control form-sin" name="sexo" id="sexo" required disabled>
                                <option value="">Seleccione el Sexo</option>
                                @foreach($sexos as $sexo)
                                    <option value="{{$sexo->id}}">{{$sexo->sexo}}</option>
                                @endforeach 
                            </select>
                        </div>
                    </div>

                    <div class="col-sm-6 col-md-6">
                        <div class="form-group">
                            {{Form::label('telefono', 'Telefono', array('aria-hidden'=>'true'))}}
                            {{Form::text('telefono', '',  array('class'=>'form-control form-sin', 'placeholder'=>'telefono', 'autocomplete'=>'off', 'aria-label'=>'telefono', 'disabled'))}}
                        </div>
                    </div>

                    <div class="col-sm-6 col-md-6">
                        <div class="form-group">
                            {{Form::label('email', 'E-mail', array('aria-hidden'=>'true'))}}
                            {{Form::text('email', '',  array('class'=>'form-control form-sin', 'placeholder'=>'e-mail', 'autocomplete'=>'off', 'aria-label'=>'email', 'disabled'))}}
                        </div>
                    </div>

                    <div class="col-sm-6 col-md-6">
                        <div class="form-group">
                            {{Form::label('nextel', 'Nextel', array('aria-hidden'=>'true'))}}
                            {{Form::text('nextel', '',  array('class'=>'form-control form-sin', 'placeholder'=>'Nextel', 'autocomplete'=>'off', 'aria-label'=>'Nextel', 'disabled'))}}
                        </div>
                    </div>
                    
                </div>
                {{ Form::open(array('url' => 'sire/reclamacion/siniestro/seleccionar/apoderado/')) }}
                <div class="hidden">
                    <input type="text" name="id_asegurado" id="id_asegurado" value="{{$siniestro->id_asegurado}}"/>
                    <input type="text" name="id_apoderado_legal" id="id_apoderado_legal" value=""/>
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

{{--editar apoderado--}}
<div class="modal fade editarApoderadoR-modal" id="editarApoderadoR-modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="H1">Editar Apoderado Legal</h4>
            </div>
            <div class="modal-body">
                {{ Form::open(array('url' => 'sire/reclamacion/siniestro/actualizar/apoderado/')) }}
                <div class="row">
                    <div class="col-sm-6 col-md-4">
                        <div class="form-group">
                            {{Form::label('nombre', 'Nombre', array('aria-hidden'=>'true'))}}
                            {{Form::text('nombre', '',  array('class'=>'form-control form-sin', 'placeholder'=>'Nombre', 'autocomplete'=>'off', 'aria-label'=>'Nombre', 'required'))}}
                        </div>
                    </div>

                    <div class="col-sm-6 col-md-4">
                        <div class="form-group form-select" id="form-select">
                            {{Form::label('sexo', 'Sexo', array('aria-hidden'=>'true'))}}
                            <select class="form-control form-sin" name="sexo" id="sexo" required>
                                <option value="">Seleccione el Sexo</option>
                                @foreach($sexos as $sexo)
                                    <option value="{{$sexo->id}}">{{$sexo->sexo}}</option>
                                @endforeach 
                            </select>
                        </div>
                    </div>

                    <div class="col-sm-6 col-md-4">
                        <div class="form-group">
                            {{Form::label('telefono', 'Telefono', array('aria-hidden'=>'true'))}}
                            {{Form::text('telefono', '',  array('class'=>'form-control form-sin', 'placeholder'=>'telefono', 'autocomplete'=>'off', 'aria-label'=>'telefono'))}}
                        </div>
                    </div>

                    <div class="col-sm-6 col-md-4">
                        <div class="form-group">
                            {{Form::label('email', 'E-mail', array('aria-hidden'=>'true'))}}
                            {{Form::text('email', '',  array('class'=>'form-control form-sin', 'placeholder'=>'e-mail', 'autocomplete'=>'off', 'aria-label'=>'email'))}}
                        </div>
                    </div>

                    <div class="col-sm-6 col-md-4">
                        <div class="form-group">
                            {{Form::label('nextel', 'Nextel', array('aria-hidden'=>'true'))}}
                            {{Form::text('nextel', '',  array('class'=>'form-control form-sin', 'placeholder'=>'Nextel', 'autocomplete'=>'off', 'aria-label'=>'Nextel'))}}
                        </div>
                    </div>
                </div>

                <div class="hidden">
                    <input type="text" name="id_apoderado_legal" id="id_apoderado_legal" value="{{$siniestro->asegurado->id_apoderado_legal}}"/>
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

{{-------------------------------------------------------------------------------------------------------------}}

{{--nuevo contacto--}}
<div class="modal fade nuevoContactoR-modal" id="nuevoContactoR-modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="H1">Agregar Contacto</h4>
            </div>
            <div class="modal-body">
                {{ Form::open(array('url' => 'sire/reclamacion/siniestro/agregar/contacto/')) }}
                <div class="row">
                    <div class="col-sm-6 col-md-4">
                        <div class="form-group">
                            {{Form::label('nombre', 'Nombre', array('aria-hidden'=>'true'))}}
                            {{Form::text('nombre', '',  array('class'=>'form-control form-sin', 'placeholder'=>'Nombre', 'autocomplete'=>'off', 'aria-label'=>'Nombre', 'required'))}}
                        </div>
                    </div>

                    <div class="col-sm-6 col-md-4">
                        <div class="form-group form-select" id="form-select">
                            {{Form::label('sexo', 'Sexo', array('aria-hidden'=>'true'))}}
                            <select class="form-control form-sin" name="sexo" id="sexo" required>
                                <option value="">Seleccione el Sexo</option>
                                @foreach($sexos as $sexo)
                                    <option value="{{$sexo->id}}">{{$sexo->sexo}}</option>
                                @endforeach 
                            </select>
                        </div>
                    </div>

                    <div class="col-sm-6 col-md-4">
                        <div class="form-group">
                            {{Form::label('telefono', 'Telefono', array('aria-hidden'=>'true'))}}
                            {{Form::text('telefono', '',  array('class'=>'form-control form-sin', 'placeholder'=>'telefono', 'autocomplete'=>'off', 'aria-label'=>'telefono'))}}
                        </div>
                    </div>

                    <div class="col-sm-6 col-md-4">
                        <div class="form-group">
                            {{Form::label('email', 'E-mail', array('aria-hidden'=>'true'))}}
                            {{Form::text('email', '',  array('class'=>'form-control form-sin', 'placeholder'=>'e-mail', 'autocomplete'=>'off', 'aria-label'=>'email'))}}
                        </div>
                    </div>

                    <div class="col-sm-6 col-md-4">
                        <div class="form-group">
                            {{Form::label('nextel', 'Nextel', array('aria-hidden'=>'true'))}}
                            {{Form::text('nextel', '',  array('class'=>'form-control form-sin', 'placeholder'=>'Nextel', 'autocomplete'=>'off', 'aria-label'=>'Nextel'))}}
                        </div>
                    </div>
                </div>

                <div class="hidden">
                    <input type="text" name="id_asegurado" id="id_asegurado" value="{{$siniestro->id_asegurado}}"/>
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

{{--seleccionar contacto--}}
<div class="modal fade seleccionarContactoR-modal" id="seleccionarContactoR-modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="H1">Seleccionar Contacto</h4>
            </div>
            <div class="modal-body">
                
                <div class="row">
                    <div class="col-sm-6 col-sm-offset-3 col-md-6 col-md-offset-3">
                        <div class="form-group">
                            {{Form::label('nombre', 'Nombre', array('aria-hidden'=>'true'))}}
                            {{Form::text('nombre', '',  array('class'=>'form-control form-sin', 'id'=>'nombreContacto', 'placeholder'=>'Nombre', 'autocomplete'=>'off', 'aria-label'=>'Nombre', 'style' => 'width: 100%', 'required'))}}
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-6">
                        <div class="form-group form-select" id="form-select">
                            {{Form::label('sexo', 'Sexo', array('aria-hidden'=>'true'))}}
                            <select class="form-control form-sin" name="sexo" id="sexo" required disabled>
                                <option value="">Seleccione el Sexo</option>
                                @foreach($sexos as $sexo)
                                    <option value="{{$sexo->id}}">{{$sexo->sexo}}</option>
                                @endforeach 
                            </select>
                        </div>
                    </div>

                    <div class="col-sm-6 col-md-6">
                        <div class="form-group">
                            {{Form::label('telefono', 'Telefono', array('aria-hidden'=>'true'))}}
                            {{Form::text('telefono', '',  array('class'=>'form-control form-sin', 'placeholder'=>'telefono', 'autocomplete'=>'off', 'aria-label'=>'telefono', 'disabled'))}}
                        </div>
                    </div>

                    <div class="col-sm-6 col-md-6">
                        <div class="form-group">
                            {{Form::label('email', 'E-mail', array('aria-hidden'=>'true'))}}
                            {{Form::text('email', '',  array('class'=>'form-control form-sin', 'placeholder'=>'e-mail', 'autocomplete'=>'off', 'aria-label'=>'email', 'disabled'))}}
                        </div>
                    </div>

                    <div class="col-sm-6 col-md-6">
                        <div class="form-group">
                            {{Form::label('nextel', 'Nextel', array('aria-hidden'=>'true'))}}
                            {{Form::text('nextel', '',  array('class'=>'form-control form-sin', 'placeholder'=>'Nextel', 'autocomplete'=>'off', 'aria-label'=>'Nextel', 'disabled'))}}
                        </div>
                    </div>
                    
                </div>
                {{ Form::open(array('url' => 'sire/reclamacion/siniestro/seleccionar/contacto/')) }}
                <div class="hidden">
                    <input type="text" name="id_asegurado" id="id_asegurado" value="{{$siniestro->id_asegurado}}"/>
                    <input type="text" name="id_contacto" id="id_contacto" value=""/>
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

{{--editar contacto--}}
<div class="modal fade editarContactoR-modal" id="editarContactoR-modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="H1">Editar Contacto</h4>
            </div>
            <div class="modal-body">
                {{ Form::open(array('url' => 'sire/reclamacion/siniestro/actualizar/contacto/')) }}
                <div class="row">
                    <div class="col-sm-6 col-md-4">
                        <div class="form-group">
                            {{Form::label('nombre', 'Nombre', array('aria-hidden'=>'true'))}}
                            {{Form::text('nombre', '',  array('class'=>'form-control form-sin', 'placeholder'=>'Nombre', 'autocomplete'=>'off', 'aria-label'=>'Nombre', 'required'))}}
                        </div>
                    </div>

                    <div class="col-sm-6 col-md-4">
                        <div class="form-group form-select" id="form-select">
                            {{Form::label('sexo', 'Sexo', array('aria-hidden'=>'true'))}}
                            <select class="form-control form-sin" name="sexo" id="sexo" required>
                                <option value="">Seleccione el Sexo</option>
                                @foreach($sexos as $sexo)
                                    <option value="{{$sexo->id}}">{{$sexo->sexo}}</option>
                                @endforeach 
                            </select>
                        </div>
                    </div>

                    <div class="col-sm-6 col-md-4">
                        <div class="form-group">
                            {{Form::label('telefono', 'Telefono', array('aria-hidden'=>'true'))}}
                            {{Form::text('telefono', '',  array('class'=>'form-control form-sin', 'placeholder'=>'telefono', 'autocomplete'=>'off', 'aria-label'=>'telefono'))}}
                        </div>
                    </div>

                    <div class="col-sm-6 col-md-4">
                        <div class="form-group">
                            {{Form::label('email', 'E-mail', array('aria-hidden'=>'true'))}}
                            {{Form::text('email', '',  array('class'=>'form-control form-sin', 'placeholder'=>'e-mail', 'autocomplete'=>'off', 'aria-label'=>'email'))}}
                        </div>
                    </div>

                    <div class="col-sm-6 col-md-4">
                        <div class="form-group">
                            {{Form::label('nextel', 'Nextel', array('aria-hidden'=>'true'))}}
                            {{Form::text('nextel', '',  array('class'=>'form-control form-sin', 'placeholder'=>'Nextel', 'autocomplete'=>'off', 'aria-label'=>'Nextel'))}}
                        </div>
                    </div>
                </div>

                <div class="hidden">
                    <input type="text" name="id_contacto" id="id_contacto" value="{{$siniestro->asegurado->id_contacto}}"/>
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

{{-------------------------------------------------------------------------------------------------------------}}

{{--nuevo acta constitutiva--}}
<div class="modal fade nuevoActaConstitutivaR-modal" id="nuevoActaConstitutivaR-modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="H1">Agregar Acta Constitutiva</h4>
            </div>
            <div class="modal-body">
                {{ Form::open(array('url' => 'sire/reclamacion/siniestro/agregar/acta_constitutiva/')) }}
                <div class="row">
                    <div class="col-sm-6 col-md-8">
                        <div class="form-group">
                            {{Form::label('escritura_publica', 'Escritura Publica', array('aria-hidden'=>'true'))}}
                            {{Form::text('escritura_publica', '',  array('class'=>'form-control form-sin', 'placeholder'=>'Escritura Publica', 'autocomplete'=>'off', 'aria-label'=>'Escritura Publica'))}}
                        </div>
                    </div>

                    <div class="col-sm-6 col-md-4">
                        <div class="form-group">
                            {{Form::label('fecha', 'Fecha')}}
                            {{Form::text('fecha', '', ['class' => 'datetimepicker1 form-control form-sin', 'placeholder' => 'Date'])}}
                        </div>
                    </div>

                    <div class="col-sm-6 col-md-6">
                        <div class="form-group">
                            {{Form::label('notario_publico', 'Notario Publico', array('aria-hidden'=>'true'))}}
                            {{Form::text('notario_publico', '',  array('class'=>'form-control form-sin', 'placeholder'=>'Notario Publico', 'autocomplete'=>'off', 'aria-label'=>'Notario Publico'))}}
                        </div>
                    </div>

                    <div class="col-sm-6 col-md-6">
                        <div class="form-group">
                            {{Form::label('administrador', 'Administrador', array('aria-hidden'=>'true'))}}
                            {{Form::text('administrador', '',  array('class'=>'form-control form-sin', 'placeholder'=>'Administrador', 'autocomplete'=>'off', 'aria-label'=>'Administrador'))}}
                        </div>
                    </div>

                    <div class="col-sm-12 col-md-12">
                        <div class="form-group">
                            {{Form::label('objeto', 'Objeto', array('aria-hidden'=>'true'))}}
                            {{Form::textarea('objeto', '',  array('class'=>'form-control form-sin', 'placeholder'=>'Objeto', 'autocomplete'=>'off', 'aria-label'=>'objeto', 'rows' => 3, 'style'=>'resize:none;'))}}
                        </div>
                    </div>
                </div>

                <div class="hidden">
                    <input type="text" name="id_asegurado" id="id_asegurado" value="{{$siniestro->id_asegurado}}"/>
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

{{--editar acta constitutiva--}}
<div class="modal fade editarActaConstitutivaR-modal" id="editarActaConstitutivaR-modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="H1">Editar Acta Constitutiva</h4>
            </div>
            <div class="modal-body">
                {{ Form::open(array('url' => 'sire/reclamacion/siniestro/actualizar/acta_constitutiva/')) }}
                <div class="row">
                    <div class="col-sm-6 col-md-8">
                        <div class="form-group">
                            {{Form::label('escritura_publica', 'Escritura Publica', array('aria-hidden'=>'true'))}}
                            {{Form::text('escritura_publica', '',  array('class'=>'form-control form-sin', 'placeholder'=>'Escritura Publica', 'autocomplete'=>'off', 'aria-label'=>'Escritura Publica'))}}
                        </div>
                    </div>

                    <div class="col-sm-6 col-md-4">
                        <div class="form-group">
                            {{Form::label('fecha', 'Fecha')}}
                            {{Form::text('fecha', '', ['class' => 'datetimepicker1 form-control form-sin', 'placeholder' => 'Date'])}}
                        </div>
                    </div>

                    <div class="col-sm-6 col-md-6">
                        <div class="form-group">
                            {{Form::label('notario_publico', 'Notario Publico', array('aria-hidden'=>'true'))}}
                            {{Form::text('notario_publico', '',  array('class'=>'form-control form-sin', 'placeholder'=>'Notario Publico', 'autocomplete'=>'off', 'aria-label'=>'Notario Publico'))}}
                        </div>
                    </div>

                    <div class="col-sm-6 col-md-6">
                        <div class="form-group">
                            {{Form::label('administrador', 'Administrador', array('aria-hidden'=>'true'))}}
                            {{Form::text('administrador', '',  array('class'=>'form-control form-sin', 'placeholder'=>'Administrador', 'autocomplete'=>'off', 'aria-label'=>'Administrador'))}}
                        </div>
                    </div>

                    <div class="col-sm-12 col-md-12">
                        <div class="form-group">
                            {{Form::label('objeto', 'Objeto', array('aria-hidden'=>'true'))}}
                            {{Form::textarea('objeto', '',  array('class'=>'form-control form-sin', 'placeholder'=>'Objeto', 'autocomplete'=>'off', 'aria-label'=>'objeto', 'rows' => 3, 'style'=>'resize:none;'))}}
                        </div>
                    </div>
                </div>

                <div class="hidden">
                    <input type="text" name="id_acta_constitutiva" id="id_acta_constitutiva" value=""/>
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

{{-------------------------------------------------------------------------------------------------------------}}

{{--agregar logo--}}
<div class="modal fade nuevoLogoR-modal" id="nuevoLogoR-modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="H1">Agregar Logo</h4>
            </div>
            <div class="modal-body">
                {{ Form::open(array('url' => 'sire/reclamacion/siniestro/agregar/logo/', 'files'=>true)) }}
                <div class="row">
                    <div class="col-sm-12 col-md-12">
                        <div class="form-group">
                            <label class="control-label">Seleccionar imagen de logo</label>
                            <input id="logo" name="logo" type="file" class="file" data-allowed-file-extensions='["png", "jpg", "jpeg"]'>
                        </div>
                    </div>
                </div>

                <div class="hidden">
                    <input type="text" name="id_siniestro" id="id_siniestro" value="{{$siniestro->id}}"/>
                </div>

                <div>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                </div>
                {{ Form::close() }}
            </div>

        </div>
    </div>
</div>

{{-------------------------------------------------------------------------------------------------------------}}

{{--agregar caracter--}}
<div class="modal fade nuevoCaracterR-modal" id="nuevoCaracterR-modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="H1">Asignar Caracter</h4>
            </div>
            {{ Form::open(array('url' => 'sire/reclamacion/siniestro/agregar/caracter/', 'files'=>true)) }}
                <div class="modal-body">
                    @foreach($caracteres_asegurado as $ca)
                        <div class="checkbox">
                            <label><input type="checkbox" name="checkcaracter[]" value="{{$ca->id}}">{{$ca->caracter}}</label>
                        </div>
                    @endforeach 
                    <div class="hidden">
                        <input type="text" name="id_asegurado" id="id_asegurado" value="{{$siniestro->asegurado->id}}"/>
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

{{--editar caracter--}}
<div class="modal fade editarCaracterR-modal" id="editarCaracterR-modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="H1">Asignar Caracter</h4>
            </div>
            {{ Form::open(array('url' => 'sire/reclamacion/siniestro/actualizar/caracter/', 'files'=>true)) }}
                <div class="modal-body">
                    @foreach($caracteres_asegurado as $ca)
                        <div class="checkbox">
                            <label><input type="checkbox" name="checkcaracter[]" value="{{$ca->id}}" <?php if($siniestro->asegurado->caracteres->contains($ca->id)){echo "checked";} ?> >{{$ca->caracter}}</label>
                        </div>
                    @endforeach 
                    <div class="hidden">
                        <input type="text" name="id_asegurado" id="id_asegurado" value="{{$siniestro->asegurado->id}}"/>
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