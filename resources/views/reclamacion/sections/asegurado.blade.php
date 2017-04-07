<fieldset disabled>
<div class="row">
    
    <div class="col-sm-6 col-md-4">
        <div class="form-group">
            {{Form::label('nombre', 'Nombre o Razon Social', array('aria-hidden'=>'true'))}}
            {{Form::text('nombre', $siniestro->asegurado->nombre,  array('class'=>'form-control form-sin', 'placeholder'=>'Nombre o Razon Social', 'autocomplete'=>'off', 'aria-label'=>'Nombre o Razon Social'))}}
        </div>
    </div>

    <div class="col-sm-6 col-md-4">
        <div class="form-group form-select" id="form-select">
            {{Form::label('tipo_persona', 'Tipo de Persona', array('aria-hidden'=>'true'))}}
            <select class="form-control form-sin" name="tipo_persona" id="tipo_persona" >
                <option value="">Seleccione el Tipo de Persona </option>
                @foreach($tipos_personas as $tipo)
                    <option <?php if($siniestro->asegurado->tipo_persona == $tipo->id){echo("selected");}?> value="{{$tipo->id}}"> {{$tipo->tipo}}</option>
                @endforeach    
            </select>
        </div>
    </div>

    <div class="col-sm-6 col-md-4">
        <div class="form-group form-select" id="form-select">
            {{Form::label('giro', 'Giro', array('aria-hidden'=>'true'))}}
            <select class="form-control form-sin" name="giro" id="giro" >
                <option value="">Seleccione el Giro </option>
                @foreach($giros_empresas as $giro)
                    <option <?php if($siniestro->asegurado->giro == $giro->id){echo("selected");}?> value="{{$giro->id}}"> {{$giro->giro}}</option>
                @endforeach    
            </select>
        </div>
    </div>

    <div class="col-sm-12 col-md-12">
        <div class="form-group">
            {{Form::label('domicilio', 'Domicilio', array('aria-hidden'=>'true'))}}
            {{Form::text('domicilio', $siniestro->asegurado->domicilio,  array('class'=>'form-control form-sin', 'placeholder'=>'Calle, Numero y Colonia', 'autocomplete'=>'off', 'aria-label'=>'Domicilio'))}}
        </div>
    </div>

    <div class="col-sm-6 col-md-4">
        <div class="form-group form-select" id="form-select">
            {{Form::label('estado', 'Estado', array('aria-hidden'=>'true'))}}
            <select class="form-control form-sin" name="estado" id="estado" >
                <option value="">Seleccione el Estado</option>
                @foreach($estados as $estado)
                    <option <?php if($siniestro->asegurado->estado == $estado->id){echo("selected");}?> value="{{$estado->id}}">{{$estado->nombre}}</option>
                @endforeach 
            </select>
        </div>
    </div>


    <div class="col-sm-6 col-md-4">
        <div class="form-group">
            {{Form::label('ciudad', 'Ciudad', array('aria-hidden'=>'true'))}}
            {{Form::text('ciudad', $siniestro->asegurado->ciudad,  array('class'=>'form-control form-sin', 'placeholder'=>'Ciudad', 'autocomplete'=>'off', 'aria-label'=>'Ciudad'))}}
        </div>
    </div>

    <div class="col-sm-6 col-md-4">
        <div class="form-group">
            {{Form::label('codigo_postal', 'Codigo Postal', array('aria-hidden'=>'true'))}}
            {{Form::text('codigo_postal', $siniestro->asegurado->codigo_postal,  array('class'=>'form-control form-sin', 'placeholder'=>'Codigo Postal', 'autocomplete'=>'off', 'aria-label'=>'Codigo Postal'))}}
        </div>
    </div>

    <div class="col-sm-6 col-md-4">
        <div class="form-group">
            {{Form::label('telefono', 'Telefono', array('aria-hidden'=>'true'))}}
            {{Form::text('telefono', $siniestro->asegurado->telefono,  array('class'=>'form-control form-sin', 'placeholder'=>'telefono', 'autocomplete'=>'off', 'aria-label'=>'telefono'))}}
        </div>
    </div>

    <div class="col-sm-6 col-md-4">
        <div class="form-group">
            {{Form::label('fax', 'Fax', array('aria-hidden'=>'true'))}}
            {{Form::text('fax', $siniestro->asegurado->fax,  array('class'=>'form-control form-sin', 'placeholder'=>'fax', 'autocomplete'=>'off', 'aria-label'=>'fax'))}}
        </div>
    </div>

    <div class="col-sm-6 col-md-4">
        <div class="form-group">
            {{Form::label('email', 'E-mail', array('aria-hidden'=>'true'))}}
            {{Form::text('email', $siniestro->asegurado->email,  array('class'=>'form-control form-sin', 'placeholder'=>'e-mail', 'autocomplete'=>'off', 'aria-label'=>'email'))}}
        </div>
    </div>

    <div class="col-sm-6 col-md-4">
        <div class="form-group">
            {{Form::label('rfc', 'RFC', array('aria-hidden'=>'true'))}}
            {{Form::text('rfc', $siniestro->asegurado->rfc,  array('class'=>'form-control form-sin', 'placeholder'=>'RFC', 'autocomplete'=>'off', 'aria-label'=>'RFC'))}}
        </div>
    </div>

    <div class="col-sm-6 col-md-4">
        <div class="form-group form-select" id="form-select">
            {{Form::label('sexo', 'Sexo', array('aria-hidden'=>'true'))}}
            <select class="form-control form-sin" name="sexo" id="sexo" >
                <option value="">Seleccione el Sexo</option>
                @foreach($sexos as $sexo)
                    <option <?php if($siniestro->asegurado->sexo == $sexo->id){echo("selected");}?> value="{{$sexo->id}}">{{$sexo->sexo}}</option>
                @endforeach 
            </select>
        </div>
    </div>

