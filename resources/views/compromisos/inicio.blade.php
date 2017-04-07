@extends('layouts.master')

@section('title')
    Compromisos
@stop

@section('js')
    {{HTML::script('js/compromisos.js')}}
@stop

@section('contenido')

		<?php 
			Session::put('responsable', Input::get('responsable'));
		?>


	<div class="row">
		<h2 aria-hidden="true"><a href="{{ url('sire') }}"><span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span></a>Compromisos</h2>
		
		<hr>
		<div class="col-md-12">


			
            <div class="well">
            	@if(Session::get('infoCompromiso'))
                <div class="alert alert-success" >
                    {{Session::get('infoCompromiso')}}
					<script type="text/javascript">
						$(document).ready(function(){
							$("#addTareaMust-modal").modal({
								show: true,
								backdrop: 'static',
								keyboard: false
							});
						});
					</script>
                </div>
                @endif
                @if(Session::get('infoTarea'))
                <div class="alert alert-success" >
                    {{Session::get('infoTarea')}}
                </div>
                <script type="text/javascript">
					$(document).ready(function(){
						$("#avisoAddOtraTarea-modal").modal('show');
					});
				</script>
                @endif
                @if(Session::get('infoEditado'))
                <div class="alert alert-success" >
                    {{Session::get('infoEditado')}}
                </div>
                @endif
                @if(Session::get('danger'))
                <div class="alert alert-danger" >
                    {{Session::get('danger')}}
                </div>
                @endif

                {{ Form::open(array('url' => 'sire/compromisos/crear')) }}
                <div class="row">

                	@if (Auth::user()->rol == 'Directivo')
	                	<div class="col-md-12">
	                        <div class="form-group form-select" id="form-select">
	                            {{Form::label('id_responsable', 'Responsable', array('aria-hidden'=>'true'))}}
	                            
	                            <select class="form-control" name="responsable" id="responsable" autofocus>
	                                <option value="">Seleccione un Responsable</option>
	                                @foreach($usuarios as $usuario)
	                                    <option value="{{$usuario->id}}">{{$usuario->nombre.' '.$usuario->apellido}}</option>
	                                @endforeach 
	                            </select>
	                            
	                        </div>
	                        @if( $errors->has('responsable') )
	                            <div class="alert alert-danger">
	                            @foreach($errors->get('responsable') as $error )
	                                {{ $error }}<br>
	                            @endforeach
	                            </div>
	                        @endif
	                    </div>   
                    @endif            
                    

                    <div class="col-md-12 form-tarea">
                        <div class="form-group">
                            {{Form::label('compromiso', 'Compromiso', array('aria-hidden'=>'true'))}}
                            {{Form::textarea('compromiso', Input::old('compromiso'), array('class'=>'form-control', 'rows'=>3, 'placeholder'=>'Descripcion del Compromiso', 'autocomplete'=>'off', 'aria-label'=>'descripcion del Compromiso'))}}
                            
                        </div>
                        @if( $errors->has('compromiso') )
                            <div class="alert alert-danger">
                            @foreach($errors->get('compromiso') as $error )
                                {{ $error }}<br>
                            @endforeach
                            </div>
                        @endif
                    </div>

                    <div class="col-md-4 form-dia">
                        <div class="form-group">
                        {{Form::label('dia', 'Fecha Dia', array('aria-hidden'=>'true'))}}
                        {{Form::text('dia', Input::old('dia'), array('class'=>'form-control', 'placeholder' => 'Dia', 'autocomplete'=>'off', 'aria-label'=>'Fecha Dia'))}}
                        </div>
                        @if( $errors->has('dia') )
                            <div class="alert alert-danger">
                            @foreach($errors->get('dia') as $error )
                                {{ $error }}<br>
                            @endforeach
                            </div>
                        @endif
                    </div>

                    <div class="col-md-4 form-mes">
                        <div class="form-group formmes" id="formmes">
                            {{Form::label('mes', 'Fecha Mes', array('aria-hidden'=>'true'))}}
                            <select class="form-control" name="mes" id="mes">
                              <option <?php if($mes_actual == '01'){echo("selected");}?> value="01">Enero</option>
                              <option <?php if($mes_actual == '02'){echo("selected");}?> value="02">Febrero</option>
                              <option <?php if($mes_actual == '03'){echo("selected");}?> value="03">Marzo</option>
                              <option <?php if($mes_actual == '04'){echo("selected");}?> value="04">Abril</option>
                              <option <?php if($mes_actual == '05'){echo("selected");}?> value="05">Mayo</option>
                              <option <?php if($mes_actual == '06'){echo("selected");}?> value="06">Junio</option>
                              <option <?php if($mes_actual == '07'){echo("selected");}?> value="07">Julio</option>
                              <option <?php if($mes_actual == '08'){echo("selected");}?> value="08">Agosto</option>
                              <option <?php if($mes_actual == '09'){echo("selected");}?> value="09">Septiembre</option>
                              <option <?php if($mes_actual == '10'){echo("selected");}?> value="10">Octubre</option>
                              <option <?php if($mes_actual == '11'){echo("selected");}?> value="11">Noviembre</option>
                              <option <?php if($mes_actual == '12'){echo("selected");}?> value="12">Diciembre</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4 form-año">
                        <div class="form-group formaño" id="formaño">
                            {{Form::label('año', 'Fecha Año', array('aria-hidden'=>'true'))}}
                            <select class="form-control" name="año" id="año">
                                <option value="{{$año_actual}}">{{$año_actual}}</option>
                                <option value="{{$año_actual+1}}">{{$año_actual+1}}</option>
                                <option value="{{$año_actual+2}}">{{$año_actual+2   }}</option>
                            </select>
                        </div>
                    </div>
                    

                    <div class="hidden">
                    	@if (Auth::user()->rol != 'Directivo')
                    		{{Form::text('responsable', Auth::user()->id)}}
                    	@endif
                        
                        {{Form::text('cumplido', 'No')}}
                    </div>

                </div>
                <div class="form-btns">
                    {{Form::submit('Guardar', array('class'=>'btn btn-success btnSubmit', 'id'=>'btnSubmit'))}}
                    {{Form::reset('Cancelar', array('class'=>'btn btn-default'))}}
                </div>
                
                {{ Form::close() }}
            </div>
        </div>

		@if (Auth::user()->rol == 'Directivo')
	        <div class="col-md-12">
	            <div class="well">
	                {{ Form::open(array('url' => 'sire/compromisos', 'method' => 'GET')) }}
	                <div class="row">
	          
	                	<div class="col-sm-4">
	                        <div class="form-group form-select">
	                            <select class="form-control" name="responsable" id="responsable" >
	                                <option value="">Seleccione un Responsable</option>
	                                @foreach($usuarios as $usuario)
	                                    <option <?php if($responsable == $usuario->id){echo("selected");}?>  value="{{$usuario->id}}">{{$usuario->nombre.' '.$usuario->apellido}}</option>
	                                @endforeach 
	                                <option value="">Todos</option>
	                            </select>
	                        </div>
	                    </div>
	                	
	                	<div class="col-sm-4">
			                <div class="form-btns">
			                    {{Form::submit('Buscar', array('class'=>'btn btn-success '))}}
			                    {{HTML::link( 'sire/compromisos' , 'Ver Todas', ['class' => 'btn btn-primary', 'role' => 'button']) }}
			                </div>
		                </div>
	                </div>
	                
	                {{ Form::close() }}
	            </div>
	        </div>
        @endif



        <div id="tabla_tareas" class="col-md-12">
		<h4><span class="label label-success">Ahora Aparecen Los Compromisos Mas Nuevos Primero!!</span></h4>
		<table  class="table table-hover table-striped table-bordered" >
			<thead>
				<tr>
					<th>Id</th>
					<th>Compromiso</th>
					<th>Fecha</th>
					<th>Cumplido</th>
					<th>Opciones</th>
				</tr>
			</thead>
			<tbody>
				@foreach($compromisos as $compromiso)
				<tr>
					<?php 
					$fecha = new DateTime($compromiso->fecha);
					$fecha2 = date_format($fecha, 'd-m-Y');
					$elemento = explode("-", $fecha2);
					$dia= $elemento[0];
					$año = $elemento[2];
					if ($elemento[1] == '01') {$mes = "Enero";}
					elseif ($elemento[1] == '02') {$mes = "Febrero";}
					elseif ($elemento[1] == '03') {$mes = "Marzo";}
					elseif ($elemento[1] == '04') {$mes = "Abril";}
					elseif ($elemento[1] == '05') {$mes = "Mayo";}
					elseif ($elemento[1] == '06') {$mes = "Junio";}
					elseif ($elemento[1] == '07') {$mes = "Julio";}
					elseif ($elemento[1] == '08') {$mes = "Agosto";}
					elseif ($elemento[1] == '09') {$mes = "Septiembre";}
					elseif ($elemento[1] == '10') {$mes = "Octubre";}
					elseif ($elemento[1] == '11') {$mes = "Noviembre";}
					elseif ($elemento[1] == '12') {$mes = "Diciembre";}
					?>
					<td data-title="Id">{{$compromiso->id}}</td>
					<td data-title="Compromiso">{{$compromiso->compromiso}}</td>
					

					<td data-title="Fecha">{{$dia. " de " . $mes. " del " . $año}}</td>
					<td data-title="Cumplido">{{$compromiso->cumplido}}</td>
					
					
					<td data-title="Opciones">

						
						@if (Auth::user()->rol == 'Directivo')
							{{Form::button('Editar ', array('class'=>'btnEditarCompromiso btn btn-success btn-xs', 'data-toggle' => 'modal', 'data-target'=>'#editarCompromiso-modal', 'data-id' => $compromiso->id))}}
						@endif
						

						{{Form::button('Agregar Tarea', array('class'=>'btnAddTareaCompromiso btn btn-success btn-xs', 'data-toggle' => 'modal', 'data-target'=>'#addTarea-modal', 'data-backdrop' => 'static', 'data-keyboard' => 'false', 'data-id' => $compromiso->id))}}

						{{Form::button('Tareas Relacionadas', array('class'=>'btnListaTareasCompromisos btn btn-success btn-xs', 'data-toggle' => 'modal', 'data-target'=>'#listaTarea-modal', 'data-id' => $compromiso->id))}}
						
					</td>
					
				</tr>
				@endforeach
			</tbody>
		</table>
		</div>
		<?php echo $compromisos->appends(array('responsable'=>$responsable))->links(); ?>

	</div>

