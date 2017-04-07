{{--nuevo Aseguradora--}}
<div class="modal fade nuevoAseguradoraR-modal" id="nuevoAseguradoraR-modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="H1">Agregar Aseguradora</h4>
            </div>
            <div class="modal-body">
                {{ Form::open(array('url' => 'sire/reclamacion/siniestro/agregar/aseguradora/')) }}
                    <div class="row">
                        
                        <div class="col-sm-6 col-md-4">
                            <div class="form-group">
                                {{Form::label('nombre', 'Nombre', array('aria-hidden'=>'true'))}}
                                {{Form::text('nombre', '',  array('class'=>'form-control form-sin', 'placeholder'=>'Nombre', 'autocomplete'=>'off', 'aria-label'=>'Nombre', 'required'))}}
                            </div>
                        </div>

                        <div class="col-sm-6 col-md-8">
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

{{--editar Aseguradora--}}
<div class="modal fade editarAseguradoraR-modal" id="editarAseguradoraR-modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="H1">Editar Aseguradora</h4>
            </div>
            <div class="modal-body">
                {{ Form::open(array('url' => 'sire/reclamacion/siniestro/actualizar/aseguradora/')) }}
                    <div class="row">
                        
                        <div class="col-sm-6 col-md-4">
                            <div class="form-group">
                                {{Form::label('nombre', 'Nombre', array('aria-hidden'=>'true'))}}
                                {{Form::text('nombre', '',  array('class'=>'form-control form-sin', 'placeholder'=>'Nombre', 'autocomplete'=>'off', 'aria-label'=>'Nombre', 'required'))}}
                            </div>
                        </div>

                        <div class="col-sm-6 col-md-8">
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
                    </div>

                <div class="hidden">
                    <input type="text" name="id_aseguradora" id="id_aseguradora" value="{{$siniestro->id_aseguradora}}"/>
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

{{--nuevo director de siniestros--}}
<div class="modal fade nuevoDirectorSiniestrosR-modal" id="nuevoDirectorSiniestrosR-modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="H1">Agregar Director de Siniestros</h4>
            </div>
            <div class="modal-body">
                {{ Form::open(array('url' => 'sire/reclamacion/siniestro/agregar/director_siniestros/')) }}
                    <div class="row">
                        <div class="col-sm-6 col-md-4">
                            <div class="form-group">
                                {{Form::label('nombre', 'Nombre', array('aria-hidden'=>'true'))}}
                                {{Form::text('nombre', '',  array('class'=>'form-control form-sin', 'placeholder'=>'Nombre', 'autocomplete'=>'off', 'aria-label'=>'Nombre'))}}
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
                    <input type="text" name="id_aseguradora" id="id_aseguradora" value="{{$siniestro->id_aseguradora}}"/>
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

{{--editar director de siniestros--}}
<div class="modal fade editarDirectorSiniestrosR-modal" id="editarDirectorSiniestrosR-modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="H1">Editar Director de Siniestros</h4>
            </div>
            <div class="modal-body">
                {{ Form::open(array('url' => 'sire/reclamacion/siniestro/actualizar/director_siniestros/')) }}
                    <div class="row">
                        <div class="col-sm-6 col-md-4">
                            <div class="form-group">
                                {{Form::label('nombre', 'Nombre', array('aria-hidden'=>'true'))}}
                                {{Form::text('nombre', '',  array('class'=>'form-control form-sin', 'placeholder'=>'Nombre', 'autocomplete'=>'off', 'aria-label'=>'Nombre'))}}
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
                    <input type="text" name="id_aseguradora" id="id_aseguradora" value="{{$siniestro->id_aseguradora}}"/>
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

{{--nuevo gerencia de siniestros--}}
<div class="modal fade nuevoGerenciaSiniestrosR-modal" id="nuevoGerenciaSiniestrosR-modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="H1">Agregar Gerencia de Siniestros</h4>
            </div>
            <div class="modal-body">
                {{ Form::open(array('url' => 'sire/reclamacion/siniestro/agregar/gerencia_siniestros/')) }}
                    <div class="row">
                        <div class="col-sm-6 col-md-4">
                            <div class="form-group">
                                {{Form::label('nombre', 'Nombre', array('aria-hidden'=>'true'))}}
                                {{Form::text('nombre', '',  array('class'=>'form-control form-sin', 'placeholder'=>'Nombre', 'autocomplete'=>'off', 'aria-label'=>'Nombre'))}}
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
                    <input type="text" name="id_aseguradora" id="id_aseguradora" value="{{$siniestro->id_aseguradora}}"/>
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

