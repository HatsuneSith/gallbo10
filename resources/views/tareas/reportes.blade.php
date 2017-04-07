@extends('layouts.master')

@section('menu')
    <!--<li><a href="{{url('tareas')}}"><i class="fa fa-list fa-fw"></i>Tareas</a></li>-->
    <!--<li>{{HTML::link('tareas/nueva', 'Crear Tarea',array('class'=>'disabled',))}}</li>-->
    <!--<li><a data-toggle="modal" href="{{ url('#ModalNuevaTarea') }}"><i class="fa fa-pencil-square-o fa-fw"></i>Crear Tarea</a></li>-->
    <!--<li>{{HTML::link('#ModalNuevaTarea','Crear Tarea',array('data-toggle'=>'modal',))}}</li>-->
    <!--<li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-file-text-o fa-fw"></i>Reportes<b class="caret"></b></a>
        <ul class="dropdown-menu">
            <li><a href="{{url('tareas/reportes/usuarios')}}"><i class="fa fa-user fa-fw"></i>Usuarios</a></li>
            <li><a href="{{url('tareas/reportes')}}"><i class="fa fa-users fa-fw"></i>Departamento</a></li>
            <li><a href="{{url('tareas/reportes')}}"><i class="fa fa-bar-chart fa-fw"></i>General</a></li>
        </ul>
    </li>-->
@stop

@section('menu-derecha')
{{--<li><a href="#">Tareas Sin Revisar <span class="badge">{{$tareas_sinrevisar}}</span></a></li>
<li><a href="#">Tareas Pendientes <span class="badge">{{$tareas_pendientes}}</span></a></li>--}}
@stop

@section('contenido') 

    <div class="container controles">
        <h2>Reportes</h2>
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label>Ver Reporte de:</label>
                    <select class="form-control" name="id_responsable" id="id_responsable">
                        <option value="">Seleccione un Responsable</option>
                            @foreach($usuarios as $usuario)
                                <option value="{{$usuario->id}}">{{$usuario->nombre.' '.$usuario->apellido}}</option>
                            @endforeach 
                    </select>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                {{Form::label('fecha_de', 'Fecha Inicio')}}<br>
                {{Form::input('date', 'fecha_de', null, ['class' => 'form-control', 'placeholder' => 'Date']);}}
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                {{Form::label('fecha_hasta', 'Fecha Fin')}}<br>
                {{Form::input('date', 'fecha_hasta', null, ['class' => 'form-control', 'placeholder' => 'Date']);}}
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12 col-sm-4">
                {{ Form::input('button',null,'Acepar', array('class' => 'btn btn-primary btn-block ','id'=>'btn_reporte'))}}
            </div>
        </div>
    </div> 
    <div class="container">
        <div class="row">
            <div class="col-md-4 col-sm-4">
                <div class="portlet portlet-default">
                    <div class="portlet-header">
                        <h4 class="portlet-title">
                            Estadisticas de Tareas
                        </h4>
                    </div>
                    <div class="portlet-body">
                        <table class="table keyvalue-table">
                            <tbody>
                                <tr>
                                    <td class="kv-key">
                                        <i class="fa fa-pie-chart kv-icon kv-icon-secondary"></i>
                                        Total
                                    </td>
                                    <td class="kv-value"><span class="tareas_total"></span> </td>
                                </tr>
                                <tr>
                                    <td class="kv-key">
                                        <i class="fa fa-check kv-icon kv-icon-success"></i>
                                        Concluidas
                                    </td>
                                    <td class="kv-value"><span class="tareas_completadas"></span></td>
                                </tr>
                                <tr>
                                    <td class="kv-key">
                                        <i class="fa fa-warning kv-icon kv-icon-warning"></i>
                                        Concluidas En Desfase
                                    </td>
                                    <td class="kv-value"><span class="tareas_destiempo"></span></td>
                                </tr>
                                <tr>
                                    <td class="kv-key">
                                        <i class="fa fa-close kv-icon kv-icon-danger"></i>
                                        No Concluidas
                                    </td>
                                    <td class="kv-value"><span class="tareas_vencidas"></span></td>
                                </tr>               
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-sm-4">
                <div class="portlet portlet-default">
                    <div class="portlet-header">
                        <h4 class="portlet-title">
                            Porcentaje de Cumplimiento
                        </h4>
                    </div>
                    <div class="portlet-body">
                        <div id="chart_cumplimiento"></div>
                    </div>                    
                </div>
            </div>
            <div class="col-md-4 col-sm-4">
                <div class="portlet portlet-default">
                    <div class="portlet-header">
                        <h4 class="portlet-title">
                            Porcentaje de Desfase
                        </h4>
                    </div>
                    <div class="portlet-body">
                        <div id="chart_desfase"></div>
                    </div>                    
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="portlet portlet-default">
            <div class="portlet-header">
                <h4 class="portlet-title">
                    Tareas Concluidas a Tiempo
                </h4>
            </div>
            <div class="portlet-body">
                <div class="tabla_atiempo"></div>
            </div>                    
        </div>
    </div>

    <div class="container">
        <div class="portlet portlet-default">
            <div class="portlet-header">
                <h4 class="portlet-title">
                    Tareas Concluidas en Destiempo
                </h4>
            </div>
            <div class="portlet-body">
                <div class="tabla_destiempo"></div>
            </div>                    
        </div>
    </div>

    <div class="container">
        <div class="portlet portlet-default">
            <div class="portlet-header">
                <h4 class="portlet-title">
                    Tareas Vencidas
                </h4>
            </div>
            <div class="portlet-body">
                <div class="tabla_vencidas"></div>
            </div>                    
        </div>
    </div>

    
@stop


