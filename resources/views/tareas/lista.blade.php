@extends('layouts.master')

@section('title')
    Lista de Tareas
@stop

@section('contenido')

		<?php 
		Session::put('page', Input::get('page'));
		Session::put('id_responsable', Input::get('id_responsable'));
		Session::put('estado', Input::get('estado'));
		Session::put('indicador', Input::get('indicador'));
		
		
		?>
		

	<div class="row">
		<h2 aria-hidden="true"><a href="{{ url('tareas') }}"><span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span></a>Lista de Tareas</h2>
		
		<hr>
		<div class="col-md-12">
			<?php if (isset($_COOKIE["success"])){ ?>
				<audio src="../audio/tarea_success.mp3" autoplay>
                </audio>
			<?php } ?>
			
            <div class="well">
                {{ Form::open(array('url' => 'tareas/lista', 'method' => 'GET')) }}
                <div class="row">
                

                	<div class="col-sm-4">
                        <div class="form-group form-select">
                            {{Form::label('id_responsable', 'Responsable', array('aria-hidden'=>'true'))}}
                            <select class="form-control" name="id_responsable" id="id_responsable" >
                                <option value="">Seleccione un Responsable</option>
                                @foreach($usuarios as $usuario)
                                    <option <?php if($id_responsable == $usuario->id){echo("selected");}?>  value="{{$usuario->id}}">{{$usuario->nombre.' '.$usuario->apellido}}</option>
                                @endforeach 
                                <option value="">Todos</option>
                            </select>
                        </div>
                    </div>
                	
                            
                    
                    <div class="col-sm-4">
                        <div class="form-group form-estado">
                            {{Form::label('estado', 'Estado', array('aria-hidden'=>'true'))}}
                            <select class="form-control" name="estado" id="estado" >
                                <option <?php if($estado == ''){echo("selected");}?> value="">Seleccione un Estado</option>
                                <option <?php if($estado == 'Sin Ver'){echo("selected");}?> value="Sin Ver">Sin Ver</option>
                                <option <?php if($estado == 'Tramite'){echo("selected");}?> value="Tramite">Tramite</option>
                                <option <?php if($estado == 'Vencido'){echo("selected");}?> value="Vencido">Vencido</option>
                                <option <?php if($estado == 'Concluida A Tiempo'){echo("selected");}?> value="Concluida A Tiempo">Concluida A Tiempo</option>
                                <option <?php if($estado == 'Concluida A Destiempo'){echo("selected");}?> value="Concluida A Destiempo">Concluida A Destiempo</option>
                                <option value="">Todos</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group form-indicador">
                            {{Form::label('indicador', 'Indicador', array('aria-hidden'=>'true'))}}
                            <select class="form-control" name="indicador" id="indicador" >
                                <option <?php if($indicador == ''){echo("selected");}?> value="">Seleccione un Indicador</option>
                                <option <?php if($indicador == 'Amarillo'){echo("selected");}?> value="Amarillo">Amarillo</option>
                                <option <?php if($indicador == 'Naranja'){echo("selected");}?> value="Naranja">Naranja</option>
                                <option <?php if($indicador == 'Rojo'){echo("selected");}?> value="Rojo">Rojo</option>
                                <option <?php if($indicador == 'Verde'){echo("selected");}?> value="Verde">Verde</option>
                                <option value="">Todos</option>
                            
                            </select>
                        </div>
                    </div>
                </div>
                <div class="form-btns">
                    {{Form::submit('Buscar', array('class'=>'btn btn-success '))}}
                    {{HTML::link( 'tareas/lista' , 'Ver Todas', ['class' => 'btn btn-primary', 'role' => 'button']) }}
                </div>
                
                {{ Form::close() }}
            </div>
        </div>
		
		

		<div id="tabla_tareas" class="col-md-12">
		<table  class="table table-hover table-striped table-bordered" >
			<thead>
				<tr>
					<th>Id</th>
					<th>Responsable</th>
					<th>Tarea</th>
					<th>Fecha</th>
					<th>Estado</th>
					<th>Indicador</th>
					<th>Opciones</th>
				</tr>
			</thead>
			<tbody>
				@foreach($tareas as $tarea)
				<tr>
					<?php 
					$fecha = new DateTime($tarea->fecha);
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
					<td data-title="Id">{{$tarea->id}}</td>
					<td data-title="Responsable">{{$tarea->nombre_responsable}}</td>
					<td data-title="Tarea">{{$tarea->tarea}}</td>

					<td data-title="Fecha">{{$dia. " de " . $mes. " del " . $año}}</td>
					
					<td data-title="Estado">{{$tarea->estado}}</td>
					@if($tarea->indicador=='Verde')
					<td data-title="Indicador"><span class="label label-success">{{$tarea->indicador}}</span></td>
					@endif
					@if($tarea->indicador=='Amarillo')
					<td data-title="Indicador"><span class="label label-prevent">{{$tarea->indicador}}</span></td>
					@endif
					@if($tarea->indicador=='Naranja')
					<td data-title="Indicador"><span class="label label-warning">{{$tarea->indicador}}</span></td>
					@endif
					@if($tarea->indicador=='Rojo')
					<td data-title="Indicador"><span class="label label-danger">{{$tarea->indicador}}</span></td>
					@endif
					
					<td data-title="Opciones">

						{{HTML::link( 'tareas/ver/'.$tarea->id, 'Ver',  ['class' => 'btn btn-primary btn-xs', 'role' => 'button']) }}
						<!--{{Form::button('Ver', array('class'=>'btnVer btn btn-primary btn-xs', 'value' => $tarea->id))}}-->
						
						
						@if ((($tarea->estado == 'Tramite') || ($tarea->estado == 'Vencido')) && (Auth::user()->id == $tarea->id_responsable))
							{{Form::button('Concluir', array('class'=>'btnConcluir btn btn-success btn-xs', 'value' => $tarea->id))}}
						@endif

						@if (((Auth::user()->id == $tarea->id_asignador) && (Auth::user()->id != $tarea->id_responsable)) && (($tarea->estado != 'Concluida A Tiempo') && ($tarea->estado != 'Concluida A Destiempo')))

							{{ HTML::link( 'tareas/editar/'.$tarea->id , 'Editar', ['class' => 'btn btn-success btn-xs', 'role' => 'button']) }}

							<button type="button" class="btnEliminar btn btn-danger btn-xs" value="{{$tarea->id}}">Eliminar</button>

							<!--{{ HTML::link( 'tareas/eliminar/'.$tarea->id , 'Eiminar', ['class' => 'btn btn-danger btn-xs', 'role' => 'button']) }}-->
						@endif
					</td>
					
				</tr>
				@endforeach
			</tbody>
		</table>
		</div>

		<?php echo $tareas->appends(array('id_responsable'=>$id_responsable, 'estado'=>$estado, 'indicador'=>$indicador))->render(); ?>
	</div>

@stop


