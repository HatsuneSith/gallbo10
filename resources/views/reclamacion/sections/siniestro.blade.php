<fieldset disabled>

<div class="row">
    <div class="col-sm-6 col-md-4">
        <div class="form-group">
            <?php $fecha_siniestro = new DateTime($siniestro->fecha);?>
            {{Form::label('fecha', 'Fecha del Siniestro')}}
            {{Form::text('fecha', $fecha_siniestro->format('d/m/Y H:i'), ['class' => 'datetimepicker1 form-control form-sin', 'placeholder' => 'Date'])}}
        </div>
    </div>

    <div class="col-sm-6 col-md-4">
        <div class="form-group">
            {{Form::label('num_siniestro', 'Numero de Siniestro', array('aria-hidden'=>'true'))}}
            {{Form::text('num_siniestro', $siniestro->num_siniestro,  array('class'=>'form-control form-sin', 'placeholder'=>'Numero de Siniestro', 'autocomplete'=>'off', 'aria-label'=>'Numero de Siniestro'))}}
        </div>
    </div>

    <div class="col-sm-6 col-md-4">
        <div class="form-group form-select" id="form-select">
            {{Form::label('tipo_siniestro', 'Tipo de Siniestro', array('aria-hidden'=>'true'))}}
            <select class="form-control form-sin" name="tipo_siniestro" id="tipo_siniestro" >
                <option value="">Seleccione el Tipo de Siniestro</option>
                @foreach($tipos_siniestros as $tipo)
                    <option <?php if($siniestro->tipo_siniestro == $tipo->id){echo("selected");}?> value="{{$tipo->id}}"> {{$tipo->tipo}}</option>
                @endforeach    
            </select>
        </div>
    </div>

    <div class="col-sm-12 col-md-12">
        <div class="form-group">
            {{Form::label('domicilio', 'Domicilio', array('aria-hidden'=>'true'))}}
            {{Form::text('domicilio', $siniestro->domicilio,  array('class'=>'form-control form-sin', 'placeholder'=>'Calle, Numero y Colonia', 'autocomplete'=>'off', 'aria-label'=>'Domicilio'))}}
        </div>
    </div>

    <div class="col-sm-6 col-md-4">
        <div class="form-group form-select" id="form-select">
            {{Form::label('estado', 'Estado', array('aria-hidden'=>'true'))}}
            <select class="form-control form-sin" name="estado" id="estado" >
                <option value="">Seleccione el Estado</option>
                @foreach($estados as $estado)
                    <option <?php if($siniestro->estado == $estado->id){echo("selected");}?> value="{{$estado->id}}">{{$estado->nombre}}</option>
                @endforeach 
            </select>
        </div>
    </div>

    <div class="col-sm-6 col-md-4">
        <div class="form-group">
            {{Form::label('ciudad', 'Ciudad', array('aria-hidden'=>'true'))}}
            {{Form::text('ciudad', $siniestro->ciudad,  array('class'=>'form-control form-sin', 'placeholder'=>'Ciudad', 'autocomplete'=>'off', 'aria-label'=>'Ciudad'))}}
        </div>
    </div>

    <div class="col-sm-6 col-md-4">
        <div class="form-group">
            {{Form::label('codigo_postal', 'Codigo Postal', array('aria-hidden'=>'true'))}}
            {{Form::text('codigo_postal', $siniestro->codigo_postal,  array('class'=>'form-control form-sin', 'placeholder'=>'Codigo Postal', 'autocomplete'=>'off', 'aria-label'=>'Codigo Postal'))}}
        </div>
    </div>
</div>
</fieldset>

{{Form::button('Editar', array('class'=>'btn-editarSiniestroR btn btn-success', 'data-toggle' => 'modal', 'data-target'=>'#editarSiniestroR-modal', 'data-backdrop' => 'static', 'data-keyboard' => 'false', 'data-id' => $siniestro->id))}}
<hr>

<h4>Ejecutivos Asignados</h4>
@if(count($siniestro->ejecutivo_asignado()->get()) == 0)
    <div class="alert alert-danger" role="alert">
        <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
        <span class="sr-only">Error:</span>
        No se han asignado ejecutivos a este siniestro
    </div>
    {{Form::button('Asignar Ejecutivos', array('class'=>'btn-nuevoEjecutivoAsignadoR btn btn-success', 'data-toggle' => 'modal', 'data-target'=>'#nuevoEjecutivoAsignadoR-modal', 'data-backdrop' => 'static', 'data-keyboard' => 'false'))}}
@else
    <ul class="list-group" style="max-width: 400px;">
    @foreach($siniestro->ejecutivo_asignado()->get() as $ejecutivos)
        <li class="list-group-item">{{$ejecutivos->nombre . " " . $ejecutivos->apellido}}</li>
    @endforeach
    </ul>
    {{Form::button('Editar', array('class'=>'btn-editarEjecutivoAsignadoR btn btn-success', 'data-toggle' => 'modal', 'data-target'=>'#editarEjecutivoAsignadoR-modal', 'data-backdrop' => 'static', 'data-keyboard' => 'false'))}}
@endif
<hr>