{{--editar gerencia de siniestros--}}
<div class="modal fade editarGerenciaSiniestrosR-modal" id="editarGerenciaSiniestrosR-modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="H1">Editar Gerencia de Siniestros</h4>
            </div>
            <div class="modal-body">
                {{ Form::open(array('url' => 'sire/reclamacion/siniestro/actualizar/gerencia_siniestros/')) }}
                    <div class="row">
                        <div class="col-sm-6 col-md-4">
                            <div class="form-group">
                                {{Form::label('nombre', 'Nombre', array('aria-hidden'=>'true'))}}
                                {{Form::text('nombre', '',  array('class'=>'form-control form-sin', 'placeholder'=>'Nombre', 'autocomplete'=>'off', 'aria-label'=>'Nombre'))}}
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
                    <input type="text" name="id_aseguradora" id="id_aseguradora" value="{{$siniestro->id_aseguradora}}"/>
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

{{--nuevo agente de seguros--}}
<div class="modal fade nuevoAgenteSegurosR-modal" id="nuevoAgenteSegurosR-modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="H1">Agregar Agente de Seguros</h4>
            </div>
            <div class="modal-body">
                {{ Form::open(array('url' => 'sire/reclamacion/siniestro/agregar/agente_seguros/')) }}
                    <div class="row">
                        <div class="col-sm-6 col-md-4">
                            <div class="form-group">
                                {{Form::label('nombre', 'Nombre', array('aria-hidden'=>'true'))}}
                                {{Form::text('nombre', '',  array('class'=>'form-control form-sin', 'placeholder'=>'Nombre', 'autocomplete'=>'off', 'aria-label'=>'Nombre', 'required'))}}
                            </div>
                        </div>

                        <div class="col-sm-6 col-md-8">
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
                                {{Form::label('telefono_oficina', 'Tel. Oficina', array('aria-hidden'=>'true'))}}
                                {{Form::text('telefono_oficina', '',  array('class'=>'form-control form-sin', 'placeholder'=>'telefono oficina', 'autocomplete'=>'off', 'aria-label'=>'telefono oficina'))}}
                            </div>
                        </div>

                        <div class="col-sm-6 col-md-4">
                            <div class="form-group">
                                {{Form::label('telefono_celular', 'Tel. Celular', array('aria-hidden'=>'true'))}}
                                {{Form::text('telefono_celular', '',  array('class'=>'form-control form-sin', 'placeholder'=>'telefono celular', 'autocomplete'=>'off', 'aria-label'=>'telefono celular'))}}
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
                    <input type="text" name="id_aseguradora" id="id_aseguradora" value="{{$siniestro->id_aseguradora}}"/>
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

{{--editar agente de seguros--}}
<div class="modal fade editarAgenteSegurosR-modal" id="editarAgenteSegurosR-modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="H1">Agregar Agente de Seguros</h4>
            </div>
            <div class="modal-body">
                {{ Form::open(array('url' => 'sire/reclamacion/siniestro/actualizar/agente_seguros/')) }}
                    <div class="row">
                        <div class="col-sm-6 col-md-4">
                            <div class="form-group">
                                {{Form::label('nombre', 'Nombre', array('aria-hidden'=>'true'))}}
                                {{Form::text('nombre', '',  array('class'=>'form-control form-sin', 'placeholder'=>'Nombre', 'autocomplete'=>'off', 'aria-label'=>'Nombre', 'required'))}}
                            </div>
                        </div>

                        <div class="col-sm-6 col-md-8">
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
                                {{Form::label('telefono_oficina', 'Tel. Oficina', array('aria-hidden'=>'true'))}}
                                {{Form::text('telefono_oficina', '',  array('class'=>'form-control form-sin', 'placeholder'=>'telefono oficina', 'autocomplete'=>'off', 'aria-label'=>'telefono oficina'))}}
                            </div>
                        </div>

                        <div class="col-sm-6 col-md-4">
                            <div class="form-group">
                                {{Form::label('telefono_celular', 'Tel. Celular', array('aria-hidden'=>'true'))}}
                                {{Form::text('telefono_celular', '',  array('class'=>'form-control form-sin', 'placeholder'=>'telefono celular', 'autocomplete'=>'off', 'aria-label'=>'telefono celular'))}}
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
                    <input type="text" name="id" id="id" value=""/>
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

