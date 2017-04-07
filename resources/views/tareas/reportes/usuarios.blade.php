@extends('layouts.master')

@section('title')
    Reporte Por Usuario
@stop

@section('contenido') 

    <div class="container controles">
        <h2 aria-hidden="true"><a href="{{ url('tareas/reportes') }}"><span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span></a>Reportes Por Usuario</h2> 
        <hr>
        <div class="row">
            <div class="col-md-4">
                <div class="form-group form-select">
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
                {{ Form::input('button',null,'Aceptar', array('class' => 'btn btn-primary btn-block ','id'=>'btn_reporteu'))}}
            </div>
            <div class="col-xs-12 col-sm-4">
                {{ Form::input('button',null,'Imprimir PDF', array('class' => 'btn btn-success btn-block ','id'=>'btn_reporteu_pdf'))}}
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
                                        <i class="fa fa-lightbulb-o kv-icon kv-icon-info"></i>
                                        Autoasignadas en esas fechas
                                    </td>
                                    <td class="kv-value"><span class="tareas_autoasignadas_en"></span> </td>
                                </tr>
                                <tr>
                                    <td class="kv-key">
                                        <i class="fa fa-lightbulb-o kv-icon kv-icon-info"></i>
                                        Autoasignadas para esas fechas
                                    </td>
                                    <td class="kv-value"><span class="tareas_autoasignadas_para"></span> </td>
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
                                        <i class="fa fa-check kv-icon kv-icon-success"></i>
                                        Concluidas en esas fechas *
                                    </td>
                                    <td class="kv-value"><span class="tareas_completadas_en"></span></td>
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
                    Tareas Concluidas En Ese Periodo de Tiempo*
                </h4>
            </div>
            <div class="portlet-body">
                <div class="tabla_en_ese_tiempo"></div>
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


