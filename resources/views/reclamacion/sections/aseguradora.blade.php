@if($siniestro->id_aseguradora == Null || $siniestro->id_aseguradora == "")
    <div class="alert alert-danger" role="alert">
        <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
        <span class="sr-only">Error:</span>
        No hay Aseguradora Registrada
    </div>
        {{Form::button('Agregar Aseguradora', array('class'=>'btn-nuevoAseguradoraR btn btn-success', 'data-toggle' => 'modal', 'data-target'=>'#nuevoAseguradoraR-modal', 'data-backdrop' => 'static', 'data-keyboard' => 'false', 'data-id' => $siniestro->asegurado->id))}}
        {{Form::button('Seleccionar Aseguradora de una Lista', array('class'=>'btn-seleccionarAseguradoraR btn btn-info', 'data-toggle' => 'modal', 'data-target'=>'#seleccionarAseguradoraR-modal', 'data-backdrop' => 'static', 'data-keyboard' => 'false', 'data-id' => $siniestro->asegurado->id))}}
@else
    <fieldset disabled>
        <div class="row">
            <div class="col-sm-6 col-md-4">
                <div class="form-group">
                    {{Form::label('nombre', 'Nombre', array('aria-hidden'=>'true'))}}
                    {{Form::text('nombre', $siniestro->aseguradora->nombre,  array('class'=>'form-control form-sin', 'placeholder'=>'Nombre', 'autocomplete'=>'off', 'aria-label'=>'Nombre'))}}
                </div>
            </div>

            <div class="col-sm-6 col-md-8">
                <div class="form-group">
                    {{Form::label('domicilio', 'Domicilio', array('aria-hidden'=>'true'))}}
                    {{Form::text('domicilio', $siniestro->aseguradora->domicilio,  array('class'=>'form-control form-sin', 'placeholder'=>'Calle, Numero y Colonia', 'autocomplete'=>'off', 'aria-label'=>'Domicilio'))}}
                </div>
            </div>

            <div class="col-sm-6 col-md-4">
                <div class="form-group form-select" id="form-select">
                    {{Form::label('estado', 'Estado', array('aria-hidden'=>'true'))}}
                    <select class="form-control form-sin" name="estado" id="estado" >
                        <option value="">Seleccione el Estado</option>
                        @foreach($estados as $estado)
                            <option <?php if($siniestro->aseguradora->estado == $estado->id){echo("selected");}?> value="{{$estado->id}}">{{$estado->nombre}}</option>
                        @endforeach 
                    </select>
                </div>
            </div>

            <div class="col-sm-6 col-md-4">
                <div class="form-group">
                    {{Form::label('ciudad', 'Ciudad', array('aria-hidden'=>'true'))}}
                    {{Form::text('ciudad', $siniestro->aseguradora->ciudad, array('class'=>'form-control form-sin', 'placeholder'=>'Ciudad', 'autocomplete'=>'off', 'aria-label'=>'Ciudad'))}}
                </div>
            </div>

            <div class="col-sm-6 col-md-4">
                <div class="form-group">
                    {{Form::label('codigo_postal', 'Codigo Postal', array('aria-hidden'=>'true'))}}
                    {{Form::text('codigo_postal', $siniestro->aseguradora->codigo_postal,  array('class'=>'form-control form-sin', 'placeholder'=>'Codigo Postal', 'autocomplete'=>'off', 'aria-label'=>'Codigo Postal'))}}
                </div>
            </div>

            <div class="col-sm-6 col-md-4">
                <div class="form-group">
                    {{Form::label('telefono', 'Telefono', array('aria-hidden'=>'true'))}}
                    {{Form::text('telefono', $siniestro->aseguradora->telefono,  array('class'=>'form-control form-sin', 'placeholder'=>'telefono', 'autocomplete'=>'off', 'aria-label'=>'telefono'))}}
                </div>
            </div>

            <div class="col-sm-6 col-md-4">
                <div class="form-group">
                    {{Form::label('fax', 'Fax', array('aria-hidden'=>'true'))}}
                    {{Form::text('fax', $siniestro->aseguradora->fax,  array('class'=>'form-control form-sin', 'placeholder'=>'fax', 'autocomplete'=>'off', 'aria-label'=>'fax'))}}
                </div>
            </div>

            <div class="col-sm-6 col-md-4">
                <div class="form-group">
                    {{Form::label('email', 'E-mail', array('aria-hidden'=>'true'))}}
                    {{Form::text('email', $siniestro->aseguradora->email,  array('class'=>'form-control form-sin', 'placeholder'=>'e-mail', 'autocomplete'=>'off', 'aria-label'=>'email'))}}
                </div>
            </div>

        </div>
    </fieldset>
    {{Form::button('Editar', array('class'=>'btn-editarAseguradoraR btn btn-success', 'data-toggle' => 'modal', 'data-target'=>'#editarAseguradoraR-modal', 'data-backdrop' => 'static', 'data-keyboard' => 'false', 'data-id' => $siniestro->id_aseguradora))}}
    <hr>

    <h4>Director de Siniestros</h4>
    @if($siniestro->aseguradora->director_siniestros()->first() == Null)
        <div class="alert alert-danger" role="alert">
            <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
            <span class="sr-only">Error:</span>
            No hay Director de Siniestros
        </div>
        {{Form::button('Agregar Director de Siniestros', array('class'=>'btn-nuevoDirectorSiniestrosR btn btn-success', 'data-toggle' => 'modal', 'data-target'=>'#nuevoDirectorSiniestrosR-modal', 'data-backdrop' => 'static', 'data-keyboard' => 'false', 'data-id' => $siniestro->id_aseguradora))}}
    @else
        <fieldset disabled>
        <div class="row">
            <div class="col-sm-6 col-md-4">
                <div class="form-group">
                    {{Form::label('nombre', 'Nombre', array('aria-hidden'=>'true'))}}
                    {{Form::text('nombre', $siniestro->aseguradora->director_siniestros()->first()->nombre,  array('class'=>'form-control form-sin', 'placeholder'=>'Nombre', 'autocomplete'=>'off', 'aria-label'=>'Nombre'))}}
                </div>
            </div>

            <div class="col-sm-6 col-md-4">
                <div class="form-group">
                    {{Form::label('telefono', 'Telefono', array('aria-hidden'=>'true'))}}
                    {{Form::text('telefono', $siniestro->aseguradora->director_siniestros()->first()->telefono,  array('class'=>'form-control form-sin', 'placeholder'=>'telefono', 'autocomplete'=>'off', 'aria-label'=>'telefono'))}}
                </div>
            </div>

            <div class="col-sm-6 col-md-4">
                <div class="form-group">
                    {{Form::label('email', 'E-mail', array('aria-hidden'=>'true'))}}
                    {{Form::text('email', $siniestro->aseguradora->director_siniestros()->first()->email,  array('class'=>'form-control form-sin', 'placeholder'=>'e-mail', 'autocomplete'=>'off', 'aria-label'=>'email'))}} 
                </div>
            </div>

            <div class="col-sm-6 col-md-4">
                <div class="form-group">
                    {{Form::label('nextel', 'Nextel', array('aria-hidden'=>'true'))}}
                    {{Form::text('nextel', $siniestro->aseguradora->director_siniestros()->first()->nextel,  array('class'=>'form-control form-sin', 'placeholder'=>'Nextel', 'autocomplete'=>'off', 'aria-label'=>'Nextel'))}}
                </div>
            </div>
        </div>
        </fieldset>
        {{Form::button('Editar', array('class'=>'btn-editarDirectorSiniestrosR btn btn-success', 'data-toggle' => 'modal', 'data-target'=>'#editarDirectorSiniestrosR-modal', 'data-backdrop' => 'static', 'data-keyboard' => 'false', 'data-id' => $siniestro->aseguradora->director_siniestros()->first()->id))}}
    @endif
    <hr>
                        
    <h4>Gerencia de Siniestros</h4>
    @if($siniestro->aseguradora->gerencia_siniestros()->first() == Null)
        <div class="alert alert-danger" role="alert">
            <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
            <span class="sr-only">Error:</span>
            No hay Gerente de Siniestros
        </div>
        {{Form::button('Agregar Gerencia de Siniestros', array('class'=>'btn-nuevoGerenciaSiniestrosR btn btn-success', 'data-toggle' => 'modal', 'data-target'=>'#nuevoGerenciaSiniestrosR-modal', 'data-backdrop' => 'static', 'data-keyboard' => 'false', 'data-id' =>  $siniestro->id_aseguradora))}}
    @else
        <fieldset disabled>
        <div class="row">
            <div class="col-sm-6 col-md-4">
                <div class="form-group">
                    {{Form::label('nombre', 'Nombre', array('aria-hidden'=>'true'))}}
                    {{Form::text('nombre', $siniestro->aseguradora->gerencia_siniestros()->first()->nombre,  array('class'=>'form-control form-sin', 'placeholder'=>'Nombre', 'autocomplete'=>'off', 'aria-label'=>'Nombre'))}}
                </div>
            </div>

            <div class="col-sm-6 col-md-4">
                <div class="form-group">
                    {{Form::label('telefono', 'Telefono', array('aria-hidden'=>'true'))}}
                    {{Form::text('telefono', $siniestro->aseguradora->gerencia_siniestros()->first()->telefono,  array('class'=>'form-control form-sin', 'placeholder'=>'telefono', 'autocomplete'=>'off', 'aria-label'=>'telefono'))}}
                </div>
            </div>

            <div class="col-sm-6 col-md-4">
                <div class="form-group">
                    {{Form::label('email', 'E-mail', array('aria-hidden'=>'true'))}}
                    {{Form::text('email', $siniestro->aseguradora->gerencia_siniestros()->first()->email,  array('class'=>'form-control form-sin', 'placeholder'=>'e-mail', 'autocomplete'=>'off', 'aria-label'=>'email'))}} 
                </div>
            </div>

            <div class="col-sm-6 col-md-4">
                <div class="form-group">
                    {{Form::label('nextel', 'Nextel', array('aria-hidden'=>'true'))}}
                    {{Form::text('nextel', $siniestro->aseguradora->gerencia_siniestros()->first()->nextel,  array('class'=>'form-control form-sin', 'placeholder'=>'Nextel', 'autocomplete'=>'off', 'aria-label'=>'Nextel'))}}
                </div>
            </div>
        </div>
        </fieldset>
        {{Form::button('Editar', array('class'=>'btn-editarGerenciaSiniestrosR btn btn-success', 'data-toggle' => 'modal', 'data-target'=>'#editarGerenciaSiniestrosR-modal', 'data-backdrop' => 'static', 'data-keyboard' => 'false', 'data-id' => $siniestro->aseguradora->gerencia_siniestros()->first()->id))}}
    @endif
    <hr>

    <h4>Agente de Seguros</h4>
    @if($siniestro->id_agente_seguros == Null || $siniestro->id_agente_seguros == "")
        <div class="alert alert-danger" role="alert">
            <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
            <span class="sr-only">Error:</span>
            No hay Agente de Seguros Registrado
        </div>
            {{Form::button('Agregar Agente de Seguros', array('class'=>'btn-nuevoAgenteSegurosR btn btn-success', 'data-toggle' => 'modal', 'data-target'=>'#nuevoAgenteSegurosR-modal', 'data-backdrop' => 'static', 'data-keyboard' => 'false', 'data-id' => $siniestro->id))}}
            {{Form::button('Seleccionar Agente de Seguros de una Lista', array('class'=>'btn-seleccionarAgenteSegurosR btn btn-info', 'data-toggle' => 'modal', 'data-target'=>'#seleccionarAgenteSegurosR-modal', 'data-backdrop' => 'static', 'data-keyboard' => 'false', 'data-id' => $siniestro->id))}}
    @else
    <fieldset disabled>
        <div class="row">
            <div class="col-sm-6 col-md-4">
                <div class="form-group">
                    {{Form::label('nombre', 'Nombre', array('aria-hidden'=>'true'))}}
                    {{Form::text('nombre', $siniestro->agente_seguros()->first()->agente()->first()->nombre,  array('class'=>'form-control form-sin', 'placeholder'=>'Nombre', 'autocomplete'=>'off', 'aria-label'=>'Nombre'))}}
                </div>
            </div>

            <div class="col-sm-6 col-md-8">
                <div class="form-group">
                    {{Form::label('domicilio', 'Domicilio', array('aria-hidden'=>'true'))}}
                    {{Form::text('domicilio', $siniestro->agente_seguros()->first()->agente()->first()->domicilio,  array('class'=>'form-control form-sin', 'placeholder'=>'Calle, Numero y Colonia', 'autocomplete'=>'off', 'aria-label'=>'Domicilio'))}}
                </div>
            </div>

            <div class="col-sm-6 col-md-4">
                <div class="form-group form-select" id="form-select">
                    {{Form::label('estado', 'Estado', array('aria-hidden'=>'true'))}}
                    <select class="form-control form-sin" name="estado" id="estado" >
                        <option value="">Seleccione el Estado</option>
                        @foreach($estados as $estado)
                            <option <?php if($siniestro->agente_seguros()->first()->agente()->first()->estado == $estado->id){echo("selected");}?>  value="{{$estado->id}}">{{$estado->nombre}}</option>
                        @endforeach 
                    </select>
                </div>
            </div>

            <div class="col-sm-6 col-md-4">
                <div class="form-group">
                    {{Form::label('ciudad', 'Ciudad', array('aria-hidden'=>'true'))}}
                    {{Form::text('ciudad', $siniestro->agente_seguros()->first()->agente()->first()->ciudad,  array('class'=>'form-control form-sin', 'placeholder'=>'Ciudad', 'autocomplete'=>'off', 'aria-label'=>'Ciudad'))}}
                </div>
            </div>

            <div class="col-sm-6 col-md-4">
                <div class="form-group">
                    {{Form::label('codigo_postal', 'Codigo Postal', array('aria-hidden'=>'true'))}}
                    {{Form::text('codigo_postal', $siniestro->agente_seguros()->first()->agente()->first()->codigo_postal,  array('class'=>'form-control form-sin', 'placeholder'=>'Codigo Postal', 'autocomplete'=>'off', 'aria-label'=>'Codigo Postal'))}}
                </div>
            </div>

            <div class="col-sm-6 col-md-4">
                <div class="form-group">
                    {{Form::label('telefono_oficina', 'Tel. Oficina', array('aria-hidden'=>'true'))}}
                    {{Form::text('telefono_oficina', $siniestro->agente_seguros()->first()->agente()->first()->telefono_oficina,  array('class'=>'form-control form-sin', 'placeholder'=>'telefono oficina', 'autocomplete'=>'off', 'aria-label'=>'telefono oficina'))}}
                </div>
            </div>

            <div class="col-sm-6 col-md-4">
                <div class="form-group">
                    {{Form::label('telefono_celular', 'Tel. Celular', array('aria-hidden'=>'true'))}}
                    {{Form::text('telefono_celular', $siniestro->agente_seguros()->first()->agente()->first()->telefono_celular,  array('class'=>'form-control form-sin', 'placeholder'=>'telefono celular', 'autocomplete'=>'off', 'aria-label'=>'telefono celular'))}}
                </div>
            </div>

            <div class="col-sm-6 col-md-4">
                <div class="form-group">
                    {{Form::label('email', 'E-mail', array('aria-hidden'=>'true'))}}
                    {{Form::text('email', $siniestro->agente_seguros()->first()->agente()->first()->email,  array('class'=>'form-control form-sin', 'placeholder'=>'e-mail', 'autocomplete'=>'off', 'aria-label'=>'email'))}}
                </div>
            </div>

            <div class="col-sm-6 col-md-4">
                <div class="form-group">
                    {{Form::label('nextel', 'Nextel', array('aria-hidden'=>'true'))}}
                    {{Form::text('nextel', $siniestro->agente_seguros()->first()->agente()->first()->nextel,  array('class'=>'form-control form-sin', 'placeholder'=>'Nextel', 'autocomplete'=>'off', 'aria-label'=>'Nextel'))}}
                </div>
            </div>

        </div>
    </fieldset>
    {{Form::button('Editar', array('class'=>'btn-editarAgenteSegurosR btn btn-success', 'data-toggle' => 'modal', 'data-target'=>'#editarAgenteSegurosR-modal', 'data-backdrop' => 'static', 'data-keyboard' => 'false', 'data-id' => $siniestro->agente_seguros()->first()->agente()->first()->id))}}
    @endif
    <hr>
@endif