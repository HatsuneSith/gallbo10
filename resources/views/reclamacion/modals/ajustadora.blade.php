{{--nuevo Ajustadora--}}
<div class="modal fade nuevoAjustadoraR-modal" id="nuevoAjustadoraR-modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="H1">Agregar Empresa Ajustadora</h4>
            </div>
            <div class="modal-body">
                {{ Form::open(array('url' => 'sire/reclamacion/siniestro/agregar/ajustadora/')) }}
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

{{--editar Ajustadora--}}
<div class="modal fade editarAjustadoraR-modal" id="editarAjustadoraR-modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="H1">Editar Empresa Ajustadora</h4>
            </div>
            <div class="modal-body">
                {{ Form::open(array('url' => 'sire/reclamacion/siniestro/actualizar/ajustadora/')) }}
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

                    </div>

                <div class="hidden">
                    <input type="text" name="id_ajustadora" id="id_ajustadora" value="{{$siniestro->id_ajustadora}}"/>
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

{{--nuevo director de despacho--}}
<div class="modal fade nuevoDirectorDespachoR-modal" id="nuevoDirectorDespachoR-modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="H1">Agregar Director de Despacho</h4>
            </div>
            <div class="modal-body">
                {{ Form::open(array('url' => 'sire/reclamacion/siniestro/agregar/director_despacho/')) }}
                    <div class="row">
                        <div class="col-sm-6 col-md-4">
                            <div class="form-group">
                                {{Form::label('nombre', 'Nombre', array('aria-hidden'=>'true'))}}
                                {{Form::text('nombre', '',  array('class'=>'form-control form-sin', 'placeholder'=>'Nombre', 'autocomplete'=>'off', 'aria-label'=>'Nombre', 'required'))}}
                            </div>
                        </div>

                        <div class="col-sm-6 col-md-4">
                            <div class="form-group">
                                {{Form::label('telefono_oficina', 'Telefono Oficina', array('aria-hidden'=>'true'))}}
                                {{Form::text('telefono_oficina', '',  array('class'=>'form-control form-sin', 'placeholder'=>'telefono oficina', 'autocomplete'=>'off', 'aria-label'=>'telefono celular'))}}
                            </div>
                        </div>

                        <div class="col-sm-6 col-md-4">
                            <div class="form-group">
                                {{Form::label('telefono_celular', 'Telefono Celular', array('aria-hidden'=>'true'))}}
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
                    <input type="text" name="id_ajustadora" id="id_ajustadora" value="{{$siniestro->id_ajustadora}}"/>
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

{{--editar director de despacho--}}
<div class="modal fade editarDirectorDespachoR-modal" id="editarDirectorDespachoR-modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="H1">Editar Director del Despacho</h4>
            </div>
            <div class="modal-body">
                {{ Form::open(array('url' => 'sire/reclamacion/siniestro/actualizar/director_despacho/')) }}
                    <div class="row">
                        <div class="col-sm-6 col-md-4">
                            <div class="form-group">
                                {{Form::label('nombre', 'Nombre', array('aria-hidden'=>'true'))}}
                                {{Form::text('nombre', '',  array('class'=>'form-control form-sin', 'placeholder'=>'Nombre', 'autocomplete'=>'off', 'aria-label'=>'Nombre', 'required'))}}
                            </div>
                        </div>

                        <div class="col-sm-6 col-md-4">
                            <div class="form-group">
                                {{Form::label('telefono_oficina', 'Telefono Oficina', array('aria-hidden'=>'true'))}}
                                {{Form::text('telefono_oficina', '',  array('class'=>'form-control form-sin', 'placeholder'=>'telefono oficina', 'autocomplete'=>'off', 'aria-label'=>'telefono celular'))}}
                            </div>
                        </div>

                        <div class="col-sm-6 col-md-4">
                            <div class="form-group">
                                {{Form::label('telefono_celular', 'Telefono Celular', array('aria-hidden'=>'true'))}}
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
                    <input type="text" name="id_ajustadora" id="id_ajustadora" value="{{$siniestro->id_ajustadora}}"/>
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



{{--nuevo austador--}}
<div class="modal fade nuevoAjustadorDesignadoR-modal" id="nuevoAjustadorDesignadoR-modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="H1">Agregar Ajustador Designado</h4>
            </div>
            <div class="modal-body">
                {{ Form::open(array('url' => 'sire/reclamacion/siniestro/agregar/ajustador/')) }}
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
                    <input type="text" name="id_ajustadora" id="id_ajustadora" value="{{$siniestro->id_ajustadora}}"/>
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

{{--editar ajustador designado--}}
<div class="modal fade editarAjustadorDesignadoR-modal" id="editarAjustadorDesignadoR-modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="H1">Editar Ajustador Designado</h4>
            </div>
            <div class="modal-body">
                {{ Form::open(array('url' => 'sire/reclamacion/siniestro/actualizar/ajustador/')) }}
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

{{--seleccionar ajustador--}}
<div class="modal fade seleccionarAjustadorDesignadoR-modal" id="seleccionarAjustadorDesignadoR-modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="H1">Seleccionar Ajustador Designados</h4>
            </div>
            <div class="modal-body">
                
                <div class="row">
                    <div class="col-sm-6 col-sm-offset-3 col-md-6 col-md-offset-3">
                        <div class="form-group">
                            {{Form::label('nombre', 'Nombre', array('aria-hidden'=>'true'))}}
                            {{Form::text('nombre', '',  array('class'=>'form-control form-sin', 'id'=>'nombreAjustador', 'placeholder'=>'Nombre', 'autocomplete'=>'off', 'aria-label'=>'Nombre', 'style' => 'width: 100%', 'required'))}}
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
                {{ Form::open(array('url' => 'sire/reclamacion/siniestro/seleccionar/ajustador/')) }}
                <div class="hidden">
                    <input type="text" name="id_ajustadora" id="id_ajustadora" value="{{$siniestro->id_ajustadora}}"/>
                    <input type="text" name="id_siniestro" id="id_siniestro" value="{{$siniestro->id}}"/>
                    <input type="text" name="id_ajustador" id="id_ajustador" value=""/>
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

{{--seleccionar ajustadora--}}
<div class="modal fade seleccionarAjustadoraR-modal" id="seleccionarAjustadoraR-modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="H1">Seleccionar Ajustadora</h4>
            </div>
            <div class="modal-body">
                
                <div class="row">
                    <div class="col-sm-6 col-sm-offset-3 col-md-6 col-md-offset-3">
                        <div class="form-group">
                            {{Form::label('nombre', 'Nombre', array('aria-hidden'=>'true'))}}
                            {{Form::text('nombre', '',  array('class'=>'form-control form-sin', 'id'=>'nombreAjustadora', 'placeholder'=>'Nombre', 'autocomplete'=>'off', 'aria-label'=>'Nombre', 'style' => 'width: 100%', 'required'))}}
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
                    
                </div>
                {{ Form::open(array('url' => 'sire/reclamacion/siniestro/seleccionar/ajustadora/')) }}
                <div class="hidden">
                    <input type="text" name="id_siniestro" id="id_siniestro" value="{{$siniestro->id}}"/>
                    <input type="text" name="id_ajustadora" id="id_ajustadora" value=""/>
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