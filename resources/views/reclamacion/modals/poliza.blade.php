{{{--nuevo poliza--}}}

<div class="modal fade nuevoPolizaR-modal" id="nuevoPolizaR-modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="H1">Agregar Poliza</h4>
            </div>
            <div class="modal-body">
                {{ Form::open(array('url' => 'sire/reclamacion/siniestro/agregar/poliza/')) }}
                    <div class="row">
                        
                        <div class="col-sm-6 col-md-4">
                            <div class="form-group">
                                {{Form::label('num_poliza', 'Numero Poliza', array('aria-hidden'=>'true'))}}
                                {{Form::text('num_poliza', '',  array('class'=>'form-control form-sin', 'placeholder'=>'Numero Poliza', 'autocomplete'=>'off', 'aria-label'=>'Numero Poliza', 'required'))}}
                            </div>
                        </div>

                        <div class="col-sm-6 col-md-4">
                            <div class="form-group form-select" id="form-select">
                                {{Form::label('ramo_poliza', 'Ramo Poliza', array('aria-hidden'=>'true'))}}
                                <select class="form-control form-sin" name="ramo_poliza" id="ramo_poliza" required>
                                    <option value="">Seleccione el Ramo</option>
                                    @foreach($ramos_polizas as $rp)
                                        <option value="{{$rp->id}}">{{$rp->ramo}}</option>
                                    @endforeach 
                                </select>
                            </div>
                        </div>

                        <div class="col-sm-6 col-md-4">
                            <div class="form-group">
                                {{Form::label('fecha_expedicion', 'Fecha de Expedicion')}}
                                {{Form::text('fecha_expedicion', '', ['class' => 'datetimepicker1 form-control form-sin', 'placeholder' => 'Date'])}}
                            </div>
                        </div>

                        <div class="col-sm-6 col-md-4">
                            <div class="form-group">
                                {{Form::label('inicio_vigencia', 'Inicio de Vigencia')}}
                                {{Form::text('inicio_vigencia', '', ['class' => 'datetimepicker1 form-control form-sin', 'placeholder' => 'Date'])}}
                            </div>
                        </div>

                        <div class="col-sm-6 col-md-4">
                            <div class="form-group">
                                {{Form::label('fin_vigencia', 'Fin de Vigencia')}}
                                {{Form::text('fin_vigencia', '', ['class' => 'datetimepicker1 form-control form-sin', 'placeholder' => 'Date'])}}
                            </div>
                        </div>

                        <div class="col-sm-6 col-md-4">
                            <div class="form-group form-select" id="form-select">
                                {{Form::label('tipo_moneda', 'Tipo de Moneda', array('aria-hidden'=>'true'))}}
                                <select class="form-control form-sin" name="tipo_moneda" id="tipo_moneda" required>
                                    <option value="">Seleccione el Tipo</option>
                                    @foreach($monedas as $moneda)
                                        <option value="{{$moneda->id}}">{{$moneda->moneda}}</option>
                                    @endforeach 
                                </select>
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

@if($siniestro->id_poliza != null)