{{--seleccionar aente de seguros--}}
<div class="modal fade seleccionarAgenteSegurosR-modal" id="seleccionarAgenteSegurosR-modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="H1">Seleccionar Agente de Seguros</h4>
            </div>
            <div class="modal-body">
                
                <div class="row">
                    <div class="col-sm-6 col-sm-offset-3 col-md-6 col-md-offset-3">
                        <div class="form-group">
                            {{Form::label('nombre', 'Nombre', array('aria-hidden'=>'true'))}}
                            {{Form::text('nombre', '',  array('class'=>'form-control form-sin', 'id'=>'nombreAgenteSeguros', 'placeholder'=>'Nombre', 'autocomplete'=>'off', 'aria-label'=>'Nombre', 'style' => 'width: 100%', 'required'))}}
                        </div>
                    </div>

                    <div class="col-sm-6 col-md-8">
                        <div class="form-group">
                            {{Form::label('domicilio', 'Domicilio', array('aria-hidden'=>'true'))}}
                            {{Form::text('domicilio', '',  array('class'=>'form-control form-sin', 'placeholder'=>'Calle, Numero y Colonia', 'autocomplete'=>'off', 'aria-label'=>'Domicilio', 'disabled'))}}
                        </div>
                    </div>

                    <div class="col-sm-6 col-md-4">
                        <div class="form-group form-select" id="form-select">
                            {{Form::label('estado', 'Estado', array('aria-hidden'=>'true'))}}
                            <select class="form-control form-sin" name="estado" id="estado" disabled>
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
                            {{Form::text('ciudad', '',  array('class'=>'form-control form-sin', 'placeholder'=>'Ciudad', 'autocomplete'=>'off', 'aria-label'=>'Ciudad', 'disabled'))}}
                        </div>
                    </div>

                    <div class="col-sm-6 col-md-4">
                        <div class="form-group">
                            {{Form::label('codigo_postal', 'Codigo Postal', array('aria-hidden'=>'true'))}}
                            {{Form::text('codigo_postal', '',  array('class'=>'form-control form-sin', 'placeholder'=>'Codigo Postal', 'autocomplete'=>'off', 'aria-label'=>'Codigo Postal', 'disabled'))}}
                        </div>
                    </div>

                    <div class="col-sm-6 col-md-4">
                        <div class="form-group">
                            {{Form::label('telefono_oficina', 'Tel. Oficina', array('aria-hidden'=>'true'))}}
                            {{Form::text('telefono_oficina', '',  array('class'=>'form-control form-sin', 'placeholder'=>'telefono oficina', 'autocomplete'=>'off', 'aria-label'=>'telefono oficina', 'disabled'))}}
                        </div>
                    </div>

                    <div class="col-sm-6 col-md-4">
                        <div class="form-group">
                            {{Form::label('telefono_celular', 'Tel. Celular', array('aria-hidden'=>'true'))}}
                            {{Form::text('telefono_celular', '',  array('class'=>'form-control form-sin', 'placeholder'=>'telefono celular', 'autocomplete'=>'off', 'aria-label'=>'telefono celular', 'disabled'))}}
                        </div>
                    </div>

                    <div class="col-sm-6 col-md-4">
                        <div class="form-group">
                            {{Form::label('email', 'E-mail', array('aria-hidden'=>'true'))}}
                            {{Form::text('email', '',  array('class'=>'form-control form-sin', 'placeholder'=>'e-mail', 'autocomplete'=>'off', 'aria-label'=>'email', 'disabled'))}}
                        </div>
                    </div>

                    <div class="col-sm-6 col-md-4">
                        <div class="form-group">
                            {{Form::label('nextel', 'Nextel', array('aria-hidden'=>'true'))}}
                            {{Form::text('nextel', '',  array('class'=>'form-control form-sin', 'placeholder'=>'Nextel', 'autocomplete'=>'off', 'aria-label'=>'Nextel', 'disabled'))}}
                        </div>
                    </div>
                    
                </div>
                {{ Form::open(array('url' => 'sire/reclamacion/siniestro/seleccionar/agente_seguros/')) }}
                <div class="hidden">
                    <input type="text" name="id_aseguradora" id="id_aseguradora" value="{{$siniestro->id_aseguradora}}"/>
                    <input type="text" name="id_siniestro" id="id_siniestro" value="{{$siniestro->id}}"/>
                    <input type="text" name="id_agente_seguros" id="id_agente_seguros" value=""/>
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

