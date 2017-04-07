@extends('layouts.master')

@section('title')
    Metas
@stop

@section('js')
    {{HTML::script('js/compromisos.js')}}
@stop

@section('contenido')

	<div class="container controles">
        <h2 aria-hidden="true"><a href="{{ url('sire') }}"><span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span></a>Metas de {{$mes."/".$año}} </h2> 
        <hr>
        <div class="well">
	        {{ Form::open(array('url' => 'sire/indicadores', 'method' => 'GET')) }}
                <div class="row">
                

                	<div class="col-sm-4">
                        <div class="form-group form-select">
                            <select class="form-control" name="mes" id="mes" >
		                        <option value="">Seleccione Mes</option>
		                        <option <?php if($mes == '01'){echo("selected");}?> value="01">Enero</option>
		                        <option <?php if($mes == '02'){echo("selected");}?> value="02">Febrero</option>
		                        <option <?php if($mes == '03'){echo("selected");}?> value="03">Marzo</option>
		                        <option <?php if($mes == '04'){echo("selected");}?> value="04">Abril</option>
		                        <option <?php if($mes == '05'){echo("selected");}?> value="05">Mayo</option>
		                        <option <?php if($mes == '06'){echo("selected");}?> value="06">Junio</option>
		                        <option <?php if($mes == '07'){echo("selected");}?> value="07">Julio</option>
		                        <option <?php if($mes == '08'){echo("selected");}?> value="08">Agosto</option>
		                        <option <?php if($mes == '09'){echo("selected");}?> value="09">Septiembre</option>
		                        <option <?php if($mes == '10'){echo("selected");}?> value="10">Octubre</option>
		                        <option <?php if($mes == '11'){echo("selected");}?> value="11">Noviembre</option>
		                        <option <?php if($mes == '12'){echo("selected");}?> value="12">Diciembre</option>
	                    	</select>
                        </div>
                    </div>

                    <div class="col-sm-2">
                        <div class="form-group form-select">
                            <select class="form-control" name="año" id="año" >
		                        <option <?php if($año == '2016'){echo("selected");}?> value="2016">2016</option>
		                        <option <?php if($año == '2017'){echo("selected");}?> value="2017">2017</option>
	                    	</select>
                        </div>
                    </div>

                    <div class="col-sm-4">
		                <div class="form-btns">
		                    {{Form::submit('Ver', array('class'=>'btn btn-success '))}}
		                </div>
                    </div>

                </div>
                
            {{ Form::close() }}
    	</div>


    </div>

    <div class="container">

		<div class="row">

			@if (Auth::user()->departamento == 'Direccion')

			<div id="tabla_indicadores" class="col-md-12">
			<table  class="table table-hover table-striped table-bordered" >
				<thead>
					<tr>
						<th>Indicador Critico</th>
						<th>Objetivo</th>
						<th># o %</th>
						<th>% de Cumplimiento</th>
						<th>Diferencia Objetivo</th>
						<th>Semana 1</th>
						<th>Semana 2</th>
						<th>Semana 3</th>
						<th>Semana 4</th>
					</tr>
				</thead>
				<tbody>

					<tr>
						<td data-title="">Citas agendadas</td>
						<td data-title="">@if ($ind_prom_count != 0) {{$ind_prom[6]->objetivo}} @endif </td>
						<td data-title="">
							@if ($ind_prom_count != 0) 
								{{$tic1 = $ind_prom[6]->semana1 + $ind_prom[6]->semana2 + $ind_prom[6]->semana3 + $ind_prom[6]->semana4 }} 
							@endif
						</td>
						<td data-title="">@if ($ind_prom_count != 0) {{ ($tic1/$ind_prom[6]->objetivo) * 100}} @endif</td>
						<td data-title="">@if ($ind_prom_count != 0) {{$ind_prom[6]->objetivo - $tic1 }} @endif</td>
						<td data-title="">@if ($ind_prom_count != 0) {{$ind_prom[6]->semana1}} @endif</td>
						<td data-title="">@if ($ind_prom_count != 0) {{$ind_prom[6]->semana2}} @endif</td>
						<td data-title="">@if ($ind_prom_count != 0) {{$ind_prom[6]->semana3}} @endif</td>
						<td data-title="">@if ($ind_prom_count != 0) {{$ind_prom[6]->semana4}} @endif</td>
					</tr>
					<tr>
						<td data-title="">Citas cerradas</td>
						<td data-title="">@if ($ind_prom_count != 0) {{$ind_prom[7]->objetivo}} @endif </td>
						<td data-title="">
							@if ($ind_prom_count != 0) 
								{{$tic2 = $ind_prom[7]->semana1 + $ind_prom[7]->semana2 + $ind_prom[7]->semana3 + $ind_prom[7]->semana4 }} 
							@endif
						</td>
						<td data-title="">@if ($ind_prom_count != 0) {{ ($tic2/$ind_prom[7]->objetivo) * 100}} @endif</td>
						<td data-title="">@if ($ind_prom_count != 0) {{$ind_prom[7]->objetivo - $tic2 }} @endif</td>
						<td data-title="">@if ($ind_prom_count != 0) {{$ind_prom[7]->semana1}} @endif</td>
						<td data-title="">@if ($ind_prom_count != 0) {{$ind_prom[7]->semana2}} @endif</td>
						<td data-title="">@if ($ind_prom_count != 0) {{$ind_prom[7]->semana3}} @endif</td>
						<td data-title="">@if ($ind_prom_count != 0) {{$ind_prom[7]->semana4}} @endif</td>
					</tr>
					<tr>
						<td data-title="">Días promedio fase de documentación</td>
						<td data-title=""> @if ($ind_recl_count != 0) {{$ind_recl[5]->objetivo}} @endif </td>
						<td data-title="">
							@if ($ind_recl_count != 0) 
								{{$tic3 = $ind_recl[5]->semana1 + $ind_recl[5]->semana2 + $ind_recl[5]->semana3 + $ind_recl[5]->semana4 }} 
							@endif
						</td>
						<td data-title="">@if ($ind_recl_count != 0) {{ ($tic3/$ind_recl[5]->objetivo) * 100}} @endif</td>
						<td data-title="">@if ($ind_recl_count != 0) {{$ind_recl[5]->objetivo - $tic3 }} @endif</td>
						<td data-title="">@if ($ind_recl_count != 0) {{$ind_recl[5]->semana1}} @endif</td>
						<td data-title="">@if ($ind_recl_count != 0) {{$ind_recl[5]->semana2}} @endif</td>
						<td data-title="">@if ($ind_recl_count != 0) {{$ind_recl[5]->semana3}} @endif</td>
						<td data-title="">@if ($ind_recl_count != 0) {{$ind_recl[5]->semana4}} @endif</td>
					</tr>

					<tr>
						<td data-title="">Casos cerrados y cobrados</td>
						<td data-title="">@if ($ind_cobr_count != 0) {{$ind_cobr[4]->objetivo}} @endif</td>
						<td data-title="">
							@if ($ind_cobr_count != 0) 
								{{$tic4 = $ind_cobr[4]->semana1 + $ind_cobr[4]->semana2 + $ind_cobr[4]->semana3 + $ind_cobr[4]->semana4 }} 
							@endif
						</td>
						<td data-title="">@if ($ind_cobr_count != 0) {{ ($tic4/$ind_cobr[4]->objetivo) * 100}} @endif</td>
						<td data-title="">@if ($ind_cobr_count != 0) {{$ind_cobr[4]->objetivo - $tic4 }} @endif</td>
						<td data-title="">@if ($ind_cobr_count != 0) {{$ind_cobr[4]->semana1}} @endif</td>
						<td data-title="">@if ($ind_cobr_count != 0) {{$ind_cobr[4]->semana2}} @endif</td>
						<td data-title="">@if ($ind_cobr_count != 0) {{$ind_cobr[4]->semana3}} @endif</td>
						<td data-title="">@if ($ind_cobr_count != 0) {{$ind_cobr[4]->semana4}} @endif</td>
					</tr>

					<tr>
						<td data-title="">% de acuerdos con impulso a tiempo</td>
						<td data-title=""> @if ($ind_jur_count != 0) {{$ind_jur[1]->objetivo}} @endif </td>
						<td data-title="">
							@if ($ind_jur_count != 0) 
								{{$tic5 = $ind_jur[1]->semana1 + $ind_jur[1]->semana2 + $ind_jur[1]->semana3 + $ind_jur[1]->semana4 }} 
							@endif
						</td>
						<td data-title="">@if ($ind_jur_count != 0) {{ ($tic5/$ind_jur[1]->objetivo) * 100}} @endif</td>
						<td data-title="">@if ($ind_jur_count != 0) {{$ind_jur[1]->objetivo - $tic5 }} @endif</td>
						<td data-title="">@if ($ind_jur_count != 0) {{$ind_jur[1]->semana1}} @endif</td>
						<td data-title="">@if ($ind_jur_count != 0) {{$ind_jur[1]->semana2}} @endif</td>
						<td data-title="">@if ($ind_jur_count != 0) {{$ind_jur[1]->semana3}} @endif</td>
						<td data-title="">@if ($ind_jur_count != 0) {{$ind_jur[1]->semana4}} @endif</td>
					</tr>


				</tbody>
			</table>
			</div>

			@endif

			@if ((Auth::user()->departamento == 'Direccion') || (Auth::user()->departamento == 'Promocion'))
			

			<div id="tabla_indicadores" class="col-md-12">
			<table  class="table table-hover table-striped table-bordered" >
				<thead>
					<tr>
						<th>PROMOCIÓN 
							@if ($ind_prom_count == 0)
								{{Form::button('Agregar Objetivos', array('class'=>'btnAddObjProm btn btn-success btn-xs', 'data-toggle' => 'modal', 'data-target'=>'#addObjProm-modal'))}}
							@endif

							@if (($ind_prom_count != 0) && (Auth::user()->departamento == 'Direccion'))
								{{Form::button('Editar Objetivos', array('class'=>'btnEditarObj btn btn-success btn-xs', 'data-toggle' => 'modal', 'data-target'=>'#editarObj-modal', 'data-id' => 2))}}
							@endif

							@if ($ind_prom_count != 0)
								{{Form::button('Agregar Cumplimiento', array('class'=>'btnAddCumplido btn btn-success btn-xs', 'data-toggle' => 'modal', 'data-target'=>'#addCumplido-modal', 'data-id' => 2))}}
							@endif

						</th>
						<th>Objetivo</th>
						<th># o %</th>
						<th>% de Cumplimiento</th>
						<th>Diferencia Objetivo</th>
						<th>Semana 1</th>
						<th>Semana 2</th>
						<th>Semana 3</th>
						<th>Semana 4</th>
					</tr>
				</thead>
				<tbody>

					@foreach($ind_prom as $ip)
						<tr>
							<td data-title="">{{$ip->indicador}}</td>
							<td data-title="">{{$ip->objetivo}}</td>
							<td data-title="">{{$totalp = $ip->semana1 + $ip->semana2 + $ip->semana3 + $ip->semana4}}</td>
							<td data-title="">@if ($ip->objetivo != 0){{($totalp/$ip->objetivo) * 100}}@endif
