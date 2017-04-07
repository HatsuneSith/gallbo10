<h4>Bitacora</h4>
<p>
	{{Form::button('Agregar Comentario', array('class'=>'btn-nuevoComentarioBitacoraR btn btn-success', 'data-toggle' => 'modal', 'data-target'=>'#nuevoComentarioBitacoraR-modal', 'data-backdrop' => 'static', 'data-keyboard' => 'false', 'data-id' => $siniestro->id))}}
</p>
<table class="table table-bordered">
    <tbody>
    @if(count($siniestro->bitacora()->get()) > 0)
        @foreach($siniestro->bitacora()->get() as $bitacora)
            <tr>
                <td class="col-sm-2">{{$bitacora->created_at}}</td>
                <td class="col-sm-2">{{$bitacora->usuario->nombre}}</td>
                <td class="col-sm-8">{{$bitacora->comentario}}</td>
             </tr>
        @endforeach
    @endif
    </tbody>
</table>



<hr>