</div>
</fieldset>
{{Form::button('Editar', array('class'=>'btn-editarAseguradoR btn btn-success', 'data-toggle' => 'modal', 'data-target'=>'#editarAseguradoR-modal', 'data-backdrop' => 'static', 'data-keyboard' => 'false', 'data-id' => $siniestro->asegurado->id))}}
<hr>

<h4>Logo Asegurado</h4>
@if($siniestro->asegurado->logo == Null || $siniestro->asegurado->logo == "")
    <div class="alert alert-danger" role="alert">
        <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
        <span class="sr-only">Error:</span>
        No hay logo del asegurado cargado
    </div>
    {{Form::button('Agregar Logo', array('class'=>'btn-nuevoLogoR btn btn-success', 'data-toggle' => 'modal', 'data-target'=>'#nuevoLogoR-modal', 'data-backdrop' => 'static', 'data-keyboard' => 'false', 'data-id' => $siniestro->asegurado->id))}}
@else
    <div class="row">
        <div class="col-sm-12 col-md-12">
            <div class="form-group">
                <img src="/{{$siniestro->asegurado->logo}}"  class="img-rounded img-responsive" style="width: 300px; height: 150px;">
            </div>
        </div>
    </div>
    {{Form::button('Editar', array('class'=>'btn-nuevoLogoR btn btn-success', 'data-toggle' => 'modal', 'data-target'=>'#nuevoLogoR-modal', 'data-backdrop' => 'static', 'data-keyboard' => 'false', 'data-id' => $siniestro->asegurado->id))}}
@endif
<hr>

<h4>Caracter Asegurado</h4>
@if(count($siniestro->asegurado->caracteres) == 0)
    <div class="alert alert-danger" role="alert">
        <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
        <span class="sr-only">Error:</span>
        No esta asignado el caracter del asegurado
    </div>
    {{Form::button('Asignar Caracter', array('class'=>'btn-nuevoCaracterR btn btn-success', 'data-toggle' => 'modal', 'data-target'=>'#nuevoCaracterR-modal', 'data-backdrop' => 'static', 'data-keyboard' => 'false', 'data-id' => $siniestro->asegurado->id))}}