<span class="label label-danger"></span></td>
							<td data-title="">{{$ip->objetivo - $totalp}}</td>
							<td data-title="">{{$ip->semana1}}</td>
							<td data-title="">{{$ip->semana2}}</td>
							<td data-title="">{{$ip->semana3}}</td>
							<td data-title="">{{$ip->semana4}}</td>
						</tr>

					@endforeach 

				</tbody>
			</table>
			</div>

			@endif

			@if ((Auth::user()->departamento == 'Direccion') || (Auth::user()->departamento == 'Reclamacion'))

			<div id="tabla_indicadores" class="col-md-12">
			<table  class="table table-hover table-striped table-bordered" >
				<thead>
					<tr>
						<th>RECLAMACIÓN 
							@if ($ind_recl_count == 0)
								{{Form::button('Agregar Objetivos', array('class'=>'btnAddObjRecl btn btn-success btn-xs', 'data-toggle' => 'modal', 'data-target'=>'#addObjRecl-modal'))}}
							@endif

							@if (($ind_recl_count != 0) && (Auth::user()->departamento == 'Direccion'))
								{{Form::button('Editar Objetivos', array('class'=>'btnEditarObj btn btn-success btn-xs', 'data-toggle' => 'modal', 'data-target'=>'#editarObj-modal', 'data-id' => 3))}}
							@endif

							@if ($ind_recl_count != 0)
								{{Form::button('Agregar Cumplimiento', array('class'=>'btnAddCumplido btn btn-success btn-xs', 'data-toggle' => 'modal', 'data-target'=>'#addCumplido-modal', 'data-id' => 3))}}
							@endif

						</th>
						<th>Objetivo</th>
						<th># o %</th>
						<th>% de Cumplimiento</th>
						<th>Diferencia Objetivo</th>
						<th>Semana 1</th>
						<th>Semana 2</th>
						<th>Semana 3</th>
						<th>Semana 4</th>
					</tr>
				</thead>
				<tbody>

					@foreach($ind_recl as $ir)
						<tr>
							<td data-title="">{{$ir->indicador}}</td>
							<td data-title="">{{$ir->objetivo}}</td>
							<td data-title="">{{$totalr = $ir->semana1 + $ir->semana2 + $ir->semana3 + $ir->semana4}}</td>
							<td data-title="">{{($totalr/$ir->objetivo) * 100}}<span class="label label-danger"></span></td>
							<td data-title="">{{$ir->objetivo - $totalr}}</td>
							<td data-title="">{{$ir->semana1}}</td>
							<td data-title="">{{$ir->semana2}}</td>
							<td data-title="">{{$ir->semana3}}</td>
							<td data-title="">{{$ir->semana4}}</td>
						</tr>

					@endforeach 

				</tbody>
			</table>
			</div>

			@endif

			@if ((Auth::user()->departamento == 'Direccion') || (Auth::user()->departamento == 'Cobranza'))

			<div id="tabla_indicadores" class="col-md-12">
			<table  class="table table-hover table-striped table-bordered" >
				<thead>
					<tr>
						<th>COBRANZA 
							@if ($ind_cobr_count == 0)
								{{Form::button('Agregar Objetivos', array('class'=>'btnAddObjCobr btn btn-success btn-xs', 'data-toggle' => 'modal', 'data-target'=>'#addObjCobr-modal'))}}
							@endif

							@if (($ind_cobr_count != 0) && (Auth::user()->departamento == 'Direccion'))
								{{Form::button('Editar Objetivos', array('class'=>'btnEditarObj btn btn-success btn-xs', 'data-toggle' => 'modal', 'data-target'=>'#editarObj-modal', 'data-id' => 4))}}
							@endif

							@if ($ind_cobr_count != 0)
								{{Form::button('Agregar Cumplimiento', array('class'=>'btnAddCumplido btn btn-success btn-xs', 'data-toggle' => 'modal', 'data-target'=>'#addCumplido-modal', 'data-id' => 4))}}
							@endif

						</th>
						<th>Objetivo</th>
						<th># o %</th>
						<th>% de Cumplimiento</th>
						<th>Diferencia Objetivo</th>
						<th>Semana 1</th>
						<th>Semana 2</th>
						<th>Semana 3</th>
						<th>Semana 4</th>
					</tr>
				</thead>
				<tbody>
					@foreach($ind_cobr as $ic)
						<tr>
							<td data-title="">{{$ic->indicador}}</td>
							<td data-title="">{{$ic->objetivo}}</td>
							<td data-title="">
								<?php if ($ic->id_indicador == 18){
										$num = 0;
										if ($ic->semana1 > 0 || $ic->semana1 != null) {
											$num = $num + 1;
										}
										if ($ic->semana2 > 0 || $ic->semana2 != null) {
											$num = $num+1;
										}
										if ($ic->semana3 > 0 || $ic->semana3 != null) {
											$num = $num+1;
										}
										if ($ic->semana4 > 0 || $ic->semana4 != null) {
											$num = $num+1;
										}
										if ($num>0) {
											echo $totalc = ($ic->semana1 + $ic->semana2 + $ic->semana3 + $ic->semana4)/$num;
										}
										else
										{
											echo $totalc = $ic->semana1 + $ic->semana2 + $ic->semana3 + $ic->semana4;
										}
									}
									else{
										echo $totalc = $ic->semana1 + $ic->semana2 + $ic->semana3 + $ic->semana4;
									}
								?>
							</td>
							<td data-title=""><?php if($ic->objetivo > 0){ echo ($totalc/$ic->objetivo) * 100;} ?><span class="label label-danger"></span></td>
							<td data-title="">{{$ic->objetivo - $totalc}}</td>
							<td data-title="">{{$ic->semana1}}</td>
							<td data-title="">{{$ic->semana2}}</td>
							<td data-title="">{{$ic->semana3}}</td>
							<td data-title="">{{$ic->semana4}}</td>
						</tr>

					@endforeach 
				</tbody>
			</table>
			</div>

			@endif

			@if ((Auth::user()->departamento == 'Direccion') || (Auth::user()->departamento == 'Juridico'))

			<div id="tabla_indicadores" class="col-md-12">
			<table  class="table table-hover table-striped table-bordered" >
				<thead>
					<tr>
						<th>JURÍDICO 
							@if ($ind_jur_count == 0)
								{{Form::button('Agregar Objetivos', array('class'=>'btnAddObjJur btn btn-success btn-xs', 'data-toggle' => 'modal', 'data-target'=>'#addObjJur-modal'))}}
							@endif

							@if (($ind_jur_count != 0) && (Auth::user()->departamento == 'Direccion'))
								{{Form::button('Editar Objetivos', array('class'=>'btnEditarObj btn btn-success btn-xs', 'data-toggle' => 'modal', 'data-target'=>'#editarObj-modal', 'data-id' => 5))}}
							@endif

							@if ($ind_jur_count != 0)
								{{Form::button('Agregar Cumplimiento', array('class'=>'btnAddCumplido btn btn-success btn-xs', 'data-toggle' => 'modal', 'data-target'=>'#addCumplido-modal', 'data-id' => 5))}}
							@endif

						</th>
						<th>Objetivo</th>
						<th># o %</th>
						<th>% de Cumplimiento</th>
						<th>Diferencia Objetivo</th>
						<th>Semana 1</th>
						<th>Semana 2</th>
						<th>Semana 3</th>
						<th>Semana 4</th>
					</tr>
				</thead>
				<tbody>

					@foreach($ind_jur as $ij)
					<?php $num = 0;
						if ($ij->semana1 > 0 || $ij->semana1 != null) {
							$num = $num + 1;
						}
						if ($ij->semana2 > 0 || $ij->semana2 != null) {
							$num = $num+1;
						}
						if ($ij->semana3 > 0 || $ij->semana3 != null) {
							$num = $num+1;
						}
						if ($ij->semana4 > 0 || $ij->semana4 != null) {
							$num = $num+1;
						}
					 ?>
						<tr>
							<td data-title="">{{$ij->indicador}}</td>
							<td data-title="">{{$ij->objetivo}}</td>
							<td data-title=""> <?php if ($num>0) {
								echo $totalj = ($ij->semana1 + $ij->semana2 + $ij->semana3 + $ij->semana4)/$num;
							}
							else echo $totalj = $ij->semana1 + $ij->semana2 + $ij->semana3 + $ij->semana4; ?> </td>
							<td data-title="">{{($totalj/$ij->objetivo) * 100}}<span class="label label-danger"></span></td>
							<td data-title="">{{$ij->objetivo - $totalj}}</td>
							<td data-title="">{{$ij->semana1}}</td>
							<td data-title="">{{$ij->semana2}}</td>
							<td data-title="">{{$ij->semana3}}</td>
							<td data-title="">{{$ij->semana4}}</td>
						</tr>

					@endforeach 

				</tbody>
			</table>
			</div>

			@endif

		</div>
	</div>