{{--seleccionar aseguradora--}}
<div class="modal fade seleccionarAseguradoraR-modal" id="seleccionarAseguradoraR-modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="H1">Seleccionar Aseguradora</h4>
            </div>
            <div class="modal-body">
                
                <div class="row">
                    <div class="col-sm-6 col-sm-offset-3 col-md-6 col-md-offset-3">
                        <div class="form-group">
                            {{Form::label('nombre', 'Nombre', array('aria-hidden'=>'true'))}}
                            {{Form::text('nombre', '',  array('class'=>'form-control form-sin', 'id'=>'nombreAseguradora', 'placeholder'=>'Nombre', 'autocomplete'=>'off', 'aria-label'=>'Nombre', 'style' => 'width: 100%', 'required'))}}
                        </div>
                    </div>

                    <div class="col-sm-6 col-md-8">
                        <div class="form-group">
                            {{Form::label('domicilio', 'Domicilio', array('aria-hidden'=>'true'))}}
                            {{Form::text('domicilio', '',  array('class'=>'form-control form-sin', 'placeholder'=>'Calle, Numero y Colonia', 'autocomplete'=>'off', 'aria-label'=>'Domicilio', 'disabled'))}}
                        </div>
                    </div>

                    <div class="col-sm-6 col-md-4">
                        <div class="form-group form-select" id="form-select">
                            {{Form::label('estado', 'Estado', array('aria-hidden'=>'true'))}}
                            <select class="form-control form-sin" name="estado" id="estado" disabled>
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
                            {{Form::text('ciudad', '',  array('class'=>'form-control form-sin', 'placeholder'=>'Ciudad', 'autocomplete'=>'off', 'aria-label'=>'Ciudad', 'disabled'))}}
                        </div>
                    </div>

                    <div class="col-sm-6 col-md-4">
                        <div class="form-group">
                            {{Form::label('codigo_postal', 'Codigo Postal', array('aria-hidden'=>'true'))}}
                            {{Form::text('codigo_postal', '',  array('class'=>'form-control form-sin', 'placeholder'=>'Codigo Postal', 'autocomplete'=>'off', 'aria-label'=>'Codigo Postal', 'disabled'))}}
                        </div>
                    </div>

                    <div class="col-sm-6 col-md-4">
                        <div class="form-group">
                            {{Form::label('telefono', 'Telefono', array('aria-hidden'=>'true'))}}
                            {{Form::text('telefono', '',  array('class'=>'form-control form-sin', 'placeholder'=>'telefono', 'autocomplete'=>'off', 'aria-label'=>'telefono', 'disabled'))}}
                        </div>
                    </div>

                    <div class="col-sm-6 col-md-4">
                        <div class="form-group">
                            {{Form::label('fax', 'Fax', array('aria-hidden'=>'true'))}}
                            {{Form::text('fax', '',  array('class'=>'form-control form-sin', 'placeholder'=>'fax', 'autocomplete'=>'off', 'aria-label'=>'fax', 'disabled'))}}
                        </div>
                    </div>

                    <div class="col-sm-6 col-md-4">
                        <div class="form-group">
                            {{Form::label('email', 'E-mail', array('aria-hidden'=>'true'))}}
                            {{Form::text('email', '',  array('class'=>'form-control form-sin', 'placeholder'=>'e-mail', 'autocomplete'=>'off', 'aria-label'=>'email', 'disabled'))}}
                        </div>
                    </div>
                    
                </div>
                {{ Form::open(array('url' => 'sire/reclamacion/siniestro/seleccionar/aseguradora/')) }}
                <div class="hidden">
                    <input type="text" name="id_siniestro" id="id_siniestro" value="{{$siniestro->id}}"/>
                    <input type="text" name="id_aseguradora" id="id_aseguradora" value=""/>
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