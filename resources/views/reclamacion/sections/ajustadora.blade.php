@if($siniestro->id_ajustadora == Null || $siniestro->id_ajustadora == "")
    <div class="alert alert-danger" role="alert">
        <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
        <span class="sr-only">Error:</span>
        No hay Ajustadora Registrada
    </div>
        {{Form::button('Agregar Ajustadora', array('class'=>'btn-nuevoAjustadoraR btn btn-success', 'data-toggle' => 'modal', 'data-target'=>'#nuevoAjustadoraR-modal', 'data-backdrop' => 'static', 'data-keyboard' => 'false'))}}
        {{Form::button('Seleccionar Ajustadora de una Lista', array('class'=>'btn-seleccionarAjustadoraR btn btn-info', 'data-toggle' => 'modal', 'data-target'=>'#seleccionarAjustadoraR-modal', 'data-backdrop' => 'static', 'data-keyboard' => 'false'))}}
@else
    <fieldset disabled>
        <div class="row">
            <div class="col-sm-6 col-md-4">
                <div class="form-group">
                    {{Form::label('nombre', 'Nombre', array('aria-hidden'=>'true'))}}
                    {{Form::text('nombre', $siniestro->ajustadora->nombre,  array('class'=>'form-control form-sin', 'placeholder'=>'Nombre', 'autocomplete'=>'off', 'aria-label'=>'Nombre'))}}
                </div>
            </div>

            <div class="col-sm-6 col-md-8">
                <div class="form-group">
                    {{Form::label('domicilio', 'Domicilio', array('aria-hidden'=>'true'))}}
                    {{Form::text('domicilio', $siniestro->ajustadora->domicilio,  array('class'=>'form-control form-sin', 'placeholder'=>'Calle, Numero y Colonia', 'autocomplete'=>'off', 'aria-label'=>'Domicilio'))}}
                </div>
            </div>

            <div class="col-sm-6 col-md-4">
                <div class="form-group form-select" id="form-select">
                    {{Form::label('estado', 'Estado', array('aria-hidden'=>'true'))}}
                    <select class="form-control form-sin" name="estado" id="estado" >
                        <option value="">Seleccione el Estado</option>
                        @foreach($estados as $estado)
                            <option <?php if($siniestro->ajustadora->estado == $estado->id){echo("selected");}?> value="{{$estado->id}}">{{$estado->nombre}}</option>
                        @endforeach 
                    </select>
                </div>
            </div>

            <div class="col-sm-6 col-md-4">
                <div class="form-group">
                    {{Form::label('ciudad', 'Ciudad', array('aria-hidden'=>'true'))}}
                    {{Form::text('ciudad', $siniestro->ajustadora->ciudad, array('class'=>'form-control form-sin', 'placeholder'=>'Ciudad', 'autocomplete'=>'off', 'aria-label'=>'Ciudad'))}}
                </div>
            </div>

            <div class="col-sm-6 col-md-4">
                <div class="form-group">
                    {{Form::label('codigo_postal', 'Codigo Postal', array('aria-hidden'=>'true'))}}
                    {{Form::text('codigo_postal', $siniestro->ajustadora->codigo_postal,  array('class'=>'form-control form-sin', 'placeholder'=>'Codigo Postal', 'autocomplete'=>'off', 'aria-label'=>'Codigo Postal'))}}
                </div>
            </div>

        </div>
    </fieldset>
    {{Form::button('Editar', array('class'=>'btn-editarAjustadoraR btn btn-success', 'data-toggle' => 'modal', 'data-target'=>'#editarAjustadoraR-modal', 'data-backdrop' => 'static', 'data-keyboard' => 'false', 'data-id' => $siniestro->id_ajustadora))}}
    <hr>

    <h4>Director del Despacho</h4>
    @if($siniestro->ajustadora->director_despacho()->first() == Null)
        <div class="alert alert-danger" role="alert">
            <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
            <span class="sr-only">Error:</span>
            No hay Director del despacho
        </div>
        {{Form::button('Agregar Director del Despacho', array('class'=>'btn-nuevoDirectorDespachoR btn btn-success', 'data-toggle' => 'modal', 'data-target'=>'#nuevoDirectorDespachoR-modal', 'data-backdrop' => 'static', 'data-keyboard' => 'false', 'data-id' => $siniestro->id_ajustadora))}}
    @else
        <fieldset disabled>
        <div class="row">
            <div class="col-sm-6 col-md-4">
                <div class="form-group">
                    {{Form::label('nombre', 'Nombre', array('aria-hidden'=>'true'))}}
                    {{Form::text('nombre', $siniestro->ajustadora->director_despacho()->first()->nombre,  array('class'=>'form-control form-sin', 'placeholder'=>'Nombre', 'autocomplete'=>'off', 'aria-label'=>'Nombre'))}}
                </div>
            </div>

            <div class="col-sm-6 col-md-4">
                <div class="form-group">
                    {{Form::label('telefono_oficina', 'Telefono Oficina', array('aria-hidden'=>'true'))}}
                    {{Form::text('telefono_oficina', $siniestro->ajustadora->director_despacho()->first()->telefono_oficina,  array('class'=>'form-control form-sin', 'placeholder'=>'telefono oficina', 'autocomplete'=>'off', 'aria-label'=>'telefono oficina'))}}
                </div>
            </div>

            <div class="col-sm-6 col-md-4">
                <div class="form-group">
                    {{Form::label('telefono_celular', 'Telefono Celular', array('aria-hidden'=>'true'))}}
                    {{Form::text('telefono_celular', $siniestro->ajustadora->director_despacho()->first()->telefono_celular,  array('class'=>'form-control form-sin', 'placeholder'=>'telefono celular', 'autocomplete'=>'off', 'aria-label'=>'telefono celular'))}}
                </div>
            </div>

            <div class="col-sm-6 col-md-4">
                <div class="form-group">
                    {{Form::label('email', 'E-mail', array('aria-hidden'=>'true'))}}
                    {{Form::text('email', $siniestro->ajustadora->director_despacho()->first()->email,  array('class'=>'form-control form-sin', 'placeholder'=>'e-mail', 'autocomplete'=>'off', 'aria-label'=>'email'))}} 
                </div>
            </div>

            <div class="col-sm-6 col-md-4">
                <div class="form-group">
                    {{Form::label('nextel', 'Nextel', array('aria-hidden'=>'true'))}}
                    {{Form::text('nextel', $siniestro->ajustadora->director_despacho()->first()->nextel,  array('class'=>'form-control form-sin', 'placeholder'=>'Nextel', 'autocomplete'=>'off', 'aria-label'=>'Nextel'))}}
                </div>
            </div>
        </div>
        </fieldset>
        {{Form::button('Editar', array('class'=>'btn-editarDirectorDespachoR btn btn-success', 'data-toggle' => 'modal', 'data-target'=>'#editarDirectorDespachoR-modal', 'data-backdrop' => 'static', 'data-keyboard' => 'false', 'data-id' => $siniestro->ajustadora->director_despacho()->first()->id))}}
    @endif
    <hr>

    <h4>Ajustador Designado</h4>
    @if($siniestro->id_ajustador_designado == Null || $siniestro->id_ajustador_designado == "")
        <div class="alert alert-danger" role="alert">
            <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
            <span class="sr-only">Error:</span>
            No hay Ajustador Designado Registrado
        </div>
            {{Form::button('Agregar Ajustador Designado', array('class'=>'btn-nuevoAjustadorDesignadoR btn btn-success', 'data-toggle' => 'modal', 'data-target'=>'#nuevoAjustadorDesignadoR-modal', 'data-backdrop' => 'static', 'data-keyboard' => 'false', 'data-id' => $siniestro->id))}}
            {{Form::button('Seleccionar Ajustador Designado de una Lista', array('class'=>'btn-seleccionarAjustadorDesignadoR btn btn-info', 'data-toggle' => 'modal', 'data-target'=>'#seleccionarAjustadorDesignadoR-modal', 'data-backdrop' => 'static', 'data-keyboard' => 'false', 'data-id' => $siniestro->id))}}
    @else
    <fieldset disabled>
        <div class="row">
            <div class="col-sm-6 col-md-4">
                <div class="form-group">
                    {{Form::label('nombre', 'Nombre', array('aria-hidden'=>'true'))}}
                    {{Form::text('nombre', $siniestro->ajustador_designado()->first()->ajustador()->first()->nombre,  array('class'=>'form-control form-sin', 'placeholder'=>'Nombre', 'autocomplete'=>'off', 'aria-label'=>'Nombre'))}}
                </div>
            </div>

            <div class="col-sm-6 col-md-8">
                <div class="form-group">
                    {{Form::label('domicilio', 'Domicilio', array('aria-hidden'=>'true'))}}
                    {{Form::text('domicilio', $siniestro->ajustador_designado()->first()->ajustador()->first()->domicilio,  array('class'=>'form-control form-sin', 'placeholder'=>'Calle, Numero y Colonia', 'autocomplete'=>'off', 'aria-label'=>'Domicilio'))}}
                </div>
            </div>

            <div class="col-sm-6 col-md-4">
                <div class="form-group form-select" id="form-select">
                    {{Form::label('estado', 'Estado', array('aria-hidden'=>'true'))}}
                    <select class="form-control form-sin" name="estado" id="estado" >
                        <option value="">Seleccione el Estado</option>
                        @foreach($estados as $estado)
                            <option <?php if($siniestro->ajustador_designado()->first()->ajustador()->first()->estado == $estado->id){echo("selected");}?>  value="{{$estado->id}}">{{$estado->nombre}}</option>
                        @endforeach 
                    </select>
                </div>
            </div>

            <div class="col-sm-6 col-md-4">
                <div class="form-group">
                    {{Form::label('ciudad', 'Ciudad', array('aria-hidden'=>'true'))}}
                    {{Form::text('ciudad', $siniestro->ajustador_designado()->first()->ajustador()->first()->ciudad,  array('class'=>'form-control form-sin', 'placeholder'=>'Ciudad', 'autocomplete'=>'off', 'aria-label'=>'Ciudad'))}}
                </div>
            </div>

            <div class="col-sm-6 col-md-4">
                <div class="form-group">
                    {{Form::label('codigo_postal', 'Codigo Postal', array('aria-hidden'=>'true'))}}
                    {{Form::text('codigo_postal', $siniestro->ajustador_designado()->first()->ajustador()->first()->codigo_postal,  array('class'=>'form-control form-sin', 'placeholder'=>'Codigo Postal', 'autocomplete'=>'off', 'aria-label'=>'Codigo Postal'))}}
                </div>
            </div>

            <div class="col-sm-6 col-md-4">
                <div class="form-group">
                    {{Form::label('telefono_oficina', 'Tel. Oficina', array('aria-hidden'=>'true'))}}
                    {{Form::text('telefono_oficina', $siniestro->ajustador_designado()->first()->ajustador()->first()->telefono_oficina,  array('class'=>'form-control form-sin', 'placeholder'=>'telefono oficina', 'autocomplete'=>'off', 'aria-label'=>'telefono oficina'))}}
                </div>
            </div>

            <div class="col-sm-6 col-md-4">
                <div class="form-group">
                    {{Form::label('telefono_celular', 'Tel. Celular', array('aria-hidden'=>'true'))}}
                    {{Form::text('telefono_celular', $siniestro->ajustador_designado()->first()->ajustador()->first()->telefono_celular,  array('class'=>'form-control form-sin', 'placeholder'=>'telefono celular', 'autocomplete'=>'off', 'aria-label'=>'telefono celular'))}}
                </div>
            </div>

            <div class="col-sm-6 col-md-4">
                <div class="form-group">
                    {{Form::label('email', 'E-mail', array('aria-hidden'=>'true'))}}
                    {{Form::text('email', $siniestro->ajustador_designado()->first()->ajustador()->first()->email,  array('class'=>'form-control form-sin', 'placeholder'=>'e-mail', 'autocomplete'=>'off', 'aria-label'=>'email'))}}
                </div>
            </div>

            <div class="col-sm-6 col-md-4">
                <div class="form-group">
                    {{Form::label('nextel', 'Nextel', array('aria-hidden'=>'true'))}}
                    {{Form::text('nextel', $siniestro->ajustador_designado()->first()->ajustador()->first()->nextel,  array('class'=>'form-control form-sin', 'placeholder'=>'Nextel', 'autocomplete'=>'off', 'aria-label'=>'Nextel'))}}
                </div>
            </div>

        </div>
    </fieldset>
    {{Form::button('Editar', array('class'=>'btn-editarAjustadorDesignadoR btn btn-success', 'data-toggle' => 'modal', 'data-target'=>'#editarAjustadorDesignadoR-modal', 'data-backdrop' => 'static', 'data-keyboard' => 'false', 'data-id' => $siniestro->ajustador_designado()->first()->ajustador()->first()->id))}}
    @endif
    <hr>
@endif