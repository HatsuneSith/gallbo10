@if($siniestro->id_poliza == Null || $siniestro->id_poliza == "")
    <div class="alert alert-danger" role="alert">
        <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
        <span class="sr-only">Error:</span>
        No hay Poliza Registrada
    </div>
        {{Form::button('Agregar Poliza', array('class'=>'btn-nuevoPolizaR btn btn-success', 'data-toggle' => 'modal', 'data-target'=>'#nuevoPolizaR-modal', 'data-backdrop' => 'static', 'data-keyboard' => 'false'))}}
@else
    <fieldset disabled>
        <div class="row">
            
            <div class="col-sm-6 col-md-4">
                <div class="form-group">
                    {{Form::label('num_poliza', 'Numero Poliza', array('aria-hidden'=>'true'))}}
                    {{Form::text('num_poliza', $siniestro->poliza->num_poliza,  array('class'=>'form-control form-sin', 'placeholder'=>'Numero Poliza', 'autocomplete'=>'off', 'aria-label'=>'Numero Poliza', 'required'))}}
                </div>
            </div>

            <div class="col-sm-6 col-md-4">
                <div class="form-group form-select" id="form-select">
                    {{Form::label('ramo_poliza', 'Ramo Poliza', array('aria-hidden'=>'true'))}}
                    <select class="form-control form-sin" name="ramo_poliza" id="ramo_poliza" >
                        <option value="">Seleccione el Ramo</option>
                        @foreach($ramos_polizas as $rp)
                            <option <?php if($siniestro->poliza->ramo_poliza == $rp->id){echo("selected");}?> value="{{$rp->id}}">{{$rp->ramo}}</option>
                        @endforeach 
                    </select>
                </div>
            </div>

            <div class="col-sm-6 col-md-4">
                <div class="form-group">
                    {{Form::label('fecha_expedicion', 'Fecha de Expedicion')}}
                    {{Form::text('fecha_expedicion', date_format(date_create($siniestro->poliza->fecha_expedicion), 'd/m/Y H:i'), ['class' => 'datetimepicker1 form-control form-sin', 'placeholder' => 'Date'])}}
                </div>
            </div>

            <div class="col-sm-6 col-md-4">
                <div class="form-group">
                    {{Form::label('inicio_vigencia', 'Inicio de Vigencia')}}
                    {{Form::text('inicio_vigencia', date_format(date_create($siniestro->poliza->inicio_vigencia), 'd/m/Y H:i'), ['class' => 'datetimepicker1 form-control form-sin', 'placeholder' => 'Date'])}}
                </div>
            </div>

            <div class="col-sm-6 col-md-4">
                <div class="form-group">
                    {{Form::label('fin_vigencia', 'Fin de Vigencia')}}
                    {{Form::text('fin_vigencia', date_format(date_create($siniestro->poliza->fin_vigencia), 'd/m/Y H:i'), ['class' => 'datetimepicker1 form-control form-sin', 'placeholder' => 'Date'])}}
                </div>
            </div>

            <div class="col-sm-6 col-md-4">
                <div class="form-group form-select" id="form-select">
                    {{Form::label('tipo_moneda', 'Tipo de Moneda', array('aria-hidden'=>'true'))}}
                    <select class="form-control form-sin" name="tipo_moneda" id="tipo_moneda" >
                        <option value="">Seleccione el Tipo</option>
                        @foreach($monedas as $moneda)
                            <option <?php if($siniestro->poliza->tipo_moneda == $moneda->id){echo("selected");}?> value="{{$moneda->id}}">{{$moneda->moneda}}</option>
                        @endforeach 
                    </select>
                </div>
            </div>

        </div>
    </fieldset>
    {{Form::button('Editar', array('class'=>'btn-editarPolizaR btn btn-success', 'data-toggle' => 'modal', 'data-target'=>'#editarPolizaR-modal', 'data-backdrop' => 'static', 'data-keyboard' => 'false', 'data-id' => $siniestro->id_poliza))}}
    <hr>

    <h4>Coberturas Afectadas</h4>
    @if(count($siniestro->poliza->coberturas) == 0)
        <div class="alert alert-danger" role="alert">
            <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
            <span class="sr-only">Error:</span>
            No esta declaradas las coberturas afectadas
        </div>
        {{Form::button('Declarar Coberturas', array('class'=>'btn-nuevoCoberturasR btn btn-success', 'data-toggle' => 'modal', 'data-target'=>'#nuevoCoberturasR-modal', 'data-backdrop' => 'static', 'data-keyboard' => 'false', 'data-id' => $siniestro->id_poliza))}}
    @else
        
        <table class="table table-bordered">
            <thead>
                <tr>
                    <td>Cobertura</td>
                    <td>Suma Asegurada</td>
                    <td>Valor Declarado</td>
                    <td>Deducible</td>
                    <td>Coaseguro</td>
                </tr>
            </thead>
            <tbody>
                @foreach($siniestro->poliza->coberturas as $coberturas)
                <tr>
                    <td>{{$coberturas->cobertura}}</td>
                    <td>{{$coberturas->pivot->suma_asegurada}}</td>
                    <td>{{$coberturas->pivot->valor_declarado}}</td>
                    <td>{{$coberturas->pivot->deducible}}</td>
                    <td>{{$coberturas->pivot->coaseguro}}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        {{Form::button('Agregar o Quitar Coberturas', array('class'=>'btn-editarCoberturasR btn btn-success', 'data-toggle' => 'modal', 'data-target'=>'#editarCoberturasR-modal', 'data-backdrop' => 'static', 'data-keyboard' => 'false', 'data-id' => $siniestro->id_poliza))}}
        {{Form::button('Alimentar Datos De Coberturas Afectadas', array('class'=>'btn-editarCoberturasDatosR btn btn-success', 'data-toggle' => 'modal', 'data-target'=>'#editarCoberturasDatosR-modal', 'data-backdrop' => 'static', 'data-keyboard' => 'false', 'data-id' => $siniestro->id_poliza))}}
    @endif
    <hr>

    @if($siniestro->poliza->coberturas->contains(4))
        <h4>Perdidas Consecuenciales</h4>
        @if(count($siniestro->poliza->perdidas_consecuenciales()->get()) == 0)
            <div class="alert alert-danger" role="alert">
                <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                <span class="sr-only">Error:</span>
                No esta declaradas las perdidas consecuenciales
            </div>
            {{Form::button('Declarar Perdidas Consecuenciales', array('class'=>'btn-nuevoPerdidasConsecuencialesR btn btn-success', 'data-toggle' => 'modal', 'data-target'=>'#nuevoPerdidasConsecuencialesR-modal', 'data-backdrop' => 'static', 'data-keyboard' => 'false', 'data-id' => $siniestro->poliza->id))}}
        @else
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <td>Perdida</td>
                        <td>Periodo de Indemnizacion</td>
                    </tr>
                </thead>
                <tbody>
                    @foreach($siniestro->poliza->perdidas_consecuenciales()->get() as $perdidas)
                    <tr>
                        <td>{{$perdidas->perdida}}</td>
                        <td>{{$perdidas->pivot->periodo_indemnizacion}}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            {{Form::button('Agregar o Quitar Perdidas', array('class'=>'btn-editarPerdidasConsecuencialesR btn btn-success', 'data-toggle' => 'modal', 'data-target'=>'#editarPerdidasConsecuencialesR-modal', 'data-backdrop' => 'static', 'data-keyboard' => 'false', 'data-id' => $siniestro->id_poliza))}}
            {{Form::button('Agregar Periodo de Indemnizacion', array('class'=>'btn-editarPerdidasConsecuencialesIndemnizacionR btn btn-success', 'data-toggle' => 'modal', 'data-target'=>'#editarPerdidasConsecuencialesIndemnizacionR-modal', 'data-backdrop' => 'static', 'data-keyboard' => 'false', 'data-id' => $siniestro->id_poliza))}}
        @endif
        <hr>
    @endif

    <h4>Clausulas Especiales</h4>
    @if(count($siniestro->poliza->clausulas_especiales()->get()) == 0)
        <div class="alert alert-danger" role="alert">
            <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
            <span class="sr-only">Error:</span>
            No esta declaradas las clausulas especiales
        </div>
        {{Form::button('Declarar Clausulas', array('class'=>'btn-nuevoClausulasEspecialesR btn btn-success', 'data-toggle' => 'modal', 'data-target'=>'#nuevoClausulasEspecialesR-modal', 'data-backdrop' => 'static', 'data-keyboard' => 'false', 'data-id' => $siniestro->poliza->id))}}
    @else
        <ul class="list-group" style="max-width: 400px;">
        @foreach($siniestro->poliza->clausulas_especiales()->get() as $clausulas)
            <li class="list-group-item">{{$clausulas->clausula}}</li>
        @endforeach
        </ul>
        {{Form::button('Editar', array('class'=>'btn-editarClausulasEspecialesR btn btn-success', 'data-toggle' => 'modal', 'data-target'=>'#editarClausulasEspecialesR-modal', 'data-backdrop' => 'static', 'data-keyboard' => 'false', 'data-id' => $siniestro->id_poliza))}}
    @endif
    <hr>

    @if($siniestro->poliza->clausulas_especiales()->get()->contains(1))
        <h4>Limitacion de Valor Reposicion</h4>
        @if($siniestro->poliza->limitacion_valor_reposicion()->first() == Null)
            <div class="alert alert-danger" role="alert">
                <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                <span class="sr-only">Error:</span>
                No esta declarada la limitacion de valor reposicion
            </div>
            {{Form::button('Declarar Limitacion de Valor Reposicion', array('class'=>'btn-nuevoLimitacionValorReposicionR btn btn-success', 'data-toggle' => 'modal', 'data-target'=>'#nuevoLimitacionValorReposicionR-modal', 'data-backdrop' => 'static', 'data-keyboard' => 'false', 'data-id' => $siniestro->poliza->id))}}
        @else
            <ul class="list-group">
                <li class="list-group-item">{{$siniestro->poliza->limitacion_valor_reposicion()->first()->limitacion}}</li>
            </ul>

            {{Form::button('Editar', array('class'=>'btn-editarLimitacionValorReposicionR btn btn-success', 'data-toggle' => 'modal', 'data-target'=>'#editarLimitacionValorReposicionR-modal', 'data-backdrop' => 'static', 'data-keyboard' => 'false', 'data-id' => $siniestro->id_poliza))}}
        @endif
        <hr>
    @endif

    <h4>Endosos/Convenios</h4>
        @foreach($siniestro->poliza->endosos_convenios()->get() as $endosos)
            <p><strong>{{$endosos->texto}}</strong></p>
        @endforeach
        {{Form::button('Agregar Endosos/Convenios', array('class'=>'btn-nuevoEndososConveniosR btn btn-success', 'data-toggle' => 'modal', 'data-target'=>'#nuevoEndososConveniosR-modal', 'data-backdrop' => 'static', 'data-keyboard' => 'false', 'data-id' => $siniestro->id_poliza))}}
    <hr>

    <h4>Medidas de Seguridad</h4>
    @if($siniestro->poliza->medidas_seguridad()->first() == Null)
        <div class="alert alert-danger" role="alert">
            <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
            <span class="sr-only">Error:</span>
            No hay Medidas de Seguridad
        </div>
        {{Form::button('Agregar Medidas de Seguridad', array('class'=>'btn-nuevoMedidasSeguridadR btn btn-success', 'data-toggle' => 'modal', 'data-target'=>'#nuevoMedidasSeguridadR-modal', 'data-backdrop' => 'static', 'data-keyboard' => 'false', 'data-id' => $siniestro->id_poliza))}}
    @else
        <ul class="list-group">
            <li class="list-group-item">{{nl2br($siniestro->poliza->medidas_seguridad()->first()->descripcion)}}</li>
        </ul>
    @endif
    <hr>

@endif