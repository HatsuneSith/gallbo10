@extends('layouts.master')

@section('title')
    {{$cliente->cliente}}
@stop

@section('js')
    {{HTML::script('js/promocion.js')}}
@stop

@section('contenido')
<?php 
    (Input::get('año') != Null) ? Session::put('año', Input::get('año')) : Session::put('año', '2016');
?>

	<div class="row">
		<div class="col-md-12">
			<h2 aria-hidden="true"><a href="{{ url('sire/juridico') }}"><span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span></a>{{$cliente->cliente}}<img src="/img/logo_gallbo.png" alt="Gallbo"  align="right" class="img-responsive" style="max-height: 50px;"></h2> 
            {{Form::button('Agregar Acuerdo', array('class'=>'btn-nuevoAcuerdoJ btn btn-success', 'data-toggle' => 'modal', 'data-target'=>'#nuevoAcuerdoJ-modal', 'data-backdrop' => 'static', 'data-keyboard' => 'false'))}} 

            <hr>
            <form class="form-inline">
                <div class="form-group">
                    <label for="año">Año: </label>
                    <select class="form-control form-sin" name="año" id="año" required>
                        <option value="">Seleccione el Año</option>
                        <option {{ Session::get('año') == '2008' ? 'selected' : '' }} value="2008">2008</option>
                        <option {{ Session::get('año') == '2009' ? 'selected' : '' }} value="2009">2009</option>
                        <option {{ Session::get('año') == '2010' ? 'selected' : '' }} value="2010">2010</option>
                        <option {{ Session::get('año') == '2011' ? 'selected' : '' }} value="2011">2011</option>
                        <option {{ Session::get('año') == '2012' ? 'selected' : '' }} value="2012">2012</option>
                        <option {{ Session::get('año') == '2013' ? 'selected' : '' }} value="2013">2013</option>
                        <option {{ Session::get('año') == '2014' ? 'selected' : '' }} value="2014">2014</option>
                        <option {{ Session::get('año') == '2015' ? 'selected' : '' }} value="2015">2015</option>
                        <option {{ Session::get('año') == '2016' ? 'selected' : '' }} value="2016">2016</option>
                        <option {{ Session::get('año') == '2017' ? 'selected' : '' }} value="2017">2017</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary ">Aceptar</button>
            </form>
            <hr>
			@if(Session::get('info'))
            <div class="alert alert-success" >
                {{Session::get('info')}}
            </div>
            @endif
            @if(Session::get('danger'))
            <div class="alert alert-danger" >
                {{Session::get('danger')}}
            </div>
            @endif
			
			<div class="table-responsive">
                <table id="tabla_JuiciosExtrajudicial" class="table table-hover table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>Mes</th>
                            <th>Acuerdo</th>
                            <th>Detalle</th>
                            <th>Fecha de Publicacion</th>
                            <th>Fecha en que Surte Efecto</th>
                            <th>Fecha de Vencimiento de Impulso</th>
                            <th>Fecha de Impulso</th>
                            <th>Fecha limite de Acuerdo al Impulso</th>
                            <th>Fecha de Acuerdo al Impulso</th>
                            <th>Cumplimiento de tiempo de impulso</th>
                            <th>Cumplimiento de tiempo de acuerdo al impulso</th>
                            <th>Opciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php setlocale(LC_ALL, 'es_ES.UTF-8'); ?>
                        @foreach($cliente->acuerdo()->where('año', Session::get('año'))->get() as $a)
                            <tr>
                                <td>{{date('F', mktime(0, 0, 0, $a->mes, 10))}}</td>
                                <td>{{$a->acuerdo}}</td>
                                <td>{{$a->detalle}}</td>
                                <td>
                                    {{($a->fecha_publicacion != '0000-00-00 00:00:00') ? (new DateTime($a->fecha_publicacion))->format('d/m/Y') : '' }}
                                </td>
                                <td>{{($a->fecha_surte_efecto != '0000-00-00 00:00:00') ? (new DateTime($a->fecha_surte_efecto))->format('d/m/Y') : '' }}</td>
                                <td>{{($a->fecha_vencimiento_impulso != '0000-00-00 00:00:00') ? (new DateTime($a->fecha_vencimiento_impulso))->format('d/m/Y') : '' }}</td>
                                <td>{{($a->fecha_impulso != '0000-00-00 00:00:00') ? (new DateTime($a->fecha_impulso))->format('d/m/Y') : '' }}</td>
                                <td>{{($a->fecha_limite_acuerdo_impulso != '0000-00-00 00:00:00') ? (new DateTime($a->fecha_limite_acuerdo_impulso))->format('d/m/Y') : '' }}</td>
                                <td>{{($a->fecha_acuerdo_impulso != '0000-00-00 00:00:00') ? (new DateTime($a->fecha_acuerdo_impulso))->format('d/m/Y') : '' }}</td>

                                <td></td>
                                <td></td>
                                <td>{{Form::button('Editar', array('class'=>'btn-editarAcuerdoJ btn btn-primary btn-xs', 'data-toggle' => 'modal', 'data-target'=>'#editarAcuerdoJ-modal', 'data-backdrop' => 'static', 'data-keyboard' => 'false', 'data-id' => $a->id))}}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
			</div>

		</div>
	</div>
    <hr>

        <div class="row">
        <div class="col-md-12">
            <div class="table-responsive">
                <table id="" class="table table-hover table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>Mes</th>
                            <th>Número de acuerdos</th>
                            <th>Acuerdos con impulso a tiempo (#)</th>
                            <th>Acuerdos generados a tiempo de acuerdo a impulso (#)</th>
                            <th>Acuerdos con impulso a tiempo (%)</th>
                            <th>Acuerdos generados a tiempo de acuerdo a impulso (%)</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Enero</td>
                            <td>{{count($cliente->acuerdo()->where('mes', '01')->where('año', Session::get('año'))->get())}}</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>Febrero</td>
                            <td>{{count($cliente->acuerdo()->where('mes', '02')->where('año', Session::get('año'))->get())}}</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>Marzo</td>
                            <td>{{count($cliente->acuerdo()->where('mes', '03')->where('año', Session::get('año'))->get())}}</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>Abril</td>
                            <td>{{count($cliente->acuerdo()->where('mes', '04')->where('año', Session::get('año'))->get())}}</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>Mayo</td>
                            <td>{{count($cliente->acuerdo()->where('mes', '05')->where('año', Session::get('año'))->get())}}</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>Junio</td>
                            <td>{{count($cliente->acuerdo()->where('mes', '06')->where('año', Session::get('año'))->get())}}</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>Julio</td>
                            <td>{{count($cliente->acuerdo()->where('mes', '07')->where('año', Session::get('año'))->get())}}</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>Agosto</td>
                            <td>{{count($cliente->acuerdo()->where('mes', '08')->where('año', Session::get('año'))->get())}}</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>Septiembre</td>
                            <td>{{count($cliente->acuerdo()->where('mes', '09')->where('año', Session::get('año'))->get())}}</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>Octubre</td>
                            <td>{{count($cliente->acuerdo()->where('mes', '10')->where('año', Session::get('año'))->get())}}</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>Noviembre</td>
                            <td>{{count($cliente->acuerdo()->where('mes', '11')->where('año', Session::get('año'))->get())}}</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>Diciembre</td>
                            <td>{{count($cliente->acuerdo()->where('mes', '12')->where('año', Session::get('año'))->get())}}</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <hr>
@stop


@section('modals')

<div class="modal fade nuevoAcuerdoJ-modal" id="nuevoAcuerdoJ-modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="H1">Agregar Acuerdo</h4>
            </div>
            <div class="modal-body">
                {{ Form::open(array('url' => 'sire/juridico/agregar/acuerdo')) }}
                
                <div class="row">
                    <div class="col-sm-6 col-md-4">
                        <div class="form-group form-select" id="form-select">
                            {{Form::label('mes', 'Mes', array('aria-hidden'=>'true'))}}
                            <select class="form-control form-sin" name="mes" id="mes" required>
                                <option value="">Seleccione el Mes</option>
                                <option value="01">Enero</option>
                                <option value="02">Febrero</option>
                                <option value="03">Marzo</option>
                                <option value="04">Abril</option>
                                <option value="05">Mayo</option>
                                <option value="06">Junio</option>
                                <option value="07">Julio</option>
                                <option value="08">Agosto</option>
                                <option value="09">Septiembre</option>
                                <option value="10">Octubre</option>
                                <option value="11">Noviembre</option>
                                <option value="12">Diciembre</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-sm-6 col-md-4">
                        <div class="form-group form-select" id="form-select">
                            {{Form::label('año', 'Año', array('aria-hidden'=>'true'))}}
                            <select class="form-control form-sin" name="año" id="año" required>
                                <option value="">Seleccione el Año</option>
                                <option value="2008">2008</option>
                                <option value="2009">2009</option>
                                <option value="2010">2010</option>
                                <option value="2011">2011</option>
                                <option value="2012">2012</option>
                                <option value="2013">2013</option>
                                <option value="2014">2014</option>
                                <option value="2015">2015</option>
                                <option value="2016">2016</option>
                                <option value="2017">2017</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-12">
                        <div class="form-group">
                            {{Form::label('acuerdo', 'Acuerdo', array('aria-hidden'=>'true'))}}
                            {{Form::text('acuerdo', '',  array('class'=>'form-control form-sin', 'placeholder'=>'Acuerdo', 'autocomplete'=>'off', 'aria-label'=>'Acuerdo', 'required'))}}
                            
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-12">
                        <div class="form-group">
                            {{Form::label('detalle', 'Detalle', array('aria-hidden'=>'true'))}}
                            {{Form::text('detalle', '',  array('class'=>'form-control form-sin', 'placeholder'=>'Detalle', 'autocomplete'=>'off', 'aria-label'=>'Detalle', 'required'))}}
                            
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-4">
                        <div class="form-group">
                            {{Form::label('fecha_publicacion', 'Publicacion')}}
                            {{Form::input('date', 'fecha_publicacion', '', ['class' => 'form-control', 'placeholder' => 'Date']);}}
                        </div>
                    </div>

                    <div class="col-sm-6 col-md-4">
                        <div class="form-group">
                            {{Form::label('fecha_surte_efecto', 'Surte Efecto')}}
                            {{Form::input('date', 'fecha_surte_efecto', '', ['class' => 'form-control', 'placeholder' => 'Date']);}}
                        </div>
                    </div>

                    <div class="col-sm-6 col-md-4">
                        <div class="form-group">
                            {{Form::label('fecha_vencimiento_impulso', 'Vencimiento De Impulso')}}
                            {{Form::input('date', 'fecha_vencimiento_impulso', '', ['class' => 'form-control', 'placeholder' => 'Date']);}}
                        </div>
                    </div>

                    <div class="col-sm-6 col-md-4">
                        <div class="form-group">
                            {{Form::label('fecha_impulso', 'Impulso')}}
                            {{Form::input('date', 'fecha_impulso', '', ['class' => 'form-control', 'placeholder' => 'Date']);}}
                        </div>
                    </div>

                    <div class="col-sm-6 col-md-4">
                        <div class="form-group">
                            {{Form::label('fecha_limite_acuerdo_impulso', 'Limite de Acuerdo al Impulso')}}
                            {{Form::input('date', 'fecha_limite_acuerdo_impulso', '', ['class' => 'form-control', 'placeholder' => 'Date']);}}
                        </div>
                    </div>

                    <div class="col-sm-6 col-md-4">
                        <div class="form-group">
                            {{Form::label('fecha_acuerdo_impulso', 'Fecha de Acuerdo al Impulso')}}
                            {{Form::input('date', 'fecha_acuerdo_impulso', '', ['class' => 'form-control', 'placeholder' => 'Date']);}}
                        </div>
                    </div>
                    
                </div>

                <div class="hidden">
                    <input type="text" name="id" id="id" value="{{$cliente->id}}"/>
                </div>


                <div id="form-btns-editar">
                    {{Form::submit('Aceptar', array('class'=>'btn btn-success', 'id'=>'btnActReclSin'))}}
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                </div>
                {{ Form::close() }}
            </div>

        </div>
    </div>
</div>

<div class="modal fade editarAcuerdoJ-modal" id="editarAcuerdoJ-modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="H1">Editar Acuerdo</h4>
            </div>
            <div class="modal-body">
                {{ Form::open(array('url' => 'sire/juridico/actualizar/acuerdo')) }}
                
                <div class="row">
                    <div class="col-sm-6 col-md-4">
                        <div class="form-group form-select" id="form-select">
                            {{Form::label('mes', 'Mes', array('aria-hidden'=>'true'))}}
                            <select class="form-control form-sin" name="mes" id="mes" required>
                                <option value="">Seleccione el Mes</option>
                                <option value="01">Enero</option>
                                <option value="02">Febrro</option>
                                <option value="03">Marzo</option>
                                <option value="04">Abril</option>
                                <option value="05">Mayo</option>
                                <option value="06">Junio</option>
                                <option value="07">Julio</option>
                                <option value="08">Agosto</option>
                                <option value="09">Septiembre</option>
                                <option value="10">Octubre</option>
                                <option value="11">Noviembre</option>
                                <option value="12">Diciembre</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-sm-6 col-md-4">
                        <div class="form-group form-select" id="form-select">
                            {{Form::label('año', 'Año', array('aria-hidden'=>'true'))}}
                            <select class="form-control form-sin" name="año" id="año" required>
                                <option value="">Seleccione el Año</option>
                                <option value="2008">2008</option>
                                <option value="2009">2009</option>
                                <option value="2010">2010</option>
                                <option value="2011">2011</option>
                                <option value="2012">2012</option>
                                <option value="2013">2013</option>
                                <option value="2014">2014</option>
                                <option value="2015">2015</option>
                                <option value="2016">2016</option>
                                <option value="2017">2017</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-12">
                        <div class="form-group">
                            {{Form::label('acuerdo', 'Acuerdo', array('aria-hidden'=>'true'))}}
                            {{Form::text('acuerdo', '',  array('class'=>'form-control form-sin', 'placeholder'=>'Acuerdo', 'autocomplete'=>'off', 'aria-label'=>'Acuerdo', 'required'))}}
                            
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-12">
                        <div class="form-group">
                            {{Form::label('detalle', 'Detalle', array('aria-hidden'=>'true'))}}
                            {{Form::text('detalle', '',  array('class'=>'form-control form-sin', 'placeholder'=>'Detalle', 'autocomplete'=>'off', 'aria-label'=>'Detalle', 'required'))}}
                            
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-4">
                        <div class="form-group">
                            {{Form::label('fecha_publicacion', 'Publicacion')}}
                            {{Form::input('date', 'fecha_publicacion', '', ['class' => 'form-control', 'placeholder' => 'Date']);}}
                        </div>
                    </div>

                    <div class="col-sm-6 col-md-4">
                        <div class="form-group">
                            {{Form::label('fecha_surte_efecto', 'Surte Efecto')}}
                            {{Form::input('date', 'fecha_surte_efecto', '', ['class' => 'form-control', 'placeholder' => 'Date']);}}
                        </div>
                    </div>

                    <div class="col-sm-6 col-md-4">
                        <div class="form-group">
                            {{Form::label('fecha_vencimiento_impulso', 'Vencimiento De Impulso')}}
                            {{Form::input('date', 'fecha_vencimiento_impulso', '', ['class' => 'form-control', 'placeholder' => 'Date']);}}
                        </div>
                    </div>

                    <div class="col-sm-6 col-md-4">
                        <div class="form-group">
                            {{Form::label('fecha_impulso', 'Impulso')}}
                            {{Form::input('date', 'fecha_impulso', '', ['class' => 'form-control', 'placeholder' => 'Date']);}}
                        </div>
                    </div>

                    <div class="col-sm-6 col-md-4">
                        <div class="form-group">
                            {{Form::label('fecha_limite_acuerdo_impulso', 'Limite de Acuerdo al Impulso')}}
                            {{Form::input('date', 'fecha_limite_acuerdo_impulso', '', ['class' => 'form-control', 'placeholder' => 'Date']);}}
                        </div>
                    </div>

                    <div class="col-sm-6 col-md-4">
                        <div class="form-group">
                            {{Form::label('fecha_acuerdo_impulso', 'Fecha de Acuerdo al Impulso')}}
                            {{Form::input('date', 'fecha_acuerdo_impulso', '', ['class' => 'form-control', 'placeholder' => 'Date']);}}
                        </div>
                    </div>
                    
                </div>

                <div class="hidden">
                    <input type="text" name="id" id="id" value=""/>
                </div>


                <div id="form-btns-editar">
                    {{Form::submit('Aceptar', array('class'=>'btn btn-success', 'id'=>'btnActReclSin'))}}
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                </div>
                {{ Form::close() }}
            </div>

        </div>
    </div>
</div>

@stop