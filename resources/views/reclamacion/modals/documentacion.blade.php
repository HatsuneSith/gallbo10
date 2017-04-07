{{--agregar documentacion--}}
<div class="modal fade nuevoDocumentacionR-modal" id="nuevoDocumentacionR-modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="H1">Seleccionar la Documentacion que se Requerira</h4>
            </div>
            {{ Form::open(array('url' => 'sire/reclamacion/siniestro/agregar/documentacion/', 'files'=>true)) }}
                <div class="modal-body">
                        <div class="checkbox">
                            <label><input type="checkbox" name="checkclasificacion[]" value="1" checked> Servicios de Asesoria </label>
                        </div>
                        <div class="checkbox">
                            <label><input type="checkbox" name="checkclasificacion[]" value="2" <?php if($siniestro->tipo_siniestro == 1 && $siniestro->asegurado->tipo_persona == 2){echo ("checked "); } ?> >Documentos Generales - Incendio - Personas Fisicas Directas </label>
                        </div>
                        <div class="checkbox">
                            <label><input type="checkbox" name="checkclasificacion[]" value="3" <?php if($siniestro->tipo_siniestro == 1 && $siniestro->asegurado->tipo_persona != 2){echo ("checked "); } ?> >Documentos Generales - Incendio - Personas Fisicas Apoderados y Personas Morales</label>
                        </div>
                        <div class="checkbox">
                            <label><input type="checkbox" name="checkclasificacion[]" value="4" <?php if($siniestro->tipo_siniestro != 1 && $siniestro->asegurado->tipo_persona == 2){echo ("checked "); } ?> >Documentos Generales - Otros - Personas Fisicas Directas</label> 
                        </div>
                        <div class="checkbox">
                            <label><input type="checkbox" name="checkclasificacion[]" value="5" <?php if($siniestro->tipo_siniestro != 1 && $siniestro->asegurado->tipo_persona != 2){echo ("checked "); } ?> >Documentos Generales - Otros - Personas Fisicas Apoderados y Personas Morales</label>
                        </div>
                        <div class="checkbox">
                            <label><input type="checkbox" name="checkclasificacion[]" value="6">Edificio Propio</label>
                        </div>
                        <div class="checkbox">
                            <label><input type="checkbox" name="checkclasificacion[]" value="7">Edificio Tercero</label>
                        </div>
                        <div class="checkbox">
                            <label><input type="checkbox" name="checkclasificacion[]" value="8">Contenidos - Mobiliario, Maquinaria y Equipo</label>
                        </div>
                        <div class="checkbox">
                            <label><input type="checkbox" name="checkclasificacion[]" value="9">Contenidos - Existencias - Industria</label>
                        </div>
                        <div class="checkbox">
                            <label><input type="checkbox" name="checkclasificacion[]" value="10">Contenidos - Existencias - Comercial</label>
                        </div>
                        <div class="checkbox">
                            <label><input type="checkbox" name="checkclasificacion[]" value="11" checked>Documentos Contables</label>
                        </div>
                        <div class="checkbox">
                            <label><input type="checkbox" name="checkclasificacion[]" value="12"  >Perdidas Consecuenciales - Utilidades, Salarios y Gastos Fijos.</label>
                        </div>
                        <div class="checkbox">
                            <label><input type="checkbox" name="checkclasificacion[]" value="13" >Perdidas Consecuenciales - Salarios y Gastos Fijos</label>
                        </div>
                        <div class="checkbox">
                            <label><input type="checkbox" name="checkclasificacion[]" value="14"  >Perdidas Consecuenciales - Perdida de Ingresos (Ganancias Brutas)</label>
                        </div>
                        <div class="checkbox">
                            <label><input type="checkbox" name="checkclasificacion[]" value="15" >Perdidas Consecuenciales - Perdida de Rentas</label>
                        </div>
                        <div class="checkbox">
                            <label><input type="checkbox" name="checkclasificacion[]" value="16"  >Gastos Extraordinarios</label>
                        </div>

                    <div class="hidden">
                        <input type="text" name="id_siniestro" id="id_siniestro" value="{{$siniestro->id}}"/>
                    </div>
                    
                </div>
                <div class="modal-footer">
                    {{Form::submit('Aceptar', array('class'=>'btn btn-success'))}}
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                </div>
            {{ Form::close() }}

        </div>
    </div>
</div>