{{{--editar poliza--}}}
<div class="modal fade editarPolizaR-modal" id="editarPolizaR-modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="H1">Editar Poliza</h4>
            </div>
            <div class="modal-body">
                {{ Form::open(array('url' => 'sire/reclamacion/siniestro/actualizar/poliza/')) }}
                    <div class="row">
                        <div class="col-sm-6 col-md-4">
                            <div class="form-group">
                                {{Form::label('num_poliza', 'Numero Poliza', array('aria-hidden'=>'true'))}}
                                {{Form::text('num_poliza', '',  array('class'=>'form-control form-sin', 'placeholder'=>'Numero Poliza', 'autocomplete'=>'off', 'aria-label'=>'Numero Poliza', 'required'))}}
                            </div>
                        </div>

                        <div class="col-sm-6 col-md-4">
                            <div class="form-group form-select" id="form-select">
                                {{Form::label('ramo_poliza', 'Ramo Poliza', array('aria-hidden'=>'true'))}}
                                <select class="form-control form-sin" name="ramo_poliza" id="ramo_poliza" >
                                    <option value="">Seleccione el Ramo</option>
                                    @foreach($ramos_polizas as $rp)
                                        <option value="{{$rp->id}}">{{$rp->ramo}}</option>
                                    @endforeach 
                                </select>
                            </div>
                        </div>

                        <div class="col-sm-6 col-md-4">
                            <div class="form-group">
                                {{Form::label('fecha_expedicion', 'Fecha de Expedicion')}}
                                {{Form::text('fecha_expedicion', '', ['class' => 'datetimepicker1 form-control form-sin', 'placeholder' => 'Date'])}}
                            </div>
                        </div>

                        <div class="col-sm-6 col-md-4">
                            <div class="form-group">
                                {{Form::label('inicio_vigencia', 'Inicio de Vigencia')}}
                                {{Form::text('inicio_vigencia', '', ['class' => 'datetimepicker1 form-control form-sin', 'placeholder' => 'Date'])}}
                            </div>
                        </div>

                        <div class="col-sm-6 col-md-4">
                            <div class="form-group">
                                {{Form::label('fin_vigencia', 'Fin de Vigencia')}}
                                {{Form::text('fin_vigencia', '', ['class' => 'datetimepicker1 form-control form-sin', 'placeholder' => 'Date'])}}
                            </div>
                        </div>

                        <div class="col-sm-6 col-md-4">
                            <div class="form-group form-select" id="form-select">
                                {{Form::label('tipo_moneda', 'Tipo de Moneda', array('aria-hidden'=>'true'))}}
                                <select class="form-control form-sin" name="tipo_moneda" id="tipo_moneda" >
                                    <option value="">Seleccione el Tipo</option>
                                    @foreach($monedas as $moneda)
                                        <option value="{{$moneda->id}}">{{$moneda->moneda}}</option>
                                    @endforeach 
                                </select>
                            </div>
                        </div>
                    </div>

                <div class="hidden">
                    <input type="text" name="id_poliza" id="id_poliza" value="{{$siniestro->id_poliza}}"/>
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

{{{--nuevo medidas de seguridad--}}}
<div class="modal fade nuevoMedidasSeguridadR-modal" id="nuevoMedidasSeguridadR-modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="H1">Agregar Medidas de Seguridad</h4>
            </div>
            <div class="modal-body">
                {{ Form::open(array('url' => 'sire/reclamacion/siniestro/agregar/medidas_seguridad/')) }}
                    <div class="row">
                        <div class="col-sm-12 col-md-12">
                            <div class="form-group">
                                {{Form::label('descripcion', 'Medidas de Seguridas', array('aria-hidden'=>'true'))}}
                                {{Form::textarea('descripcion', '', array('class'=>'form-control', 'rows'=>3, 'placeholder'=>'Medidas de Seguridad', 'autocomplete'=>'off', 'aria-label'=>'medidas de seguridad', 'required' =>'required'))}}
                                
                            </div>
                        </div>
                    </div>

                <div class="hidden">
                    <input type="text" name="id_poliza" id="id_poliza" value="{{$siniestro->id_poliza}}"/>
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

{{{--nuevo limitacion valor reposocion--}}}
<div class="modal fade nuevoLimitacionValorReposicionR-modal" id="nuevoLimitacionValorReposicionR-modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="H1">Agregar Limitacion del Valor Reposicion</h4>
            </div>
            <div class="modal-body">
                {{ Form::open(array('url' => 'sire/reclamacion/siniestro/agregar/limitacion_valor_reposicion/')) }}
                    <div class="row">
                        <div class="col-sm-12 col-md-12">
                            <div class="form-group">
                                {{Form::label('limitacion', 'Limitacion', array('aria-hidden'=>'true'))}}
                                {{Form::textarea('limitacion', '', array('class'=>'form-control', 'rows'=>3, 'placeholder'=>'Limitacion', 'autocomplete'=>'off', 'aria-label'=>'Limitacion', 'required' =>'required'))}}
                            </div>
                        </div>
                    </div>

                <div class="hidden">
                    <input type="text" name="id_poliza" id="id_poliza" value="{{$siniestro->id_poliza}}"/>
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

@if($siniestro->poliza->limitacion_valor_reposicion()->first() != NULL)

{{{--editar limitacion valor reposocion--}}}
<div class="modal fade editarLimitacionValorReposicionR-modal" id="editarLimitacionValorReposicionR-modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="H1">Editar Limitacion del Valor Reposicion</h4>
            </div>
            <div class="modal-body">
                {{ Form::open(array('url' => 'sire/reclamacion/siniestro/actualizar/limitacion_valor_reposicion/')) }}
                    <div class="row">
                        <div class="col-sm-12 col-md-12">
                            <div class="form-group">
                                {{Form::label('limitacion', 'Limitacion', array('aria-hidden'=>'true'))}}
                                {{Form::textarea('limitacion', $siniestro->poliza->limitacion_valor_reposicion()->first()->limitacion, array('class'=>'form-control', 'rows'=>3, 'placeholder'=>'Limitacion', 'autocomplete'=>'off', 'aria-label'=>'Limitacion', 'required' =>'required'))}}
                            </div>
                        </div>
                    </div>

                <div class="hidden">
                    <input type="text" name="id" id="id" value="{{$siniestro->poliza->limitacion_valor_reposicion()->first()->id}}"/>
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
@endif

