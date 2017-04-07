<h4>CRONOGRAMA DE ACTIVIDADES {{$siniestro->asegurado->nombre}}</h4>
<p>Documentos totales por recabar: {{count($siniestro->documentos()->get())}}</p>
<p>Documentos por recabar al día: {{count($siniestro->documentos()->wherePivot('entregado', Null)->get())}}</p>
<p>Documentos entregados al día: {{count($siniestro->documentos()->wherePivot('entregado', 'OK')->get())}}</p>

{{Form::button('Editar Informacion', array('class'=>'btn-editarDocumentacionR btn btn-success', 'data-toggle' => 'modal', 'data-target'=>'#editarDocumentacionR-modal', 'data-backdrop' => 'static', 'data-keyboard' => 'false', 'data-id' => $siniestro->id))}}

{{Form::button('Ver Responsables', array('class'=>'btn-verResponsablesR btn btn-primary', 'data-toggle' => 'modal', 'data-target'=>'#verResponsablesR-modal', 'data-backdrop' => 'static', 'data-keyboard' => 'false', 'data-id' => $siniestro->id))}}

{{Form::button('Agregar Responsables', array('class'=>'btn-nuevoResponsableR btn btn-info', 'data-toggle' => 'modal', 'data-target'=>'#nuevoResponsableR-modal', 'data-backdrop' => 'static', 'data-keyboard' => 'false', 'data-id' => $siniestro->id))}}
<hr>
<div class="table-responsive">
    <table class="table table-bordered table-hover">
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
        @if(count($siniestro->documentos()->get()) > 0)
            @foreach($siniestro->clasificacion_documentos()->get() as $cla)
                <tr class="info" ><th colspan="8">{{$cla->clasificacion}}</th></tr>
                @foreach($siniestro->documentos()->get() as $ds)
                    @if($ds->id_clasificacion == $cla->id)
                        <tr <?php if($ds->pivot->entregado =='OK') {echo "class='success'";} elseif(($ds->pivot->entregado !='OK') && ($ds->pivot->fecha_entrega != null) && (new DateTime($ds->pivot->fecha_entrega) < new DateTime())) {echo "class='danger'"; } ?> >
                            
                            <td>{{$ds->documento}}</td>

                            <td>{{$ds->pivot->nombre_responsable }}</td>

                            <td>  <?php if($ds->pivot->fecha_entrega != null || $ds->pivot->fecha_entrega != "") { ?> {{(new DateTime($ds->pivot->fecha_entrega))->format('d/m/Y')}} <?php } ?>  </td>

                            <td> <?php if($ds->pivot->fecha_entrega != null) { if (new DateTime($ds->pivot->fecha_entrega) < new DateTime()) {echo "0 dias"; } else{ echo (new DateTime())->diff( (new DateTime($ds->pivot->fecha_entrega))->add(new DateInterval('P1D')) )->format('%a dias'); } } ?> 
                            </td>
                            
                            <td>{{$ds->pivot->entregado}}</td>

                            <td> <?php if($ds->pivot->archivo != null || $ds->pivot->archivo != "") { ?> {{HTML::link( $ds->pivot->archivo , 'Descargar', ['class' => 'btn btn-primary btn-sm', 'role' => 'button'])}} <?php } ?>  </td>

                            <td>{{$ds->pivot->observaciones}}</td>
                            <td>{{Form::button('Agregar Documento', array('class'=>'btn-nuevoDocumentoSiniestroR btn btn-success btn-sm', 'data-toggle' => 'modal', 'data-target'=>'#nuevoDocumentoSiniestroR-modal', 'data-backdrop' => 'static', 'data-keyboard' => 'false', 'data-id' => $ds->id))}}</td>
                        </tr>
                     @endif
                @endforeach
            @endforeach
        @endif
        </tbody>
    </table>
</div>

<hr>



                    