@else
    <ul class="list-group" style="max-width: 400px;">
    @foreach($siniestro->asegurado->caracteres as $caracteres)
        <li class="list-group-item">{{$caracteres->caracter}}</li>
    @endforeach
    </ul>
    {{Form::button('Editar', array('class'=>'btn-editarCaracterR btn btn-success', 'data-toggle' => 'modal', 'data-target'=>'#editarCaracterR-modal', 'data-backdrop' => 'static', 'data-keyboard' => 'false', 'data-id' => $siniestro->asegurado->id))}}
@endif

<hr>
@if ($siniestro->asegurado->tipo_persona == 1 || $siniestro->asegurado->tipo_persona == 3 )
    <h4>Apoderado Legal</h4>
    @if($siniestro->asegurado->id_apoderado_legal == Null || $siniestro->asegurado->id_apoderado_legal == "")
        <div class="alert alert-danger" role="alert">
            <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
            <span class="sr-only">Error:</span>
            No hay Apoderado Legal Registrado
        </div>
        {{Form::button('Agregar Nuevo Apoderado Legal', array('class'=>'btn-nuevoApoderadoR btn btn-success', 'data-toggle' => 'modal', 'data-target'=>'#nuevoApoderadoR-modal', 'data-backdrop' => 'static', 'data-keyboard' => 'false', 'data-id' => $siniestro->asegurado->id))}}
        {{Form::button('Seleccionar Apoderado de una Lista', array('class'=>'btn-seleccionarApoderadoR btn btn-info', 'data-toggle' => 'modal', 'data-target'=>'#seleccionarApoderadoR-modal', 'data-backdrop' => 'static', 'data-keyboard' => 'false', 'data-id' => $siniestro->asegurado->id))}}
    @else
        <fieldset disabled>
        <div class="row">
            <div class="col-sm-6 col-md-4">
                <div class="form-group">
                    {{Form::label('nombre', 'Nombre', array('aria-hidden'=>'true'))}}
                    {{Form::text('nombre', $siniestro->asegurado->apoderado_legal()->first()->nombre,  array('class'=>'form-control form-sin', 'placeholder'=>'Nombre', 'autocomplete'=>'off', 'aria-label'=>'Nombre'))}}
                </div>
            </div>
            <div class="col-sm-6 col-md-4">
                <div class="form-group form-select" id="form-select">
                    {{Form::label('sexo', 'Sexo', array('aria-hidden'=>'true'))}}
                    <select class="form-control form-sin" name="sexo" id="sexo" >
                        <option value="">Seleccione el Sexo</option>
                        @foreach($sexos as $sexo)
                            <option <?php if($siniestro->asegurado->apoderado_legal()->first()->sexo == $sexo->id){echo("selected");}?> value="{{$sexo->id}}">{{$sexo->sexo}}</option>
                        @endforeach 
                    </select>
                </div>
            </div>
            <div class="col-sm-6 col-md-4">
                <div class="form-group">
                    {{Form::label('telefono', 'Telefono', array('aria-hidden'=>'true'))}}
                    {{Form::text('telefono', $siniestro->asegurado->apoderado_legal()->first()->telefono,  array('class'=>'form-control form-sin', 'placeholder'=>'telefono', 'autocomplete'=>'off', 'aria-label'=>'telefono'))}}
                </div>
            </div>
            <div class="col-sm-6 col-md-4">
                <div class="form-group">
                    {{Form::label('email', 'E-mail', array('aria-hidden'=>'true'))}}
                    {{Form::text('email', $siniestro->asegurado->apoderado_legal()->first()->email,  array('class'=>'form-control form-sin', 'placeholder'=>'e-mail', 'autocomplete'=>'off', 'aria-label'=>'email'))}}
                </div>
            </div>
            <div class="col-sm-6 col-md-4">
                <div class="form-group">
                    {{Form::label('nextel', 'Nextel', array('aria-hidden'=>'true'))}}
                    {{Form::text('nextel', $siniestro->asegurado->apoderado_legal()->first()->nextel,  array('class'=>'form-control form-sin', 'placeholder'=>'Nextel', 'autocomplete'=>'off', 'aria-label'=>'Nextel'))}}
                </div>
            </div>
        </div>
        </fieldset>
        {{Form::button('Editar', array('class'=>'btn-editarApoderadoR btn btn-success', 'data-toggle' => 'modal', 'data-target'=>'#editarApoderadoR-modal', 'data-backdrop' => 'static', 'data-keyboard' => 'false', 'data-id' => $siniestro->asegurado->id_apoderado_legal))}}
    @endif
    <hr>