@stop

@section('modals')

		<div class="modal fade addTarea-modal" id="addTarea-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <h4 class="modal-title" id="H1">Agregar Tarea a Compromiso</h4>
                    </div>
                    <div class="modal-body">
            
                        <div class="row">


						{{ Form::open(array('url' => 'sire/compromisos/creartarea')) }}

							<div class="col-md-12">
		                        <div class="form-group form-select" id="form-select">
		                            {{Form::label('id_responsable', 'Responsable', array('aria-hidden'=>'true'))}}
		                            
		                            <select class="form-control" name="id_responsable" id="id_responsable" autofocus required>
		                                <option value="">Seleccione un Responsable</option>
		                                @foreach($asignados as $asignado)
		                                    <option <?php if(Input::old('id_responsable') == $asignado->id){echo("selected");}?>  value="{{$asignado->id}}">{{$asignado->nombre.' '.$asignado->apellido}}</option>
		                                @endforeach 
		                            </select>
		                            
		                        </div>
		                        @if( $errors->has('id_responsable') )
		                            <div class="alert alert-danger">
		                            @foreach($errors->get('id_responsable') as $error )
		                                {{ $error }}<br>
		                            @endforeach
		                            </div>
		                        @endif
		                    </div>

						    <div class="col-md-12 form-tarea">
						        <div class="form-group">
						            {{Form::label('tarea', 'Tarea', array('aria-hidden'=>'true'))}}
						            {{Form::textarea('tarea', Input::old('tarea'), array('class'=>'form-control', 'rows'=>3, 'placeholder'=>'Descripcion de la tarea', 'autocomplete'=>'off', 'aria-label'=>'descripcion de la tarea', 'required' =>'required'))}}
						            
						        </div>
						        @if( $errors->has('tarea') )
						            <div class="alert alert-danger">
						            @foreach($errors->get('tarea') as $error )
						                {{ $error }}<br>
						            @endforeach
						            </div>
						        @endif
						    </div>

						    <div class="col-md-4 form-dia">
						        <div class="form-group">
						        {{Form::label('dia', 'Fecha Dia', array('aria-hidden'=>'true'))}}
						        {{Form::text('dia', Input::old('dia'), array('class'=>'form-control', 'placeholder' => 'Dia', 'autocomplete'=>'off', 'aria-label'=>'Fecha Dia', 'required' =>'required'))}}
						        </div>
						        @if( $errors->has('dia') )
						            <div class="alert alert-danger">
						            @foreach($errors->get('dia') as $error )
						                {{ $error }}<br>
						            @endforeach
						            </div>
						        @endif
						    </div>

						    <div class="col-md-4 form-mes">
						        <div class="form-group formmes" id="formmes">
						            {{Form::label('mes', 'Fecha Mes', array('aria-hidden'=>'true'))}}
						            <select class="form-control" name="mes" id="mes">
						              <option <?php if($mes_actual == '01'){echo("selected");}?> value="01">Enero</option>
						              <option <?php if($mes_actual == '02'){echo("selected");}?> value="02">Febrero</option>
						              <option <?php if($mes_actual == '03'){echo("selected");}?> value="03">Marzo</option>
						              <option <?php if($mes_actual == '04'){echo("selected");}?> value="04">Abril</option>
						              <option <?php if($mes_actual == '05'){echo("selected");}?> value="05">Mayo</option>
						              <option <?php if($mes_actual == '06'){echo("selected");}?> value="06">Junio</option>
						              <option <?php if($mes_actual == '07'){echo("selected");}?> value="07">Julio</option>
						              <option <?php if($mes_actual == '08'){echo("selected");}?> value="08">Agosto</option>
						              <option <?php if($mes_actual == '09'){echo("selected");}?> value="09">Septiembre</option>
						              <option <?php if($mes_actual == '10'){echo("selected");}?> value="10">Octubre</option>
						              <option <?php if($mes_actual == '11'){echo("selected");}?> value="11">Noviembre</option>
						              <option <?php if($mes_actual == '12'){echo("selected");}?> value="12">Diciembre</option>
						            </select>
						        </div>
						    </div>
						    <div class="col-md-4 form-año">
						        <div class="form-group formaño" id="formaño">
						            {{Form::label('año', 'Fecha Año', array('aria-hidden'=>'true'))}}
						            <select class="form-control" name="año" id="año">
						                <option value="{{$año_actual}}">{{$año_actual}}</option>
						                <option value="{{$año_actual+1}}">{{$año_actual+1}}</option>
						                <option value="{{$año_actual+2}}">{{$año_actual+2   }}</option>
						            </select>
						        </div>
						    </div>

						    <div class="hidden">
						    	
						    	<input type="text" name="id_compromiso" id="id_compromiso" value=""/>
		                        {{Form::text('estado', 'Sin Ver', array('id'=>'estado'))}}
		                        {{Form::text('indicador', 'Amarillo', array('id'=>'indicador'))}}
		                        {{Form::text('id_asignador', Auth::user()->id)}}
		                        {{Form::text('nombre_asignador', Auth::user()->nombre.' '.Auth::user()->apellido)}}
		                    </div>

							<div class="col-md-12 form-btns">
							    {{Form::submit('Guardar', array('class'=>'btn btn-success btnSubmit', 'id'=>'btnSubmit'))}}
							    {{Form::reset('Cancelar', array('class'=>'btn btn-default', 'data-dismiss'=> 'modal'))}}
							</div>

						{{ Form::close() }}
                        </div>      
        
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade listaTarea-modal" id="listaTarea-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <h4 class="modal-title" id="H1">Tareas Relacionadas con compromiso</h4>
                    </div>
                    <div class="modal-body">
            
                        <div class="row">

							<div id="tabla_tareas" class="col-md-12 tabla_tareas">

							</div>

                        </div>      
        
                    </div>
                </div>
            </div>
        </div>


        <div class="modal fade editarCompromiso-modal" id="editarCompromiso-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <h4 class="modal-title" id="H1">Agregar Tarea a Compromiso</h4>
                    </div>
                    <div class="modal-body">
            
                        <div class="row">


						{{ Form::open(array('url' => 'sire/compromisos/editar')) }}
          
						    <div class="col-md-12 form-tarea">
		                        <div class="form-group">
		                            {{Form::label('compromiso', 'Compromiso', array('aria-hidden'=>'true'))}}
		                            {{Form::textarea('compromiso', Input::old('compromiso'), array('class'=>'form-control', 'rows'=>3, 'placeholder'=>'Descripcion del Compromiso', 'autocomplete'=>'off', 'aria-label'=>'descripcion del Compromiso'))}}
		                            
		                        </div>
		                        @if( $errors->has('compromiso') )
		                            <div class="alert alert-danger">
		                            @foreach($errors->get('compromiso') as $error )
		                                {{ $error }}<br>
		                            @endforeach
		                            </div>
		                        @endif
		                    </div>

						    <div class="hidden">
						    	
						    	<input type="text" name="id_compromiso" id="id_compromiso" value=""/>

		                    </div>
							<div class="col-md-4 form-btns">
							    {{Form::submit('Guardar', array('class'=>'btn btn-success btnSubmit', 'id'=>'btnSubmit'))}}
							    {{Form::reset('Cancelar', array('class'=>'btn btn-default', 'data-dismiss'=> 'modal'))}}
							</div>

						{{ Form::close() }}
                        </div>      
        
                    </div>
                </div>
            </div>
        </div>

		<!-- Modal -->
		<div class="modal fade" id="avisoAddTarea-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h4 class="modal-title" id="myModalLabel">Comprimiso Agregado Correctamente!</h4>
					</div>
					<div class="modal-body">
						<h5>Todos los compromisos deben de contar con almenos una tarea para que estos puedan ser concluidos</h5>
						<h4>Desea agregar una tarea en este momento?</h4>
					</div>
					<div class="modal-footer">
						{{Form::button('Agregar Tarea', array('class'=>'btnAddTareaCompromiso btn btn-success', 'data-toggle' => 'modal', 'data-target'=>'#addTarea-modal', 'data-id' => Session::get('lastCompromisoID'), 'data-dismiss'=>"modal"))}}
						<button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
					</div>
				</div>
			</div>
		</div>

		<!-- Modal -->
		<div class="modal fade" id="avisoAddOtraTarea-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h4 class="modal-title" id="myModalLabel">Tarea Agregada Correctamente!</h4>
					</div>
					<div class="modal-body">
						<h5>La tarea fue agregada al compromiso correctamente</h5>
						<h4>Desea agregar otra tarea al mismo compromiso?</h4>
					</div>
					<div class="modal-footer">
						{{Form::button('Agregar Tarea', array('class'=>'btnAddTareaCompromiso btn btn-success', 'data-toggle' => 'modal', 'data-target'=>'#addTarea-modal', 'data-id' => Session::get('lastCompromisoID'), 'data-dismiss'=>"modal"))}}
						<button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
					</div>
				</div>
			</div>
		</div>

		<div class="modal fade addTareaMust-modal" id="addTareaMust-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="H1">Agregar Tarea a Compromiso <small><span class="label label-danger">Debes agregar por lo menos una tarea</span></small></h4>
                    </div>
                    <div class="modal-body">
            
                        <div class="row">


						{{ Form::open(array('url' => 'sire/compromisos/creartarea')) }}

							<div class="col-md-12">
		                        <div class="form-group form-select" id="form-select">
		                            {{Form::label('id_responsable', 'Responsable', array('aria-hidden'=>'true'))}}
		                            
		                            <select class="form-control" name="id_responsable" id="id_responsable" autofocus required>
		                                <option value="">Seleccione un Responsable</option>
		                                @foreach($asignados as $asignado)
		                                    <option <?php if(Input::old('id_responsable') == $asignado->id){echo("selected");}?>  value="{{$asignado->id}}">{{$asignado->nombre.' '.$asignado->apellido}}</option>
		                                @endforeach 
		                            </select>
		                            
		                        </div>
		                        @if( $errors->has('id_responsable') )
		                            <div class="alert alert-danger">
		                            @foreach($errors->get('id_responsable') as $error )
		                                {{ $error }}<br>
		                            @endforeach
		                            </div>
		                        @endif
		                    </div>

						    <div class="col-md-12 form-tarea">
						        <div class="form-group">
						            {{Form::label('tarea', 'Tarea', array('aria-hidden'=>'true'))}}
						            {{Form::textarea('tarea', Input::old('tarea'), array('class'=>'form-control', 'rows'=>3, 'placeholder'=>'Descripcion de la tarea', 'autocomplete'=>'off', 'aria-label'=>'descripcion de la tarea', 'required' =>'required'))}}
						            
						        </div>
						        @if( $errors->has('tarea') )
						            <div class="alert alert-danger">
						            @foreach($errors->get('tarea') as $error )
						                {{ $error }}<br>
						            @endforeach
						            </div>
						        @endif
						    </div>

						    <div class="col-md-4 form-dia">
						        <div class="form-group">
						        {{Form::label('dia', 'Fecha Dia', array('aria-hidden'=>'true'))}}
						        {{Form::text('dia', Input::old('dia'), array('class'=>'form-control', 'placeholder' => 'Dia', 'autocomplete'=>'off', 'aria-label'=>'Fecha Dia', 'required' =>'required'))}}
						        </div>
						        @if( $errors->has('dia') )
						            <div class="alert alert-danger">
						            @foreach($errors->get('dia') as $error )
						                {{ $error }}<br>
						            @endforeach
						            </div>
						        @endif
						    </div>

						    <div class="col-md-4 form-mes">
						        <div class="form-group formmes" id="formmes">
						            {{Form::label('mes', 'Fecha Mes', array('aria-hidden'=>'true'))}}
						            <select class="form-control" name="mes" id="mes">
						              <option <?php if($mes_actual == '01'){echo("selected");}?> value="01">Enero</option>
						              <option <?php if($mes_actual == '02'){echo("selected");}?> value="02">Febrero</option>
						              <option <?php if($mes_actual == '03'){echo("selected");}?> value="03">Marzo</option>
						              <option <?php if($mes_actual == '04'){echo("selected");}?> value="04">Abril</option>
						              <option <?php if($mes_actual == '05'){echo("selected");}?> value="05">Mayo</option>
						              <option <?php if($mes_actual == '06'){echo("selected");}?> value="06">Junio</option>
						              <option <?php if($mes_actual == '07'){echo("selected");}?> value="07">Julio</option>
						              <option <?php if($mes_actual == '08'){echo("selected");}?> value="08">Agosto</option>
						              <option <?php if($mes_actual == '09'){echo("selected");}?> value="09">Septiembre</option>
						              <option <?php if($mes_actual == '10'){echo("selected");}?> value="10">Octubre</option>
						              <option <?php if($mes_actual == '11'){echo("selected");}?> value="11">Noviembre</option>
						              <option <?php if($mes_actual == '12'){echo("selected");}?> value="12">Diciembre</option>
						            </select>
						        </div>
						    </div>
						    <div class="col-md-4 form-año">
						        <div class="form-group formaño" id="formaño">
						            {{Form::label('año', 'Fecha Año', array('aria-hidden'=>'true'))}}
						            <select class="form-control" name="año" id="año">
						                <option value="{{$año_actual}}">{{$año_actual}}</option>
						                <option value="{{$año_actual+1}}">{{$año_actual+1}}</option>
						                <option value="{{$año_actual+2}}">{{$año_actual+2   }}</option>
						            </select>
						        </div>
						    </div>

						    <div class="hidden">						    	
						    	{{Form::text('id_compromiso', Session::get('lastCompromisoID'), array('id'=>'id_compromiso'))}}
		                        {{Form::text('estado', 'Sin Ver', array('id'=>'estado'))}}
		                        {{Form::text('indicador', 'Amarillo', array('id'=>'indicador'))}}
		                        {{Form::text('id_asignador', Auth::user()->id)}}
		                        {{Form::text('nombre_asignador', Auth::user()->nombre.' '.Auth::user()->apellido)}}
		                    </div>

							<div class="col-md-12 form-btns">
							    {{Form::submit('Guardar', array('class'=>'btn btn-success btnSubmit', 'id'=>'btnSubmit'))}}
							</div>

						{{ Form::close() }}
                        </div>      
        
                    </div>
                </div>
            </div>
        </div>


@stop




