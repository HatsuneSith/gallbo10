@extends('layouts.master')

@section('title')
    Tablero de Seguimientos
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
			<h2 aria-hidden="true"><a href="{{ url('sire/juridico') }}"><span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span></a>Tablero de Seguimiento <img src="/img/logo_gallbo.png" alt="Gallbo"  align="right" class="img-responsive" style="max-height: 50px;"></h2> 
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
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
						</tr>
						<tr>
							<td>Febrero</td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
						</tr>
						<tr>
							<td>Marzo</td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
						</tr>
						<tr>
							<td>Abril</td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
						</tr>
						<tr>
							<td>Mayo</td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
						</tr>
						<tr>
							<td>Junio</td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
						</tr>
						<tr>
							<td>Julio</td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
						</tr>
						<tr>
							<td>Agosto</td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
						</tr>
						<tr>
							<td>Septiembre</td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
						</tr>
						<tr>
							<td>Octubre</td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
						</tr>
						<tr>
							<td>Noviembre</td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
						</tr>
						<tr>
							<td>Diciembre</td>
							<td></td>
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
@stop

@section('modals')


@stop