{{{--nuevo endosos/convenios--}}}
<div class="modal fade nuevoEndososConveniosR-modal" id="nuevoEndososConveniosR-modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="H1">Agregar Endosos/Convenios</h4>
            </div>
            <div class="modal-body">
                {{ Form::open(array('url' => 'sire/reclamacion/siniestro/agregar/endosos_convenios/')) }}
                    <div class="row">
                        <div class="col-sm-12 col-md-12">
                            <div class="form-group">
                                {{Form::label('texto', 'Endosos / Convenios', array('aria-hidden'=>'true'))}}
                                {{Form::textarea('texto', '', array('class'=>'form-control', 'rows'=>3, 'placeholder'=>'', 'autocomplete'=>'off', 'aria-label'=>'', 'required' =>'required'))}}
                                
                            </div>
                        </div>
                    </div>

                <div class="hidden">
                    <input type="text" name="id_poliza" id="id_poliza" value="{{$siniestro->id_poliza}}"/>
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

{{{--agregar coberturas--}}}
<div class="modal fade nuevoCoberturasR-modal" id="nuevoCoberturasR-modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="H1">Declarar Coberturas Afectadas</h4>
            </div>
            {{ Form::open(array('url' => 'sire/reclamacion/siniestro/agregar/coberturas/', 'files'=>true)) }}
                <div class="modal-body">
                    @foreach($coberturas as $c)
                        <div class="checkbox">
                            <label><input type="checkbox" name="checkcobertura[]" value="{{$c->id}}">{{$c->cobertura}}</label>
                        </div>
                    @endforeach 
                    <div class="hidden">
                        <input type="text" name="id_poliza" id="id_poliza" value="{{$siniestro->id_poliza}}"/>
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

{{{--editar coberturas--}}}
<div class="modal fade editarCoberturasR-modal" id="editarCoberturasR-modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="H1">Declarar Coberturas Afectadas</h4>
            </div>
            {{ Form::open(array('url' => 'sire/reclamacion/siniestro/actualizar/coberturas/', 'files'=>true)) }}
                <div class="modal-body">
                    @foreach($coberturas as $c)
                        <div class="checkbox">
                            <label><input type="checkbox" name="checkcobertura[]" value="{{$c->id}}" <?php if($siniestro->poliza->coberturas->contains($c->id)){echo "checked";} ?> >{{$c->cobertura}}</label>
                        </div>
                    @endforeach 
                    <div class="hidden">
                        <input type="text" name="id_poliza" id="id_poliza" value="{{$siniestro->id_poliza}}"/>
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

{{{--editar datos de coberturas--}}}
<div class="modal fade editarCoberturasDatosR-modal" id="editarCoberturasDatosR-modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="H1">Editar Coberturas Afectadas</h4>
            </div>
            {{ Form::open(array('url' => 'sire/reclamacion/siniestro/actualizar/datos_coberturas/')) }}
                <div class="modal-body">
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
                                <td>{{$coberturas->cobertura}}<input type="hidden" name="id_cobertura[]" id="id_cobertura" value="{{$coberturas->id}}"/></td>
                                <td>{{Form::text('suma_asegurada[]', $coberturas->pivot->suma_asegurada,  array('class'=>'form-control form-sin', 'autocomplete'=>'off', 'aria-label'=>'Suma Asegurada'))}} </td>
                                <td>{{Form::text('valor_declarado[]', $coberturas->pivot->valor_declarado,  array('class'=>'form-control form-sin', 'autocomplete'=>'off', 'aria-label'=>'Valor Declarado'))}} </td>
                                <td>{{Form::text('deducible[]', $coberturas->pivot->deducible,  array('class'=>'form-control form-sin', 'autocomplete'=>'off', 'aria-label'=>'Deducible'))}} </td>
                                <td>{{Form::text('coaseguro[]', $coberturas->pivot->coaseguro,  array('class'=>'form-control form-sin', 'autocomplete'=>'off', 'aria-label'=>'Coaseguro'))}} </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="hidden">
                        <input type="text" name="id_poliza" id="id_poliza" value="{{$siniestro->id_poliza}}"/>
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

