<h4>Documentacion</h4>
@if(count($siniestro->clasificacion_documentos()->get()) == 0)
<div class="alert alert-danger" role="alert">
    <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
    <span class="sr-only">Error:</span>
    No hay Documentacion Seleccionada
</div>
    {{Form::button('Agregar Documentacion', array('class'=>'btn-nuevoDocumentacionR btn btn-success', 'data-toggle' => 'modal', 'data-target'=>'#nuevoDocumentacionR-modal', 'data-backdrop' => 'static', 'data-keyboard' => 'false'))}}
@else
    <ul class="list-group" style="max-width: 500px;">
    @foreach($siniestro->clasificacion_documentos()->get() as $cla)
        <li class="list-group-item">{{$cla->clasificacion}}</li>
    @endforeach
    </ul>
@endif
<hr>