@stop

@section('modals')

		<div class="modal fade addObjProm-modal" id="addObjProm-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <h4 class="modal-title" id="H1">Agregar Objetivos a Promoción</h4>
                    </div>
                    <div class="modal-body">
            
                        <div class="row">


						{{ Form::open(array('url' => 'sire/indicadores/agregarobj')) }}
						@foreach($indprom as $indp)

							<div class="col-md-12">
								<div class="form-group">
									<label for="objetivo" class="col-sm-4 control-label">{{$indp->indicador}}</label>
									<div class="col-sm-1">
										<input type="text" class="form-control" id="objetivo" name="objetivo[]" placeholder="" required>
									</div>
								</div>
								

							</div>
							<div class="hidden">
					    		<input type="text" name="id_indicador[]" id="id_indicador" value="{{$indp->id}}"/>
					    		<input type="text" name="mes[]" id="mes" value="{{$mes}}"/>
					    		<input type="text" name="año[]" id="año" value="{{$año}}"/>
					    		
	                    	</div>

						@endforeach 



							<div class="col-md-4 form-btns">
							    {{Form::submit('Guardar', array('class'=>'btn btn-success', 'id'=>''))}}
							    {{Form::reset('Cancelar', array('class'=>'btn btn-default', 'data-dismiss'=> 'modal'))}}
							</div>

						{{ Form::close() }}
                        </div>      
        
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade addObjRecl-modal" id="addObjRecl-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <h4 class="modal-title" id="H1">Agregar Objetivos a Reclamacion</h4>
                    </div>
                    <div class="modal-body">
            
                        <div class="row">


						{{ Form::open(array('url' => 'sire/indicadores/agregarobj')) }}
						@foreach($indrecl as $indr)

							<div class="col-md-12">
								<div class="form-group">
									<label for="objetivo" class="col-sm-4 control-label">{{$indr->indicador}}</label>
									<div class="col-sm-1">
										<input type="text" class="form-control" id="objetivo" name="objetivo[]" placeholder="" required>
									</div>
								</div>
								

							</div>
							<div class="hidden">
					    		<input type="text" name="id_indicador[]" id="id_indicador" value="{{$indr->id}}"/>
					    		<input type="text" name="mes[]" id="mes" value="{{$mes}}"/>
					    		<input type="text" name="año[]" id="año" value="{{$año}}"/>
					    		
	                    	</div>

						@endforeach 



							<div class="col-md-4 form-btns">
							    {{Form::submit('Guardar', array('class'=>'btn btn-success', 'id'=>''))}}
							    {{Form::reset('Cancelar', array('class'=>'btn btn-default', 'data-dismiss'=> 'modal'))}}
							</div>

						{{ Form::close() }}
                        </div>      
        
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade addObjCobr-modal" id="addObjCobr-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <h4 class="modal-title" id="H1">Agregar Objetivos a Cobranza</h4>
                    </div>
                    <div class="modal-body">
            
                        <div class="row">


						{{ Form::open(array('url' => 'sire/indicadores/agregarobj')) }}
						@foreach($indcobr as $indc)

							<div class="col-md-12">
								<div class="form-group">
									<label for="objetivo" class="col-sm-4 control-label">{{$indc->indicador}}</label>
									<div class="col-sm-1">
										<input type="text" class="form-control" id="objetivo" name="objetivo[]" placeholder="" required>
									</div>
								</div>
								

							</div>
							<div class="hidden">
					    		<input type="text" name="id_indicador[]" id="id_indicador" value="{{$indc->id}}"/>
					    		<input type="text" name="mes[]" id="mes" value="{{$mes}}"/>
					    		<input type="text" name="año[]" id="año" value="{{$año}}"/>
					    		
	                    	</div>

						@endforeach 



							<div class="col-md-4 form-btns">
							    {{Form::submit('Guardar', array('class'=>'btn btn-success', 'id'=>''))}}
							    {{Form::reset('Cancelar', array('class'=>'btn btn-default', 'data-dismiss'=> 'modal'))}}
							</div>

						{{ Form::close() }}
                        </div>      
        
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade addObjJur-modal" id="addObjJur-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <h4 class="modal-title" id="H1">Agregar Objetivos a Juridico</h4>
                    </div>
                    <div class="modal-body">
            
                        <div class="row">


						{{ Form::open(array('url' => 'sire/indicadores/agregarobj')) }}
						@foreach($indjur as $indj)

							<div class="col-md-12">
								<div class="form-group">
									<label for="objetivo" class="col-sm-4 control-label">{{$indj->indicador}}</label>
									<div class="col-sm-1">
										<input type="text" class="form-control" id="objetivo" name="objetivo[]" placeholder="" required>
									</div>
								</div>
								

							</div>
							<div class="hidden">
					    		<input type="text" name="id_indicador[]" id="id_indicador" value="{{$indj->id}}"/>
					    		<input type="text" name="mes[]" id="mes" value="{{$mes}}"/>
					    		<input type="text" name="año[]" id="año" value="{{$año}}"/>
					    		
	                    	</div>

						@endforeach 



							<div class="col-md-4 form-btns">
							    {{Form::submit('Guardar', array('class'=>'btn btn-success', 'id'=>''))}}
							    {{Form::reset('Cancelar', array('class'=>'btn btn-default', 'data-dismiss'=> 'modal'))}}
							</div>

						{{ Form::close() }}
                        </div>      
        
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade editarObj-modal" id="editarObj-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <h4 class="modal-title" id="H1">Editar Objetivos de <span class="nom_dpto"></span></h4>
                    </div>
                    <div class="modal-body">
            
                        <div class="row">


						{{ Form::open(array('url' => 'sire/indicadores/editarobjpost')) }}

						<div class="objdpto" id="objdpto">
						</div>
						<div class="hidden">
						<input type="text" name="mes" id="mes" value="{{$mes}}"/>
						<input type="text" name="año" id="año" value="{{$año}}"/>

						</div>

						<div class="col-md-4 form-btns">
						    {{Form::submit('Guardar', array('class'=>'btn btn-success', 'id'=>''))}}
						    {{Form::reset('Cancelar', array('class'=>'btn btn-default', 'data-dismiss'=> 'modal'))}}
						</div>

						{{ Form::close() }}
                        </div>      
        
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade addCumplido-modal" id="addCumplido-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <h4 class="modal-title" id="H1">Agregar Cumplidos de <span class="nom_dpto_c"></span></h4>
                    </div>
                    <div class="modal-body">
            
                        <div class="row">


						{{ Form::open(array('url' => 'sire/indicadores/addcumplido')) }}

						<div class="cumplidodpo" id="cumplidodpo">
						</div>
						<div class="hidden">
						<input type="text" name="mes" id="mes" value="{{$mes}}"/>
						<input type="text" name="año" id="año" value="{{$año}}"/>

						</div>

						<div class="col-md-4 form-btns">
						    {{Form::submit('Guardar', array('class'=>'btn btn-success', 'id'=>''))}}
						    {{Form::reset('Cancelar', array('class'=>'btn btn-default', 'data-dismiss'=> 'modal'))}}
						</div>

						{{ Form::close() }}
                        </div>      
        
                    </div>
                </div>
            </div>
        </div>


        


@stop