{{{--agregar perdidas consecuenciales--}}}
<div class="modal fade nuevoPerdidasConsecuencialesR-modal" id="nuevoPerdidasConsecuencialesR-modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="H1">Declarar Perdidas Consecuenciales</h4>
            </div>
            {{ Form::open(array('url' => 'sire/reclamacion/siniestro/agregar/perdidas_consecuenciales/', 'files'=>true)) }}
                <div class="modal-body">
                    @foreach($perdidas_consecuenciales as $p)
                        <div class="checkbox">
                            <label><input type="checkbox" name="checkperdidas[]" value="{{$p->id}}">{{$p->perdida}}</label>
                        </div>
                    @endforeach 
                    <div class="hidden">
                        <input type="text" name="id_poliza" id="id_poliza" value="{{$siniestro->id_poliza}}"/>
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

{{{--editar perdidas consecuenciales--}}}
<div class="modal fade editarPerdidasConsecuencialesR-modal" id="editarPerdidasConsecuencialesR-modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="H1">Declarar Perdidas Consecuenciales</h4>
            </div>
            {{ Form::open(array('url' => 'sire/reclamacion/siniestro/actualizar/perdidas_consecuenciales/', 'files'=>true)) }}
                <div class="modal-body">
                    @foreach($perdidas_consecuenciales as $p)
                        <div class="checkbox">
                            <label><input type="checkbox" name="checkperdidas[]" value="{{$p->id}}" <?php if($siniestro->poliza->perdidas_consecuenciales()->get()->contains($p->id)){echo "checked";} ?> >{{$p->perdida}}</label>
                        </div>
                    @endforeach 
                    <div class="hidden">
                        <input type="text" name="id_poliza" id="id_poliza" value="{{$siniestro->id_poliza}}"/>
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

{{{--editar perdidas consecuenciales indemnizacion--}}}
<div class="modal fade editarPerdidasConsecuencialesIndemnizacionR-modal" id="editarPerdidasConsecuencialesIndemnizacionR-modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="H1">Declarar Perdidas Consecuenciales</h4>
            </div>
            {{ Form::open(array('url' => 'sire/reclamacion/siniestro/actualizar/indemnizacion_perdidas_consecuenciales/', 'files'=>true)) }}
                <div class="modal-body">
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
                                <td>{{$perdidas->perdida}}<input type="hidden" name="id_perdida[]" id="id_perdida" value="{{$perdidas->id}}"/></td>
                                <td>{{Form::text('periodo_indemnizacion[]', $perdidas->pivot->periodo_indemnizacion,  array('class'=>'form-control form-sin', 'autocomplete'=>'off', 'aria-label'=>'Periodo de indemnizacion'))}} </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="hidden">
                        <input type="text" name="id_poliza" id="id_poliza" value="{{$siniestro->id_poliza}}"/>
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

{{{--agregar clausulas especiales--}}}
<div class="modal fade nuevoClausulasEspecialesR-modal" id="nuevoClausulasEspecialesR-modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="H1">Declarar Clausulas Especiales</h4>
            </div>
            {{ Form::open(array('url' => 'sire/reclamacion/siniestro/agregar/clausulas_especiales/', 'files'=>true)) }}
                <div class="modal-body">
                    @foreach($clausulas_especiales as $c)
                        <div class="checkbox">
                            <label><input type="checkbox" name="checkclausulas[]" value="{{$c->id}}">{{$c->clausula}}</label>
                        </div>
                    @endforeach 
                    <div class="hidden">
                        <input type="text" name="id_poliza" id="id_poliza" value="{{$siniestro->id_poliza}}"/>
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

{{{--editar clausulas especiales--}}}
<div class="modal fade editarClausulasEspecialesR-modal" id="editarClausulasEspecialesR-modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="H1">Editar Clausulas Especiales</h4>
            </div>
            {{ Form::open(array('url' => 'sire/reclamacion/siniestro/actualizar/clausulas_especiales/', 'files'=>true)) }}
                <div class="modal-body">
                    @foreach($clausulas_especiales as $c)
                        <div class="checkbox">
                            <label><input type="checkbox" name="checkclausulas[]" value="{{$c->id}}" <?php if($siniestro->poliza->clausulas_especiales()->get()->contains($c->id)){echo "checked";} ?> >{{$c->clausula}}</label>
                        </div>
                    @endforeach 
                    <div class="hidden">
                        <input type="text" name="id_poliza" id="id_poliza" value="{{$siniestro->id_poliza}}"/>
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
@endif