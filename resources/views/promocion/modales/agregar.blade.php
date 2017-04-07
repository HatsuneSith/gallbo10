<div class="modal fade" id="myModalAgregar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">

                  <div class="modal-header bg-primary">
                      <center><h3 class="modal-title" id="myModalLabel"><span class="fa fa-fire"> Agregar Siniestro</span></h3></center>
                  </div>

                <div class="modal-body">
                  <center><span id="mensaje" class=" display-errors" ></span></center>
                  {{ Form::open(array('url' => 'tareas/crear', 'role' => 'form', 'id' => 'formulario_tareas')) }}
                    <div class="form-group">
                      <label for="fecha">Fecha</label>
                      <div class="input-group" >
                        <span class="input-group-addon "><i class="fa fa-calendar "></i></span>
                        <input class="form-control" name="fecha" type="date">
                      </div>
                    </div>

                    <div class="input-group" >
                    <span class="input-group-addon "><i class="glyphicon glyphicon-user "></i></span>
                    <input class="form-control" placeholder="Nombre(s)" name="nombre" type="text">
                    </div>
                    <div class="input-group" >
                    <span class="input-group-addon "><i class="glyphicon glyphicon-user "></i></span>
                    <input class="form-control" placeholder="Nombre(s)" name="nombre" type="text">
                    </div>
                    <div class="input-group" >
                    <span class="input-group-addon "><i class="glyphicon glyphicon-user "></i></span>
                    <input class="form-control" placeholder="Nombre(s)" name="nombre" type="text">
                    </div>
                    <div class="input-group" >
                    <span class="input-group-addon "><i class="glyphicon glyphicon-user "></i></span>
                    <input class="form-control" placeholder="Nombre(s)" name="nombre" type="text">
                    </div>
                    <div class="input-group" >
                    <span class="input-group-addon "><i class="glyphicon glyphicon-user "></i></span>
                    <input class="form-control" placeholder="Nombre(s)" name="nombre" type="text">
                    </div>
                    <div class="input-group" >
                    <span class="input-group-addon "><i class="glyphicon glyphicon-user "></i></span>
                    <input class="form-control" placeholder="Nombre(s)" name="nombre" type="text">
                    </div>
                    <div class="input-group" >
                    <span class="input-group-addon "><i class="glyphicon glyphicon-user "></i></span>
                    <input class="form-control" placeholder="Nombre(s)" name="nombre" type="text">
                    </div>
                    <div class="input-group" >
                    <span class="input-group-addon "><i class="glyphicon glyphicon-user "></i></span>
                    <input class="form-control" placeholder="Nombre(s)" name="nombre" type="text">
                    </div>
                    <div class="input-group" >
                    <span class="input-group-addon "><i class="glyphicon glyphicon-user "></i></span>
                    <input class="form-control" placeholder="Nombre(s)" name="nombre" type="text">
                    </div>
                    <div class="input-group" >
                    <span class="input-group-addon "><i class="glyphicon glyphicon-user "></i></span>
                    <input class="form-control" placeholder="Nombre(s)" name="nombre" type="text">
                    </div>
                    <div class="input-group" >
                    <span class="input-group-addon "><i class="glyphicon glyphicon-user "></i></span>
                    <input class="form-control" placeholder="Nombre(s)" name="nombre" type="text">
                    </div>
                    <div class="input-group" >
                    <span class="input-group-addon "><i class="glyphicon glyphicon-user "></i></span>
                    <input class="form-control" placeholder="Nombre(s)" name="nombre" type="text">
                    </div>
                    <div class="input-group" >
                    <span class="input-group-addon "><i class="glyphicon glyphicon-user "></i></span>
                    <input class="form-control" placeholder="Nombre(s)" name="nombre" type="text">
                    </div>

                    



                    <div class="form-group">
                      {{Form::label('fecha', 'Fecha')}}<br>
                      {{Form::input('date', 'fecha', null, ['class' => 'form-control', 'placeholder' => 'Date']);}}
                    </div>

                  </div> <!--Termina el modal body-->

                  <div class="modal-footer">
                    <div class="col-lg-10 col-lg-offset-1">
                      {{--Form::submit('Guardar', array('class'=>'btn btn-primary btn-block', 'id'=>'btnadd'))--}}
                      {{ Form::input('button',null,'Guardar', array('class' => 'btn btn-primary btn-block ','id'=>'btn_agregar_tarea'))}}
                      {{ Form::input('button',null,'Cancelar',array('class'=>'btn btn-default btn-block','data-dismiss'=>'modal','id'=>'btn_cerrar'))}}

                    </div>
                  </div>
                  {{ Form::close() }}

              </div><!--Termina modal content-->
            </div><!--Termina modal dialog-->
</div><!--Termina modal fade-->