@endif

<h4>Contacto</h4>
    @if($siniestro->asegurado->id_contacto == Null || $siniestro->asegurado->id_contacto == "")
        <div class="alert alert-danger" role="alert">
            <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
            <span class="sr-only">Error:</span>
            No hay Contacto Registrado
        </div>
        {{Form::button('Agregar Contacto', array('class'=>'btn-nuevoContactoR btn btn-success', 'data-toggle' => 'modal', 'data-target'=>'#nuevoContactoR-modal', 'data-backdrop' => 'static', 'data-keyboard' => 'false', 'data-id' => $siniestro->asegurado->id))}}
        {{Form::button('Seleccionar Contacto de una Lista', array('class'=>'btn-seleccionarContactoR btn btn-info', 'data-toggle' => 'modal', 'data-target'=>'#seleccionarContactoR-modal', 'data-backdrop' => 'static', 'data-keyboard' => 'false', 'data-id' => $siniestro->asegurado->id))}}
    @else
        <fieldset disabled>
        <div class="row">
            <div class="col-sm-6 col-md-4">
                <div class="form-group">
                    {{Form::label('nombre', 'Nombre', array('aria-hidden'=>'true'))}}
                    {{Form::text('nombre', $siniestro->asegurado->contacto()->first()->nombre,  array('class'=>'form-control form-sin', 'placeholder'=>'Nombre', 'autocomplete'=>'off', 'aria-label'=>'Nombre'))}}
                </div>
            </div>
            <div class="col-sm-6 col-md-4">
                <div class="form-group form-select" id="form-select">
                    {{Form::label('sexo', 'Sexo', array('aria-hidden'=>'true'))}}
                    <select class="form-control form-sin" name="sexo" id="sexo" >
                        <option value="">Seleccione el Sexo</option>
                        @foreach($sexos as $sexo)
                            <option <?php if($siniestro->asegurado->contacto()->first()->sexo == $sexo->id){echo("selected");}?> value="{{$sexo->id}}">{{$sexo->sexo}}</option>
                        @endforeach 
                    </select>
                </div>
            </div>
            <div class="col-sm-6 col-md-4">
                <div class="form-group">
                    {{Form::label('telefono', 'Telefono', array('aria-hidden'=>'true'))}}
                    {{Form::text('telefono', $siniestro->asegurado->contacto()->first()->telefono,  array('class'=>'form-control form-sin', 'placeholder'=>'telefono', 'autocomplete'=>'off', 'aria-label'=>'telefono'))}}
                </div>
            </div>
            <div class="col-sm-6 col-md-4">
                <div class="form-group">
                    {{Form::label('email', 'E-mail', array('aria-hidden'=>'true'))}}
                    {{Form::text('email', $siniestro->asegurado->contacto()->first()->email,  array('class'=>'form-control form-sin', 'placeholder'=>'e-mail', 'autocomplete'=>'off', 'aria-label'=>'email'))}}
                </div>
            </div>
            <div class="col-sm-6 col-md-4">
                <div class="form-group">
                    {{Form::label('nextel', 'Nextel', array('aria-hidden'=>'true'))}}
                    {{Form::text('nextel', $siniestro->asegurado->contacto()->first()->nextel,  array('class'=>'form-control form-sin', 'placeholder'=>'Nextel', 'autocomplete'=>'off', 'aria-label'=>'Nextel'))}}
                </div>
            </div>
        </div>
        </fieldset>
        {{Form::button('Editar', array('class'=>'btn-editarContactoR btn btn-success', 'data-toggle' => 'modal', 'data-target'=>'#editarContactoR-modal', 'data-backdrop' => 'static', 'data-keyboard' => 'false', 'data-id' => $siniestro->asegurado->id_contacto))}}
    @endif
