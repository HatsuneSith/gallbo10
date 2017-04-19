{{{--nuevo comentario bitacora--}}}
<div class="modal fade nuevoComentarioBitacoraR-modal" id="nuevoComentarioBitacoraR-modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="H1">Agregar Comentarios a la Bitacora</h4>
            </div>
            <div class="modal-body">
                {{ Form::open(array('url' => 'sire/reclamacion/siniestro/agregar/comentario_bitacora/')) }}
                    <div class="row">
                        <div class="col-sm-12 col-md-12">
                            <div class="form-group">
                                {{Form::label('comentario', 'Comentario', array('aria-hidden'=>'true'))}}
                                {{Form::textarea('comentario', '', array('class'=>'form-control', 'rows'=>3, 'placeholder'=>'', 'autocomplete'=>'off', 'aria-label'=>'', 'required' =>'required'))}}
                                
                            </div>
                        </div>
                    </div>

                <div class="hidden">
                    <input type="text" name="id_siniestro" id="id_siniestro" value="{{$siniestro->id}}"/>
                    <input type="text" name="id_usuario" id="id_usuario" value="{{Auth::user()->id}}"/>
                </div>

                <div>
                    {{Form::submit('Agregar', array('class'=>'btn btn-success'))}}
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                </div>
                {{ Form::close() }}
            </div>

        </div>
    </div>
</div>