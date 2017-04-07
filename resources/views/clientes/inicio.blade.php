@extends('layouts.master_clientes')

@section('title')
    SIRE
@stop

@section('js')
    {{HTML::script('js/promocion.js')}}
@stop

@section('contenido') 
<h4>CRONOGRAMA DE DOCUMENTOS {{$siniestro->asegurado->nombre}} <img src="/img/logo_gallbo.png" alt="Gallbo"  align="right" class="img-responsive" style="max-height: 50px;"></h4>
<p>Documentos totales por recabar: {{count($siniestro->documentos()->wherePivot('id_responsable', Auth::user()->id)->get())}}</p>
<p>Documentos por recabar al día: {{count($siniestro->documentos()->wherePivot('id_responsable', Auth::user()->id)->wherePivot('entregado', Null)->get())}}</p>
<p>Documentos entregados al día: {{count($siniestro->documentos()->wherePivot('id_responsable', Auth::user()->id)->wherePivot('entregado', 'OK')->get())}}</p>

<hr>
<table class="table table-bordered">
    <thead>
        <tr>
            <th>DOCUMENTOS</th>
            <th>RESPONSABLE</th>
            <th>FECHA DE ENTREGA</th>
            <th>DIAS RESTANTES</th>
            <th>ENTREGADO(OK)</th>
            <th>ARCHIVO</th>
            <th>OBSERVACIONES</th>
            <th>OPCIONES</th>
        </tr>
    </thead>
    <tbody>
    @if(count($siniestro->documentos()->wherePivot('id_responsable', Auth::user()->id)->get()) > 0)
	    @foreach($siniestro->clasificacion_documentos()->get() as $cla)
	    	@if(count($siniestro->documentos()->wherePivot('id_responsable', Auth::user()->id)->where('id_clasificacion', $cla->id)->get()) > 0)
	    		<tr class="info" ><th colspan="8">{{$cla->clasificacion}}</th></tr>
	    	@endif
	        @foreach($siniestro->documentos()->wherePivot('id_responsable', Auth::user()->id)->get() as $ds)
		        @if($ds->id_clasificacion == $cla->id)
		            <tr <?php if($ds->pivot->entregado =='OK') {echo "class='success'";} elseif(($ds->pivot->entregado !='OK') && ($ds->pivot->fecha_entrega != null) && (new DateTime($ds->pivot->fecha_entrega) < new DateTime())) {echo "class='danger'"; } ?> >
		                <th>{{$ds->documento}}</th>
		                
		                <th>{{$ds->pivot->nombre_responsable }}</th>

		                <th>  <?php if($ds->pivot->fecha_entrega != null || $ds->pivot->fecha_entrega != "") { ?> {{(new DateTime($ds->pivot->fecha_entrega))->format('d/m/Y')}} <?php } ?>  </th>

		                <th> <?php if($ds->pivot->fecha_entrega != null) { if (new DateTime($ds->pivot->fecha_entrega) < new DateTime()) {echo "0 dias"; } else{ echo (new DateTime())->diff( (new DateTime($ds->pivot->fecha_entrega))->add(new DateInterval('P1D')) )->format('%a dias'); } } ?> 
		                </th>
		                
		                <th>{{$ds->pivot->entregado}}</th>

		                <th> <?php if($ds->pivot->archivo != null || $ds->pivot->archivo != "") { ?> {{HTML::link( $ds->pivot->archivo , 'Descargar', ['class' => 'btn btn-primary btn-sm', 'role' => 'button'])}} <?php } ?>  </th>

		                <th>{{$ds->pivot->observaciones}}</th>
		                <th>{{Form::button('Agregar Documento', array('class'=>'btn-nuevoDocumentoSiniestroR btn btn-success btn-sm', 'data-toggle' => 'modal', 'data-target'=>'#nuevoDocumentoSiniestroR-modal', 'data-backdrop' => 'static', 'data-keyboard' => 'false', 'data-id' => $ds->id))}}</th>
		            </tr>
	            @endif
	        @endforeach
		@endforeach
    @endif
    </tbody>
</table>

<hr>

@stop

@section('modals')
	{{--agregar documento--}}
	<div class="modal fade nuevoDocumentoSiniestroR-modal" id="nuevoDocumentoSiniestroR-modal" tabindex="-1" role="dialog" aria-hidden="true">
	    <div class="modal-dialog modal-lg">
	        <div class="modal-content">
	            <div class="modal-header">
	                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	                    <span aria-hidden="true">&times;</span>
	                </button>
	                <h4 class="modal-title" id="H1">Agregar Logo</h4>
	            </div>
	            <div class="modal-body">
	                {{ Form::open(array('url' => 'documentacion/agregar/documento/', 'files'=>true)) }}
	                <div class="row">
	                    <div class="col-sm-12 col-md-12">
	                        <div class="form-group">
	                            <label class="control-label">Seleccionar archivo</label>
	                            <input id="documento" name="documento" type="file" class="file" >
	                        </div>
	                    </div>
	                </div>

	                <div class="hidden">
	                    <input type="text" name="id_siniestro" id="id_siniestro" value="{{$siniestro->id}}"/>
	                    <input type="text" name="id_documento" id="id_documento" value=""/>
	                </div>

	                <div>
	                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
	                </div>
	                {{ Form::close() }}
	            </div>

	        </div>
	    </div>
	</div>
@stop