<hr>

@if ($siniestro->asegurado->tipo_persona == 1)
<h4>Acta Constitutiva</h4>
    @if($siniestro->asegurado->acta_constitutiva()->first() == Null)
        <div class="alert alert-danger" role="alert">
            <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
            <span class="sr-only">Error:</span>
            No hay Acta Constitutiva Registrada
        </div>
        {{Form::button('Agregar Acta Constitutiva', array('class'=>'btn-nuevoActaConstitutivaR btn btn-success', 'data-toggle' => 'modal', 'data-target'=>'#nuevoActaConstitutivaR-modal', 'data-backdrop' => 'static', 'data-keyboard' => 'false', 'data-id' => $siniestro->asegurado->id))}}
    @else
        <fieldset disabled>
            <div class="row">
                <div class="col-sm-6 col-md-8">
                    <div class="form-group">
                        {{Form::label('escritura_publica', 'Escritura Publica', array('aria-hidden'=>'true'))}}
                        {{Form::text('escritura_publica', $siniestro->asegurado->acta_constitutiva()->first()->escritura_publica,  array('class'=>'form-control form-sin', 'placeholder'=>'Escritura Publica', 'autocomplete'=>'off', 'aria-label'=>'Escritura Publica'))}}
                    </div>
                </div>

                <div class="col-sm-6 col-md-4">
                    <div class="form-group">
                        {{Form::label('fecha', 'Fecha')}}
                        {{Form::text('fecha', date_format(date_create($siniestro->asegurado->acta_constitutiva()->first()->fecha), 'd/m/Y H:i'), ['class' => 'datetimepicker1 form-control form-sin', 'placeholder' => 'Date'])}}
                    </div>
                </div>

                <div class="col-sm-6 col-md-6">
                    <div class="form-group">
                        {{Form::label('notario_publico', 'Notario Publico', array('aria-hidden'=>'true'))}}
                        {{Form::text('notario_publico', $siniestro->asegurado->acta_constitutiva()->first()->notario_publico,  array('class'=>'form-control form-sin', 'placeholder'=>'Notario Publico', 'autocomplete'=>'off', 'aria-label'=>'Notario Publico'))}}
                    </div>
                </div>

                <div class="col-sm-6 col-md-6">
                    <div class="form-group">
                        {{Form::label('administrador', 'Administrador', array('aria-hidden'=>'true'))}}
                        {{Form::text('administrador', $siniestro->asegurado->acta_constitutiva()->first()->administrador,  array('class'=>'form-control form-sin', 'placeholder'=>'Administrador', 'autocomplete'=>'off', 'aria-label'=>'Administrador'))}}
                    </div>
                </div>

                <div class="col-sm-12 col-md-12">
                    <div class="form-group">
                        {{Form::label('objeto', 'Objeto', array('aria-hidden'=>'true'))}}
                        {{Form::textarea('objeto', $siniestro->asegurado->acta_constitutiva()->first()->objeto,  array('class'=>'form-control form-sin', 'placeholder'=>'Objeto', 'autocomplete'=>'off', 'aria-label'=>'objeto', 'rows' => 3, 'style'=>'resize:none;'))}}
                    </div>
                </div>
            </div>
        </fieldset>
        {{Form::button('Editar', array('class'=>'btn-editarActaConstitutivaR btn btn-success', 'data-toggle' => 'modal', 'data-target'=>'#editarActaConstitutivaR-modal', 'data-backdrop' => 'static', 'data-keyboard' => 'false', 'data-id' => $siniestro->asegurado->acta_constitutiva()->first()->id))}}
    @endif
    <hr>
@endif

                    