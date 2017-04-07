@if($siniestro->id_averiguacion_previa == Null || $siniestro->id_averiguacion_previa == "")
    <div class="alert alert-danger" role="alert">
        <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
        <span class="sr-only">Error:</span>
        No hay Averiguacion Previa Registrada
    </div>
        {{Form::button('Agregar Averiguacion Previa', array('class'=>'btn-nuevoAveriguacionR btn btn-success', 'data-toggle' => 'modal', 'data-target'=>'#nuevoAveriguacionR-modal', 'data-backdrop' => 'static', 'data-keyboard' => 'false'))}}
@else
    <fieldset disabled>
        <div class="row">
            <div class="col-sm-6 col-md-7">
                <div class="form-group">
                    {{Form::label('num_averiguacion', 'Numero de Averiguacion', array('aria-hidden'=>'true'))}}
                    {{Form::text('num_averiguacion', $siniestro->averiguacion_previa()->first()->num_averiguacion,  array('class'=>'form-control form-sin', 'placeholder'=>'Numero de Averiguacion', 'autocomplete'=>'off', 'aria-label'=>'Numero de Averiguacion'))}}
                </div>
            </div>

            <div class="col-sm-6 col-md-7">
                <div class="form-group">
                    {{Form::label('dependencia_judicial', 'Dependencia Judicial', array('aria-hidden'=>'true'))}}
                    {{Form::text('dependencia_judicial', $siniestro->averiguacion_previa()->first()->dependencia_judicial,  array('class'=>'form-control form-sin', 'placeholder'=>'Dependencia Judicial', 'autocomplete'=>'off', 'aria-label'=>'Dependencia Judicial'))}}
                </div>
            </div>

            <div class="col-sm-6 col-md-7">
                <div class="form-group">
                    {{Form::label('titular_dependencia', 'Titular de la Dependencia', array('aria-hidden'=>'true'))}}
                    {{Form::text('titular_dependencia', $siniestro->averiguacion_previa()->first()->titular_dependencia, array('class'=>'form-control form-sin', 'placeholder'=>'Titular de la Dependencia', 'autocomplete'=>'off', 'aria-label'=>'Titular de la Dependencia'))}}
                </div>
            </div>


        </div>
    </fieldset>
    {{Form::button('Editar', array('class'=>'btn-editarAveriguacionR btn btn-success', 'data-toggle' => 'modal', 'data-target'=>'#editarAveriguacionR-modal', 'data-backdrop' => 'static', 'data-keyboard' => 'false', 'data-id' => $siniestro->id_averiguacion_previa))}}
    <hr>
@endif