$(document).ready(function(){
    $('#lista_estados').change(function()
    {
        var id= document.getElementById("lista_estados").value;
        $.ajax({
            url: 'busqueda/periodicos/'+id,
            dataType:'json',
            type:'GET',

            success: function (data) {
                if (data.success==false) {
                    alert("error");
                }
                else{
                    $('.load_periodicos').html(periodicos);
                    var periodicos = '';        
                    periodicos += '<div class="list-group checkbox">';
                    for(datos in data.periodicos){
                        periodicos += '<label class="list-group-item" onclick="window.open(' + "'" + data.periodicos[datos].url + "','_blank')"+'"><input type="checkbox">'+  data.periodicos[datos].id + ' ' +data.periodicos[datos].url + '</label>';
                    }
                    periodicos += '</div>';
                    $('.load_periodicos').html(periodicos);
                }
            }
        })
    });

    $('#estatus').change(function()
    {
        var estatus = document.getElementById("estatus").value;
        if (estatus == 'Aceptado') {
          alert("Una vez que el siniestro se actualiza a ACEPTADO, pasara al modulo de Reclamacion y procedera a ser tratado. \nYa no sera posible actualizar el estatus a NO ACEPTADO o PENDIENTE \nEn dicho modulo se podran imprimir los formatos.")
        };
    });

    $('.seleccionarApoderadoR-modal #nombreApoderado').change(function()
    {
        var id= document.getElementById("nombreApoderado").value;
        $.ajax({
            url: '../busqueda/apoderado/'+id,
            dataType:'json',
            type:'GET',

            success: function (data) {
                if (data.success==false) {
                    alert("error");
                }
                else{
                    $(".seleccionarApoderadoR-modal #sexo").val(data.apoderado.sexo);
                    $(".seleccionarApoderadoR-modal #telefono").val(data.apoderado.telefono);
                    $(".seleccionarApoderadoR-modal #email").val(data.apoderado.email);
                    $(".seleccionarApoderadoR-modal #fax").val(data.apoderado.fax);
                    $(".seleccionarApoderadoR-modal #id_apoderado_legal").val(data.apoderado.id);
                }
            }
        })
    });

    $('.seleccionarContactoR-modal #nombreContacto').change(function()
    {
        var id= document.getElementById("nombreContacto").value;
        $.ajax({
            url: '../busqueda/contacto/'+id,
            dataType:'json',
            type:'GET',

            success: function (data) {
                if (data.success==false) {
                    alert("error");
                }
                else{
                    $(".seleccionarContactoR-modal #sexo").val(data.contacto.sexo);
                    $(".seleccionarContactoR-modal #telefono").val(data.contacto.telefono);
                    $(".seleccionarContactoR-modal #email").val(data.contacto.email);
                    $(".seleccionarContactoR-modal #fax").val(data.contacto.fax);
                    $(".seleccionarContactoR-modal #id_contacto").val(data.contacto.id);
                }
            }
        })
    });

    $('.seleccionarAseguradoraR-modal #nombreAseguradora').change(function()
    {
        var id= document.getElementById("nombreAseguradora").value;
        $.ajax({
            url: '../busqueda/aseguradora/'+id,
            dataType:'json',
            type:'GET',

            success: function (data) {
                if (data.success==false) {
                    alert("error");
                }
                else{
                    $(".seleccionarAseguradoraR-modal #domicilio").val(data.aseguradora.domicilio);
                    $(".seleccionarAseguradoraR-modal #estado").val(data.aseguradora.estado);
                    $(".seleccionarAseguradoraR-modal #ciudad").val(data.aseguradora.ciudad);
                    $(".seleccionarAseguradoraR-modal #codigo_postal").val(data.aseguradora.codigo_postal);
                    $(".seleccionarAseguradoraR-modal #telefono").val(data.aseguradora.telefono);
                    $(".seleccionarAseguradoraR-modal #fax").val(data.aseguradora.fax);
                    $(".seleccionarAseguradoraR-modal #email").val(data.aseguradora.email);
                    $(".seleccionarAseguradoraR-modal #id_aseguradora").val(data.aseguradora.id);
                }
            }
        })
    });

    $('.seleccionarAgenteSegurosR-modal #nombreAgenteSeguros').change(function()
    {
        var id= document.getElementById("nombreAgenteSeguros").value;
        $.ajax({
            url: '../busqueda/agente_seguro/'+id,
            dataType:'json',
            type:'GET',

            success: function (data) {
                if (data.success==false) {
                    alert("error");
                }
                else{
                    $(".seleccionarAgenteSegurosR-modal #domicilio").val(data.agente_seguro.domicilio);
                    $(".seleccionarAgenteSegurosR-modal #estado").val(data.agente_seguro.estado);
                    $(".seleccionarAgenteSegurosR-modal #ciudad").val(data.agente_seguro.ciudad);
                    $(".seleccionarAgenteSegurosR-modal #codigo_postal").val(data.agente_seguro.codigo_postal);
                    $(".seleccionarAgenteSegurosR-modal #telefono_oficina").val(data.agente_seguro.telefono_oficina);
                    $(".seleccionarAgenteSegurosR-modal #telefono_celular").val(data.agente_seguro.telefono_celular);
                    $(".seleccionarAgenteSegurosR-modal #email").val(data.agente_seguro.email);
                    $(".seleccionarAgenteSegurosR-modal #nextel").val(data.agente_seguro.nextel);
                    $(".seleccionarAgenteSegurosR-modal #id_agente_seguros").val(data.agente_seguro.id);
                }
            }
        })
    });
    
    $('.seleccionarAjustadorDesignadoR-modal #nombreAjustador').change(function()
    {
        var id= document.getElementById("nombreAjustador").value;
        $.ajax({
            url: '../busqueda/ajustador/'+id,
            dataType:'json',
            type:'GET',

            success: function (data) {
                if (data.success==false) {
                    alert("error");
                }
                else{
                    $(".seleccionarAjustadorDesignadoR-modal #domicilio").val(data.ajustador.domicilio);
                    $(".seleccionarAjustadorDesignadoR-modal #estado").val(data.ajustador.estado);
                    $(".seleccionarAjustadorDesignadoR-modal #ciudad").val(data.ajustador.ciudad);
                    $(".seleccionarAjustadorDesignadoR-modal #codigo_postal").val(data.ajustador.codigo_postal);
                    $(".seleccionarAjustadorDesignadoR-modal #telefono_oficina").val(data.ajustador.telefono_oficina);
                    $(".seleccionarAjustadorDesignadoR-modal #telefono_celular").val(data.ajustador.telefono_celular);
                    $(".seleccionarAjustadorDesignadoR-modal #email").val(data.ajustador.email);
                    $(".seleccionarAjustadorDesignadoR-modal #nextel").val(data.ajustador.nextel);
                    $(".seleccionarAjustadorDesignadoR-modal #id_ajustador").val(data.ajustador.id);
                }
            }
        })
    });

    $('.seleccionarAjustadoraR-modal #nombreAjustadora').change(function()
    {
        var id= document.getElementById("nombreAjustadora").value;
        $.ajax({
            url: '../busqueda/ajustadora/'+id,
            dataType:'json',
            type:'GET',

            success: function (data) {
                if (data.success==false) {
                    alert("error");
                }
                else{
                    $(".seleccionarAjustadoraR-modal #domicilio").val(data.ajustadora.domicilio);
                    $(".seleccionarAjustadoraR-modal #estado").val(data.ajustadora.estado);
                    $(".seleccionarAjustadoraR-modal #ciudad").val(data.ajustadora.ciudad);
                    $(".seleccionarAjustadoraR-modal #codigo_postal").val(data.ajustadora.codigo_postal);
                    $(".seleccionarAjustadoraR-modal #id_ajustadora").val(data.ajustadora.id);
                }
            }
        })
    });





});

$(function(){

  $('.datetimepicker1').datetimepicker({
    locale: 'es',
    format: 'DD/MM/YYYY HH:mm',
    sideBySide: true
  });

  $('.datetimepicker2').datetimepicker({
    locale: 'es',
    format: 'DD/MM/YYYY',
    defaultDate: false
  });

  $(".nuevoLogoR-modal #logo").fileinput({
      language: "es"
    });

  $(".nuevoDocumentoSiniestroR-modal #documento").fileinput({
      language: "es"
    });




  //funcion para desabilitar el boton submit al presionar.
  //evitamos que el usuario lo presione dos veces y se dupliquen los registros al guardar.
  $('#btnSubmit').on('click',function()
  {
    document.getElementById("btnSubmit").value = "Guardando...";
    document.getElementById("btnSubmit").className = "btn btn-success disabled";
      
  });

  //botones seccion Promocion -  Siniestros
  $('#btnEditarPromSin').on('click',function()
  {
    document.getElementById("btnEditarPromSin").className= "btn btn-success hidden";
    document.getElementById("form-edit-sin").disabled = false;
    document.getElementById("form-btns-editar").className= "";
    document.getElementById("btnAddCitaPromSin").disabled = true;
    document.getElementById("form-cita-sin").disabled = true;
    document.getElementById("btnAddEstatusPromSin").disabled = true;
    document.getElementById("form-estatus-sin").disabled = true;
  });

  $('#btnActPromSin').on('click',function()
  {
    document.getElementById("btnActPromSin").value = "Actualizando...";
    document.getElementById("btnActPromSin").className = "btn btn-success disabled";
  });

  $('#btnCanPromSin').on('click',function()
  {
    document.getElementById("btnEditarPromSin").className= "btn btn-success";
    document.getElementById("form-edit-sin").disabled = true;
    document.getElementById("form-btns-editar").className= "hidden";
    document.getElementById("btnAddCitaPromSin").disabled = false;
    document.getElementById("form-cita-sin").disabled = true;
    document.getElementById("btnAddEstatusPromSin").disabled = false;
    document.getElementById("form-estatus-sin").disabled = true;
  });

  $('#btnAddCitaPromSin').on('click',function()
  {
    document.getElementById("btnAddCitaPromSin").className= "btn btn-success hidden";
    document.getElementById("form-cita-sin").disabled = false;
    document.getElementById("form-btns-cita").className= "";
    document.getElementById("btnEditarPromSin").disabled = true;
    document.getElementById("form-edit-sin").disabled = true;
    document.getElementById("btnAddEstatusPromSin").disabled = true;
    document.getElementById("form-estatus-sin").disabled = true;
  });

  $('#btnCitaPromSin').on('click',function()
  {
    document.getElementById("btnCitaPromSin").value = "Actualizando...";
    document.getElementById("btnCitaPromSin").className = "btn btn-success disabled";
  });

  $('#btnCitaCanPromSin').on('click',function()
  {
    document.getElementById("btnAddCitaPromSin").className= "btn btn-success";
    document.getElementById("form-cita-sin").disabled = true;
    document.getElementById("form-btns-cita").className= "hidden";
    document.getElementById("btnEditarPromSin").disabled = false;
    document.getElementById("form-edit-sin").disabled = true;
    document.getElementById("btnAddEstatusPromSin").disabled = false;
    document.getElementById("form-estatus-sin").disabled = true;
  });

  $('#btnAddEstatusPromSin').on('click',function()
  {
    document.getElementById("btnAddEstatusPromSin").className= "btn btn-success hidden";
    document.getElementById("form-estatus-sin").disabled = false;
    document.getElementById("form-btns-estatus").className= "";
    document.getElementById("btnEditarPromSin").disabled = true;
    document.getElementById("form-edit-sin").disabled = true;
    document.getElementById("btnAddCitaPromSin").disabled = true;
    document.getElementById("form-cita-sin").disabled = true;
  });

  $('#btnEstatusPromSin').on('click',function()
  {
    document.getElementById("btnEstatusPromSin").value = "Actualizando...";
    document.getElementById("btnEstatusPromSin").className = "btn btn-success disabled";
  });

  $('#btnEstatusCanPromSin').on('click',function()
  {
    document.getElementById("btnAddEstatusPromSin").className= "btn btn-success";
    document.getElementById("form-estatus-sin").disabled = true;
    document.getElementById("form-btns-estatus").className= "hidden";
    document.getElementById("btnEditarPromSin").disabled = false;
    document.getElementById("form-edit-sin").disabled = true;
    document.getElementById("btnAddCitaPromSin").disabled = false;
    document.getElementById("form-cita-sin").disabled = true;
  });

  $('.btnPropuesta').on('click',function()
  {
    var id = $(this).data('id');

    $.ajax({
          url: 'propuesta/'+id,
          dataType:'json',
          type:'GET',

          success: function (data) {
              if (data.success==false) {
                var fecha_siniestro = moment(data.siniestro.fecha_siniestro).format('DD/MM/YYYY HH:mm');
                $(".modal-body-propuesta #asegurado").val(data.siniestro.nombre);
                $(".modal-body-propuesta #estado").val(data.siniestro.estado);
                $(".modal-body-propuesta #ciudad").val(data.siniestro.ciudad);
                $(".modal-body-propuesta #domicilio").val(data.siniestro.domicilio);
                $(".modal-body-propuesta #fecha_siniestro").val(fecha_siniestro);
                $(".modal-body-propuesta #id_promocion_siniestro").val(data.siniestro.id);
              }
              else{
                var fecha_siniestro = moment(data.propuesta.fecha_siniestro).format('DD/MM/YYYY HH:mm');
                $(".modal-body-propuesta #asegurado").val(data.propuesta.asegurado);
                $(".modal-body-propuesta #apoderado_legal").val(data.propuesta.apoderado_legal);
                $(".modal-body-propuesta #estado").val(data.propuesta.estado);
                $(".modal-body-propuesta #ciudad").val(data.propuesta.ciudad);
                $(".modal-body-propuesta #domicilio").val(data.propuesta.domicilio);
                $(".modal-body-propuesta #fecha_siniestro").val(fecha_siniestro);
                $(".modal-body-propuesta #num_poliza").val(data.propuesta.num_poliza);
                $(".modal-body-propuesta #aseguradora").val(data.propuesta.aseguradora);
                $(".modal-body-propuesta #honorarios_porcentaje").val(data.propuesta.honorarios_porcentaje);
                $(".modal-body-propuesta #honorarios_porcentaje_letra").val(data.propuesta.honorarios_porcentaje_letra);
                $(".modal-body-propuesta #anticipo_cantidad").val(data.propuesta.anticipo_cantidad);
                $(".modal-body-propuesta #anticipo_cantidad_letra").val(data.propuesta.anticipo_cantidad_letra);
                $(".modal-body-propuesta #num_personas_atencion").val(data.propuesta.num_personas_atencion);
                $(".modal-body-propuesta #id_promocion_siniestro").val(data.propuesta.id_promocion_siniestro);
              }
          }
      })
      
  });

//empieza seccion para modulo de reclamacion

  $('.btn-editarSiniestroR').on('click',function()
  {
    var id = $(this).data('id');
    $.ajax({
          url: '../busqueda/siniestro/'+id,
          dataType:'json',
          type:'GET',

          success: function (data) {
              if (data.success==false) {
                alert("error");
              }
              else{
                var fecha = moment(data.siniestro.fecha).format('DD/MM/YYYY HH:mm');
                $(".editarSiniestroR-modal #fecha").val(fecha);
                $(".editarSiniestroR-modal #num_siniestro").val(data.siniestro.num_siniestro);
                $(".editarSiniestroR-modal #tipo_siniestro").val(data.siniestro.tipo_siniestro);
                $(".editarSiniestroR-modal #domicilio").val(data.siniestro.domicilio);
                $(".editarSiniestroR-modal #estado").val(data.siniestro.estado);
                $(".editarSiniestroR-modal #ciudad").val(data.siniestro.ciudad);
                $(".editarSiniestroR-modal #codigo_postal").val(data.siniestro.codigo_postal);
                $(".editarSiniestroR-modal #id").val(data.siniestro.id);
              }
          }
      })
  });

  $('.btn-editarAseguradoR').on('click',function()
  {
    var id = $(this).data('id');
    $.ajax({
          url: '../busqueda/asegurado/'+id,
          dataType:'json',
          type:'GET',

          success: function (data) {
              if (data.success==false) {
                alert("error");
              }
              else{
                $(".editarAseguradoR-modal #nombre").val(data.asegurado.nombre);
                $(".editarAseguradoR-modal #tipo_persona").val(data.asegurado.tipo_persona);
                $(".editarAseguradoR-modal #giro").val(data.asegurado.giro);
                $(".editarAseguradoR-modal #domicilio").val(data.asegurado.domicilio);
                $(".editarAseguradoR-modal #estado").val(data.asegurado.estado);
                $(".editarAseguradoR-modal #ciudad").val(data.asegurado.ciudad);
                $(".editarAseguradoR-modal #codigo_postal").val(data.asegurado.codigo_postal);
                $(".editarAseguradoR-modal #telefono").val(data.asegurado.telefono);
                $(".editarAseguradoR-modal #fax").val(data.asegurado.fax);
                $(".editarAseguradoR-modal #email").val(data.asegurado.email);
                $(".editarAseguradoR-modal #rfc").val(data.asegurado.rfc);
                $(".editarAseguradoR-modal #sexo").val(data.asegurado.sexo);
                $(".editarAseguradoR-modal #id").val(data.asegurado.id);
              }
          }
      })
  });

$('.btn-seleccionarApoderadoR').on('click',function()
  {
    $.ajax({
      url: '../busqueda/apoderados',
      dataType: 'json',
      type: 'get',

      success: function(data){
        if (data.success==false) {
        }
        else {
          var apoderados = [];
          for(datos in data.apoderados){
            apoderados.push({text: data.apoderados[datos].nombre, value: data.apoderados[datos].id});
          }

          $(".seleccionarApoderadoR-modal #nombreApoderado").kendoComboBox({
            dataTextField: "text",
            dataValueField: "value",
            dataSource: apoderados,
            filter: "contains",
            suggest: true
          });
        }
      }
    })
  
  });

  $('.btn-editarApoderadoR').on('click',function()
  {
    var id = $(this).data('id');
    $.ajax({
          url: '../busqueda/apoderado/'+id,
          dataType:'json',
          type:'GET',

          success: function (data) {
              if (data.success==false) {
                alert("error");
              }
              else{
                $(".editarApoderadoR-modal #nombre").val(data.apoderado.nombre);
                $(".editarApoderadoR-modal #sexo").val(data.apoderado.sexo);
                $(".editarApoderadoR-modal #telefono").val(data.apoderado.telefono);
                $(".editarApoderadoR-modal #email").val(data.apoderado.email);
                $(".editarApoderadoR-modal #nextel").val(data.apoderado.nextel);
                $(".editarApoderadoR-modal #id_apoderado_legal").val(data.apoderado.id);

              }
          }
      })
  });

  $('.btn-seleccionarContactoR').on('click',function()
  {
    $.ajax({
      url: '../busqueda/contactos',
      dataType: 'json',
      type: 'get',

      success: function(data){
        if (data.success==false) {
        }
        else {
          var contactos = [];
          for(datos in data.contactos){
            contactos.push({text: data.contactos[datos].nombre, value: data.contactos[datos].id});
          }

          $(".seleccionarContactoR-modal #nombreContacto").kendoComboBox({
            dataTextField: "text",
            dataValueField: "value",
            dataSource: contactos,
            filter: "contains",
            suggest: true
          });
        }
      }
    })
  });

  $('.btn-editarContactoR').on('click',function()
  {
    var id = $(this).data('id');
    $.ajax({
          url: '../busqueda/contacto/'+id,
          dataType:'json',
          type:'GET',

          success: function (data) {
              if (data.success==false) {
                alert("error");
              }
              else{
                $(".editarContactoR-modal #nombre").val(data.contacto.nombre);
                $(".editarContactoR-modal #sexo").val(data.contacto.sexo);
                $(".editarContactoR-modal #telefono").val(data.contacto.telefono);
                $(".editarContactoR-modal #email").val(data.contacto.email);
                $(".editarContactoR-modal #nextel").val(data.contacto.nextel);
                $(".editarContactoR-modal #id_apoderado_legal").val(data.contacto.id);

              }
          }
      })
  });

  $('.btn-editarActaConstitutivaR').on('click',function()
  {
    var id = $(this).data('id');
    $.ajax({
          url: '../busqueda/acta_constitutiva/'+id,
          dataType:'json',
          type:'GET',

          success: function (data) {
              if (data.success==false) {
                alert("error");
              }
              else{
                $(".editarActaConstitutivaR-modal #escritura_publica").val(data.acta_constitutiva.escritura_publica);
                $(".editarActaConstitutivaR-modal #fecha").val(moment(data.acta_constitutiva.fecha).format('DD/MM/YYYY HH:mm'));
                $(".editarActaConstitutivaR-modal #notario_publico").val(data.acta_constitutiva.notario_publico);
                $(".editarActaConstitutivaR-modal #administrador").val(data.acta_constitutiva.administrador);
                $(".editarActaConstitutivaR-modal #objeto").val(data.acta_constitutiva.objeto);
                $(".editarActaConstitutivaR-modal #id_acta_constitutiva").val(data.acta_constitutiva.id);

              }
          }
      })
  });

  $('.btn-editarAseguradoraR').on('click',function()
  {
    var id = $(this).data('id');
    $.ajax({
          url: '../busqueda/aseguradora/'+id,
          dataType:'json',
          type:'GET',

          success: function (data) {
              if (data.success==false) {
                alert("error");
              }
              else{
                $(".editarAseguradoraR-modal #nombre").val(data.aseguradora.nombre);
                $(".editarAseguradoraR-modal #domicilio").val(data.aseguradora.domicilio);
                $(".editarAseguradoraR-modal #estado").val(data.aseguradora.estado);
                $(".editarAseguradoraR-modal #ciudad").val(data.aseguradora.ciudad);
                $(".editarAseguradoraR-modal #codigo_postal").val(data.aseguradora.codigo_postal);
                $(".editarAseguradoraR-modal #telefono").val(data.aseguradora.telefono);
                $(".editarAseguradoraR-modal #fax").val(data.aseguradora.fax);
                $(".editarAseguradoraR-modal #email").val(data.aseguradora.email);

              }
          }
      })
  });

  $('.btn-editarDirectorSiniestrosR').on('click',function()
  {
    var id = $(this).data('id');
    $.ajax({
          url: '../busqueda/director_siniestros/'+id,
          dataType:'json',
          type:'GET',

          success: function (data) {
              if (data.success==false) {
                alert("error");
              }
              else{
                $(".editarDirectorSiniestrosR-modal #nombre").val(data.director_siniestros.nombre);
                $(".editarDirectorSiniestrosR-modal #telefono").val(data.director_siniestros.telefono);
                $(".editarDirectorSiniestrosR-modal #email").val(data.director_siniestros.email);
                $(".editarDirectorSiniestrosR-modal #nextel").val(data.director_siniestros.nextel);
              }
          }
      })
  });
  
  $('.btn-editarGerenciaSiniestrosR').on('click',function()
  {
    var id = $(this).data('id');
    $.ajax({
          url: '../busqueda/gerencia_siniestros/'+id,
          dataType:'json',
          type:'GET',

          success: function (data) {
              if (data.success==false) {
                alert("error");
              }
              else{
                $(".editarGerenciaSiniestrosR-modal #nombre").val(data.gerencia_siniestros.nombre);
                $(".editarGerenciaSiniestrosR-modal #telefono").val(data.gerencia_siniestros.telefono);
                $(".editarGerenciaSiniestrosR-modal #email").val(data.gerencia_siniestros.email);
                $(".editarGerenciaSiniestrosR-modal #nextel").val(data.gerencia_siniestros.nextel);


              }
          }
      })
  });

  $('.btn-editarAgenteSegurosR').on('click',function()
  {
    var id = $(this).data('id');
    $.ajax({
          url: '../busqueda/agente_seguro/'+id,
          dataType:'json',
          type:'GET',

          success: function (data) {
              if (data.success==false) {
                alert("error");
              }
              else{
                $(".editarAgenteSegurosR-modal #nombre").val(data.agente_seguro.nombre);
                $(".editarAgenteSegurosR-modal #domicilio").val(data.agente_seguro.domicilio);
                $(".editarAgenteSegurosR-modal #estado").val(data.agente_seguro.estado);
                $(".editarAgenteSegurosR-modal #ciudad").val(data.agente_seguro.ciudad);
                $(".editarAgenteSegurosR-modal #codigo_postal").val(data.agente_seguro.codigo_postal);
                $(".editarAgenteSegurosR-modal #telefono_oficina").val(data.agente_seguro.telefono_oficina);
                $(".editarAgenteSegurosR-modal #telefono_celular").val(data.agente_seguro.telefono_celular);
                $(".editarAgenteSegurosR-modal #fax").val(data.agente_seguro.fax);
                $(".editarAgenteSegurosR-modal #email").val(data.agente_seguro.email);
                $(".editarAgenteSegurosR-modal #id").val(data.agente_seguro.id);

              }
          }
      })
  });

  $('.btn-seleccionarAgenteSegurosR').on('click',function()
  {
    $.ajax({
      url: '../busqueda/agentes_seguros',
      dataType: 'json',
      type: 'get',

      success: function(data){
        if (data.success==false) {
        }
        else {
          var agentes_seguros = [];
          for(datos in data.agentes_seguros){
            agentes_seguros.push({text: data.agentes_seguros[datos].nombre, value: data.agentes_seguros[datos].id});
          }

          $(".seleccionarAgenteSegurosR-modal #nombreAgenteSeguros").kendoComboBox({
            dataTextField: "text",
            dataValueField: "value",
            dataSource: agentes_seguros,
            filter: "contains",
            suggest: true
          });
        }
      }
    })
  });

  $('.btn-seleccionarAseguradoraR').on('click',function()
  {
    $.ajax({
      url: '../busqueda/aseguradoras',
      dataType: 'json',
      type: 'get',

      success: function(data){
        if (data.success==false) {
        }
        else {
          var aseguradoras = [];
          for(datos in data.aseguradoras){
            aseguradoras.push({text: data.aseguradoras[datos].nombre, value: data.aseguradoras[datos].id});
          }

          $(".seleccionarAseguradoraR-modal #nombreAseguradora").kendoComboBox({
            dataTextField: "text",
            dataValueField: "value",
            dataSource: aseguradoras,
            filter: "contains",
            suggest: true
          });
        }
      }
    })
  });

  $('.btn-editarAjustadoraR').on('click',function()
  {
    var id = $(this).data('id');
    $.ajax({
          url: '../busqueda/ajustadora/'+id,
          dataType:'json',
          type:'GET',

          success: function (data) {
              if (data.success==false) {
                alert("error");
              }
              else{
                $(".editarAjustadoraR-modal #nombre").val(data.ajustadora.nombre);
                $(".editarAjustadoraR-modal #domicilio").val(data.ajustadora.domicilio);
                $(".editarAjustadoraR-modal #estado").val(data.ajustadora.estado);
                $(".editarAjustadoraR-modal #ciudad").val(data.ajustadora.ciudad);
                $(".editarAjustadoraR-modal #codigo_postal").val(data.ajustadora.codigo_postal);
              }
          }
      })
  });

  $('.btn-editarDirectorDespachoR').on('click',function()
  {
    var id = $(this).data('id');
    $.ajax({
          url: '../busqueda/director_despacho/'+id,
          dataType:'json',
          type:'GET',

          success: function (data) {
              if (data.success==false) {
                alert("error");
              }
              else{
                $(".editarDirectorDespachoR-modal #nombre").val(data.director_despacho.nombre);
                $(".editarDirectorDespachoR-modal #telefono_oficina").val(data.director_despacho.telefono_oficina);
                $(".editarDirectorDespachoR-modal #telefono_celular").val(data.director_despacho.telefono_celular);
                $(".editarDirectorDespachoR-modal #email").val(data.director_despacho.email);
                $(".editarDirectorDespachoR-modal #nextel").val(data.director_despacho.nextel);
              }
          }
      })
  });

  $('.btn-editarAjustadorDesignadoR').on('click',function()
  {
    var id = $(this).data('id');
    $.ajax({
          url: '../busqueda/ajustador/'+id,
          dataType:'json',
          type:'GET',

          success: function (data) {
              if (data.success==false) {
                alert("error");
              }
              else{
                $(".editarAjustadorDesignadoR-modal #nombre").val(data.ajustador.nombre);
                $(".editarAjustadorDesignadoR-modal #domicilio").val(data.ajustador.domicilio);
                $(".editarAjustadorDesignadoR-modal #estado").val(data.ajustador.estado);
                $(".editarAjustadorDesignadoR-modal #ciudad").val(data.ajustador.ciudad);
                $(".editarAjustadorDesignadoR-modal #codigo_postal").val(data.ajustador.codigo_postal);
                $(".editarAjustadorDesignadoR-modal #telefono_oficina").val(data.ajustador.telefono_oficina);
                $(".editarAjustadorDesignadoR-modal #telefono_celular").val(data.ajustador.telefono_celular);
                $(".editarAjustadorDesignadoR-modal #fax").val(data.ajustador.fax);
                $(".editarAjustadorDesignadoR-modal #email").val(data.ajustador.email);
                $(".editarAjustadorDesignadoR-modal #id").val(data.ajustador.id);

              }
          }
      })
  });

  $('.btn-seleccionarAjustadoraR').on('click',function()
  {
    $.ajax({
      url: '../busqueda/ajustadoras',
      dataType: 'json',
      type: 'get',

      success: function(data){
        if (data.success==false) {
        }
        else {
          var ajustadoras = [];
          for(datos in data.ajustadoras){
            ajustadoras.push({text: data.ajustadoras[datos].nombre, value: data.ajustadoras[datos].id});
          }

          $(".seleccionarAjustadoraR-modal #nombreAjustadora").kendoComboBox({
            dataTextField: "text",
            dataValueField: "value",
            dataSource: ajustadoras,
            filter: "contains",
            suggest: true
          });
        }
      }
    })
  });

  $('.btn-seleccionarAjustadorDesignadoR').on('click',function()
  {
    $.ajax({
      url: '../busqueda/ajustadores',
      dataType: 'json',
      type: 'get',

      success: function(data){
        if (data.success==false) {
        }
        else {
          var ajustadores = [];
          for(datos in data.ajustadores){
            ajustadores.push({text: data.ajustadores[datos].nombre, value: data.ajustadores[datos].id});
          }

          $(".seleccionarAjustadorDesignadoR-modal #nombreAjustador").kendoComboBox({
            dataTextField: "text",
            dataValueField: "value",
            dataSource: ajustadores,
            filter: "contains",
            suggest: true
          });
        }
      }
    })
  });

  $('.btn-editarAveriguacionR').on('click',function()
  {
    var id = $(this).data('id');
    $.ajax({
          url: '../busqueda/averiguacion/'+id,
          dataType:'json',
          type:'GET',

          success: function (data) {
              if (data.success==false) {
                alert("error");
              }
              else{
                $(".editarAveriguacionR-modal #num_averiguacion").val(data.averiguacion.num_averiguacion);
                $(".editarAveriguacionR-modal #dependencia_judicial").val(data.averiguacion.dependencia_judicial);
                $(".editarAveriguacionR-modal #titular_dependencia").val(data.averiguacion.titular_dependencia);
                $(".editarAveriguacionR-modal #id").val(data.averiguacion.id);
              }
          }
      })
  });

  $('.btn-editarPolizaR').on('click',function()
  {
    var id = $(this).data('id');
    $.ajax({
          url: '../busqueda/poliza/'+id,
          dataType:'json',
          type:'GET',

          success: function (data) {
              if (data.success==false) {
                alert("error");
              }
              else{
                $(".editarPolizaR-modal #num_poliza").val(data.poliza.num_poliza);
                $(".editarPolizaR-modal #ramo_poliza").val(data.poliza.ramo_poliza);
                $(".editarPolizaR-modal #fecha_expedicion").val(moment(data.poliza.fecha_expedicion).format('DD/MM/YYYY HH:mm'));
                $(".editarPolizaR-modal #inicio_vigencia").val(moment(data.poliza.inicio_vigencia).format('DD/MM/YYYY HH:mm'));
                $(".editarPolizaR-modal #fin_vigencia").val(moment(data.poliza.fin_vigencia).format('DD/MM/YYYY HH:mm'));
                $(".editarPolizaR-modal #tipo_moneda").val(data.poliza.tipo_moneda);
              }
          }
      })
  });

  $('.btn-nuevoDocumentoSiniestroR').on('click',function()
  {
    var id = $(this).data('id');
    $(".nuevoDocumentoSiniestroR-modal #id_documento").val(id);
  });

  

  $('.btn-editarTableroR').on('click',function()
  {
    var id = $(this).data('id');
    $.ajax({
          url: '../reclamacion/busqueda/tablero/'+id,
          dataType:'json',
          type:'GET',

          success: function (data) {
              if (data.success==false) {
                $(".editarTableroR-modal #id").val(id);
              }
              else{
                $(".editarTableroR-modal #cierre_trato").val(moment(data.tablero.cierre_trato).format('YYYY-MM-DD'));
                $(".editarTableroR-modal #firma_contrato").val(moment(data.tablero.firma_contrato).format('YYYY-MM-DD'));
                $(".editarTableroR-modal #entrega_cartas").val(moment(data.tablero.entrega_cartas).format('YYYY-MM-DD'));
                $(".editarTableroR-modal #solicitud_documentos").val(moment(data.tablero.solicitud_documentos).format('YYYY-MM-DD'));
                $(".editarTableroR-modal #elaboracion_cronograma").val(moment(data.tablero.elaboracion_cronograma).format('YYYY-MM-DD'));
                $(".editarTableroR-modal #entrega_reclamacion_parcial").val(moment(data.tablero.entrega_reclamacion_parcial).format('YYYY-MM-DD'));
                $(".editarTableroR-modal #entrega_reclamacion_total").val(moment(data.tablero.entrega_reclamacion_total).format('YYYY-MM-DD'));
                $(".editarTableroR-modal #inicio_fase_ajustador").val(moment(data.tablero.inicio_fase_ajustador).format('YYYY-MM-DD'));
                $(".editarTableroR-modal #firma_convenio").val(moment(data.tablero.firma_convenio).format('YYYY-MM-DD'));
                $(".editarTableroR-modal #id").val(id);
                
              }
          }
      })
  });

$('.btn-editarSinTableroR').on('click',function()
  {
    var id = $(this).data('id');
    $.ajax({
          url: '../reclamacion/busqueda/sin_tablero/'+id,
          dataType:'json',
          type:'GET',

          success: function (data) {
              if (data.success==false) {
                $(".editarSinTableroR-modal #id").val(id);
              }
              else{
                $(".editarSinTableroR-modal #asegurado").val(data.tablero.asegurado);
                $(".editarSinTableroR-modal #ejecutivo").val(data.tablero.ejecutivo);
                $(".editarSinTableroR-modal #cierre_trato").val(moment(data.tablero.cierre_trato).format('YYYY-MM-DD'));
                $(".editarSinTableroR-modal #firma_contrato").val(moment(data.tablero.firma_contrato).format('YYYY-MM-DD'));
                $(".editarSinTableroR-modal #entrega_cartas").val(moment(data.tablero.entrega_cartas).format('YYYY-MM-DD'));
                $(".editarSinTableroR-modal #solicitud_documentos").val(moment(data.tablero.solicitud_documentos).format('YYYY-MM-DD'));
                $(".editarSinTableroR-modal #elaboracion_cronograma").val(moment(data.tablero.elaboracion_cronograma).format('YYYY-MM-DD'));
                $(".editarSinTableroR-modal #doc_totales").val(data.tablero.doc_totales);
                $(".editarSinTableroR-modal #doc_recabados").val(data.tablero.doc_recabados);
                $(".editarSinTableroR-modal #entrega_reclamacion_parcial").val(moment(data.tablero.entrega_reclamacion_parcial).format('YYYY-MM-DD'));
                $(".editarSinTableroR-modal #entrega_reclamacion_total").val(moment(data.tablero.entrega_reclamacion_total).format('YYYY-MM-DD'));
                $(".editarSinTableroR-modal #bitacora").val(data.tablero.bitacora);
                $(".editarSinTableroR-modal #firma_convenio").val(moment(data.tablero.firma_convenio).format('YYYY-MM-DD'));
                $(".editarSinTableroR-modal #id").val(id);
                
              }
          }
      })
  });

  $('.btn-nuevoContratoR').on('click',function()
  {
    var id = $(this).data('id');
    $.ajax({
      url: '../formatos/contrato/'+id,
      dataType:'json',
      type:'GET',

      success: function (data) {
          if (data.success==false) {
            $('#avisoFormatos-modal').modal('show');
            $('#avisoFormatos-modal .modal-title').html('Error');
            $('#avisoFormatos-modal .mensaje').html('Por favor asegurece que los campos correspondientes esten correctamente llenados.');
            $('.lista_variables').html(lista_variables);
            var lista_variables = '';   
            lista_variables += '<ul>';
                for (datos in data.variables) {
                    lista_variables += '<li>' + data.variables[datos] + '</li>';
                }
            lista_variables += '</ul>';
            $('.lista_variables').html(lista_variables);
            //$('.error').html(data.error.xdebug_message);
          }
          else{
            $('#formContrato-modal').modal('show');

          }
      }
    })
  });

$('.btn-nuevoSolicitudRemocionR').on('click',function()
  {
    var id = $(this).data('id');
    $.ajax({
      url: '../formatos/remocion_escombros/'+id,
      dataType:'json',
      type:'GET',

      success: function (data) {
          if (data.success==false) {
            $('#avisoFormatos-modal').modal('show');
            $('#avisoFormatos-modal .modal-title').html('Error');
            $('#avisoFormatos-modal .mensaje').html('Por favor asegurece que los campos correspondientes esten correctamente llenados.');
            $('.lista_variables').html(lista_variables);
            var lista_variables = '';   
            lista_variables += '<ul>';
                for (datos in data.variables) {
                    lista_variables += '<li>' + data.variables[datos] + '</li>';
                }
            lista_variables += '</ul>';
            $('.lista_variables').html(lista_variables);
            //$('.error').html(data.error.xdebug_message);
          }
          else{
            $('#avisoFormatos-modal').modal('show');
            $('#avisoFormatos-modal .modal-title').html('Todo Bien');
            $('#avisoFormatos-modal .lista_variables').html('');
            $('#avisoFormatos-modal .mensaje').html('Archivo generado correctamente,   <a href="../formatos/descargar/remocion_escombros/'+id+'"> click aqui para descargar </a>');
          }
      }
    })
  });

$('.btn-nuevoSolicitudAnticipoR').on('click',function()
  {
    var id = $(this).data('id');
    $.ajax({
      url: '../formatos/anticipo_indemnizacion/'+id,
      dataType:'json',
      type:'GET',

      success: function (data) {
          if (data.success==false) {
            $('#avisoFormatos-modal').modal('show');
            $('#avisoFormatos-modal .modal-title').html('Error');
            $('#avisoFormatos-modal .mensaje').html('Por favor asegurece que los campos correspondientes esten correctamente llenados.');
            $('.lista_variables').html(lista_variables);
            var lista_variables = '';   
            lista_variables += '<ul>';
                for (datos in data.variables) {
                    lista_variables += '<li>' + data.variables[datos] + '</li>';
                }
            lista_variables += '</ul>';
            $('.lista_variables').html(lista_variables);
            //$('.error').html(data.error.xdebug_message);
          }
          else{
            $('#formAnticipoIndemnizacion-modal').modal('show');
          }
      }
    })
  });

$('.btn-nuevoNombramientoAsesoresR').on('click',function()
  {
    var id = $(this).data('id');
    $.ajax({
      url: '../formatos/nombramiento_asesores/'+id,
      dataType:'json',
      type:'GET',

      success: function (data) {
          if (data.success==false) {
            $('#avisoFormatos-modal').modal('show');
            $('#avisoFormatos-modal .modal-title').html('Error');
            $('#avisoFormatos-modal .mensaje').html('Por favor asegurece que los campos correspondientes esten correctamente llenados.');
            $('.lista_variables').html(lista_variables);
            var lista_variables = '';   
            lista_variables += '<ul>';
                for (datos in data.variables) {
                    lista_variables += '<li>' + data.variables[datos] + '</li>';
                }
            lista_variables += '</ul>';
            $('.lista_variables').html(lista_variables);
            //$('.error').html(data.error.xdebug_message);
          }
          else{
            $('#avisoFormatos-modal').modal('show');
            $('#avisoFormatos-modal .modal-title').html('Todo Bien');
            $('#avisoFormatos-modal .lista_variables').html('');
            $('#avisoFormatos-modal .mensaje').html('Archivo generado correctamente,   <a href="../formatos/descargar/nombramiento_asesores/'+id+'"> click aqui para descargar </a>');
          }
      }
    })
  });

$('.btn-nuevoSolicitudPolizaR').on('click',function()
  {
    var id = $(this).data('id');
    $.ajax({
      url: '../formatos/duplicado_poliza/'+id,
      dataType:'json',
      type:'GET',

      success: function (data) {
          if (data.success==false) {
            $('#avisoFormatos-modal').modal('show');
            $('#avisoFormatos-modal .modal-title').html('Error');
            $('#avisoFormatos-modal .mensaje').html('Por favor asegurece que los campos correspondientes esten correctamente llenados.');
            $('.lista_variables').html(lista_variables);
            var lista_variables = '';   
            lista_variables += '<ul>';
                for (datos in data.variables) {
                    lista_variables += '<li>' + data.variables[datos] + '</li>';
                }
            lista_variables += '</ul>';
            $('.lista_variables').html(lista_variables);
            //$('.error').html(data.error.xdebug_message);
          }
          else{
            $('#avisoFormatos-modal').modal('show');
            $('#avisoFormatos-modal .modal-title').html('Todo Bien');
            $('#avisoFormatos-modal .lista_variables').html('');
            $('#avisoFormatos-modal .mensaje').html('Archivo generado correctamente,   <a href="../formatos/descargar/duplicado_poliza/'+id+'"> click aqui para descargar </a>');
          }
      }
    })
  });


$('.btn-nuevoAsignacionAjustadoresR').on('click',function()
  {
    var id = $(this).data('id');
    $.ajax({
      url: '../formatos/asignacion_ajustadores/'+id,
      dataType:'json',
      type:'GET',

      success: function (data) {
          if (data.success==false) {
            $('#avisoFormatos-modal').modal('show');
            $('#avisoFormatos-modal .modal-title').html('Error');
            $('#avisoFormatos-modal .mensaje').html('Por favor asegurece que los campos correspondientes esten correctamente llenados.');
            $('.lista_variables').html(lista_variables);
            var lista_variables = '';   
            lista_variables += '<ul>';
                for (datos in data.variables) {
                    lista_variables += '<li>' + data.variables[datos] + '</li>';
                }
            lista_variables += '</ul>';
            $('.lista_variables').html(lista_variables);
            //$('.error').html(data.error.xdebug_message);
          }
          else{
            $('#avisoFormatos-modal').modal('show');
            $('#avisoFormatos-modal .modal-title').html('Todo Bien');
            $('#avisoFormatos-modal .lista_variables').html('');
            $('#avisoFormatos-modal .mensaje').html('Archivo generado correctamente,   <a href="../formatos/descargar/asignacion_ajustadores/'+id+'"> click aqui para descargar </a>');
          }
      }
    })
  });

$('.btn-nuevoSolicitudProrrogaR').on('click',function()
  {
    var id = $(this).data('id');
    $.ajax({
      url: '../formatos/solicitud_prorroga/'+id,
      dataType:'json',
      type:'GET',

      success: function (data) {
          if (data.success==false) {
            $('#avisoFormatos-modal').modal('show');
            $('#avisoFormatos-modal .modal-title').html('Error');
            $('#avisoFormatos-modal .mensaje').html('Por favor asegurece que los campos correspondientes esten correctamente llenados.');
            $('.lista_variables').html(lista_variables);
            var lista_variables = '';   
            lista_variables += '<ul>';
                for (datos in data.variables) {
                    lista_variables += '<li>' + data.variables[datos] + '</li>';
                }
            lista_variables += '</ul>';
            $('.lista_variables').html(lista_variables);
            //$('.error').html(data.error.xdebug_message);
          }
          else{
            $('#formSolicitudProrroga-modal').modal('show');
          }
      }
    })
  });

$('.btn-nuevoAvisoSiniestroR').on('click',function()
  {
    var id = $(this).data('id');
    $.ajax({
      url: '../formatos/aviso_siniestro/'+id,
      dataType:'json',
      type:'GET',

      success: function (data) {
          if (data.success==false) {
            $('#avisoFormatos-modal').modal('show');
            $('#avisoFormatos-modal .modal-title').html('Error');
            $('#avisoFormatos-modal .mensaje').html('Por favor asegurece que los campos correspondientes esten correctamente llenados.');
            $('.lista_variables').html(lista_variables);
            var lista_variables = '';   
            lista_variables += '<ul>';
                for (datos in data.variables) {
                    lista_variables += '<li>' + data.variables[datos] + '</li>';
                }
            lista_variables += '</ul>';
            $('.lista_variables').html(lista_variables);
            //$('.error').html(data.error.xdebug_message);
          }
          else{
            $('#avisoFormatos-modal').modal('show');
            $('#avisoFormatos-modal .modal-title').html('Todo Bien');
            $('#avisoFormatos-modal .lista_variables').html('');
            $('#avisoFormatos-modal .mensaje').html('Archivo generado correctamente,   <a href="../formatos/descargar/aviso_siniestro/'+id+'"> click aqui para descargar </a>');
          }
      }
    })
  });

$('.btn-nuevoSolicitudDocumentosR').on('click',function()
  {
    var id = $(this).data('id');
    $.ajax({
      url: '../formatos/solicitud_documentos/'+id,
      dataType:'json',
      type:'GET',

      success: function (data) {
          if (data.success==false) {
            $('#avisoFormatos-modal').modal('show');
            $('#avisoFormatos-modal .modal-title').html('Error');
            $('#avisoFormatos-modal .mensaje').html('Por favor asegurece que los campos correspondientes esten correctamente llenados.');
            $('.lista_variables').html(lista_variables);
            var lista_variables = '';   
            lista_variables += '<ul>';
                for (datos in data.variables) {
                    lista_variables += '<li>' + data.variables[datos] + '</li>';
                }
            lista_variables += '</ul>';
            $('.lista_variables').html(lista_variables);
            //$('.error').html(data.error.xdebug_message);
          }
          else{
            $('#avisoFormatos-modal').modal('show');
            $('#avisoFormatos-modal .modal-title').html('Todo Bien');
            $('#avisoFormatos-modal .lista_variables').html('');
            $('#avisoFormatos-modal .mensaje').html('Archivo generado correctamente,   <a href="../formatos/descargar/solicitud_documentos/'+id+'"> click aqui para descargar </a>');
          }
      }
    })
  });

$('.btn-nuevoAveriguacionPreviaR').on('click',function()
  {
    var id = $(this).data('id');
    $.ajax({
      url: '../formatos/averiguacion_previa/'+id,
      dataType:'json',
      type:'GET',

      success: function (data) {
          if (data.success==false) {
            $('#avisoFormatos-modal').modal('show');
            $('#avisoFormatos-modal .modal-title').html('Error');
            $('#avisoFormatos-modal .mensaje').html('Por favor asegurece que los campos correspondientes esten correctamente llenados.');
            $('.lista_variables').html(lista_variables);
            var lista_variables = '';   
            lista_variables += '<ul>';
                for (datos in data.variables) {
                    lista_variables += '<li>' + data.variables[datos] + '</li>';
                }
            lista_variables += '</ul>';
            $('.lista_variables').html(lista_variables);
            //$('.error').html(data.error.xdebug_message);
          }
          else{
            $('#avisoFormatos-modal').modal('show');
            $('#avisoFormatos-modal .modal-title').html('Todo Bien');
            $('#avisoFormatos-modal .lista_variables').html('');
            $('#avisoFormatos-modal .mensaje').html('Archivo generado correctamente,   <a href="../formatos/descargar/averiguacion_previa/'+id+'"> click aqui para descargar </a>');
          }
      }
    })
  });

$('.btn-nuevoCartasReclamacionR').on('click',function()
  {
    var id = $(this).data('id');
    $.ajax({
      url: '../formatos/cartas_reclamacion/'+id,
      dataType:'json',
      type:'GET',

      success: function (data) {
          if (data.success==false) {
            $('#avisoFormatos-modal').modal('show');
            $('#avisoFormatos-modal .modal-title').html('Error');
            $('#avisoFormatos-modal .mensaje').html('Por favor asegurece que los campos correspondientes esten correctamente llenados.');
            $('.lista_variables').html(lista_variables);
            var lista_variables = '';   
            lista_variables += '<ul>';
                for (datos in data.variables) {
                    lista_variables += '<li>' + data.variables[datos] + '</li>';
                }
            lista_variables += '</ul>';
            $('.lista_variables').html(lista_variables);
            //$('.error').html(data.error.xdebug_message);
          }
          else{
            $('#avisoFormatos-modal').modal('show');
            $('#avisoFormatos-modal .modal-title').html('Todo Bien');
            $('#avisoFormatos-modal .lista_variables').html('');
            $('#avisoFormatos-modal .mensaje').html('Archivo generado correctamente,   <a href="../formatos/descargar/cartas_reclamacion/'+id+'"> click aqui para descargar </a>');
          }
      }
    })
  });

$('.btn-nuevoEdificioArrendadoR').on('click',function()
  {
    var id = $(this).data('id');
    $.ajax({
      url: '../formatos/edificio_arrendado/'+id,
      dataType:'json',
      type:'GET',

      success: function (data) {
          if (data.success==false) {
            $('#avisoFormatos-modal').modal('show');
            $('#avisoFormatos-modal .modal-title').html('Error');
            $('#avisoFormatos-modal .mensaje').html('Por favor asegurece que los campos correspondientes esten correctamente llenados.');
            $('.lista_variables').html(lista_variables);
            var lista_variables = '';   
            lista_variables += '<ul>';
                for (datos in data.variables) {
                    lista_variables += '<li>' + data.variables[datos] + '</li>';
                }
            lista_variables += '</ul>';
            $('.lista_variables').html(lista_variables);
            //$('.error').html(data.error.xdebug_message);
          }
          else{
            $('#avisoFormatos-modal').modal('show');
            $('#avisoFormatos-modal .modal-title').html('Todo Bien');
            $('#avisoFormatos-modal .lista_variables').html('');
            $('#avisoFormatos-modal .mensaje').html('Archivo generado correctamente,   <a href="../formatos/descargar/edificio_arrendado/'+id+'"> click aqui para descargar </a>');
          }
      }
    })
  });

$('.btn-nuevoTerceroAfectadoR').on('click',function()
  {
    var id = $(this).data('id');
    $.ajax({
      url: '../formatos/tercero_afectado/'+id,
      dataType:'json',
      type:'GET',

      success: function (data) {
          if (data.success==false) {
            $('#avisoFormatos-modal').modal('show');
            $('#avisoFormatos-modal .modal-title').html('Error');
            $('#avisoFormatos-modal .mensaje').html('Por favor asegurece que los campos correspondientes esten correctamente llenados.');
            $('.lista_variables').html(lista_variables);
            var lista_variables = '';   
            lista_variables += '<ul>';
                for (datos in data.variables) {
                    lista_variables += '<li>' + data.variables[datos] + '</li>';
                }
            lista_variables += '</ul>';
            $('.lista_variables').html(lista_variables);
            //$('.error').html(data.error.xdebug_message);
          }
          else{
            $('#avisoFormatos-modal').modal('show');
            $('#avisoFormatos-modal .modal-title').html('Todo Bien');
            $('#avisoFormatos-modal .lista_variables').html('');
            $('#avisoFormatos-modal .mensaje').html('Archivo generado correctamente,   <a href="../formatos/descargar/tercero_afectado/'+id+'"> click aqui para descargar </a>');
          }
      }
    })
  });

$('.btn-nuevoOfertaSalvamentoR').on('click',function()
  {
    var id = $(this).data('id');
    $.ajax({
      url: '../formatos/oferta_salvamento/'+id,
      dataType:'json',
      type:'GET',

      success: function (data) {
          if (data.success==false) {
            $('#avisoFormatos-modal').modal('show');
            $('#avisoFormatos-modal .modal-title').html('Error');
            $('#avisoFormatos-modal .mensaje').html('Por favor asegurece que los campos correspondientes esten correctamente llenados.');
            $('#avisoFormatos-modal .lista_variables').html(lista_variables);
            var lista_variables = '';   
            lista_variables += '<ul>';
                for (datos in data.variables) {
                    lista_variables += '<li>' + data.variables[datos] + '</li>';
                }
            lista_variables += '</ul>';
            $('.lista_variables').html(lista_variables);
            //$('.error').html(data.error.xdebug_message);
          }
          else{
            $('#avisoFormatos-modal').modal('show');
            $('#avisoFormatos-modal .modal-title').html('Todo Bien');
            $('#avisoFormatos-modal .lista_variables').html('');
            $('#avisoFormatos-modal .mensaje').html('Archivo generado correctamente,   <a href="../formatos/descargar/oferta_salvamento/'+id+'"> click aqui para descargar </a>');
          }
      }
    })
  });


$('.btn-editarFechasJ').on('click',function()
  {
    var id = $(this).data('id');
    $.ajax({
          url: '../sire/juridico/busqueda/juicio/'+id,
          dataType:'json',
          type:'GET',

          success: function (data) {
              if (data.success==false) {
                $(".editarFechasJ-modal #id").val(id);
              }
              else{
                $(".editarFechasJ-modal #fecha_contrato_rechazo").val(moment(data.juicio.fecha_contrato_rechazo).format('YYYY-MM-DD'));
                $(".editarFechasJ-modal #fecha_presentacion_demanda").val(moment(data.juicio.fecha_presentacion_demanda).format('YYYY-MM-DD'));
                $(".editarFechasJ-modal #fecha_radicacion_demanda").val(moment(data.juicio.fecha_radicacion_demanda).format('YYYY-MM-DD'));
                $(".editarFechasJ-modal #fecha_emplazamiento").val(moment(data.juicio.fecha_emplazamiento).format('YYYY-MM-DD'));
                $(".editarFechasJ-modal #fecha_contestacion_demanda").val(moment(data.juicio.fecha_contestacion_demanda).format('YYYY-MM-DD'));
                $(".editarFechasJ-modal #fecha_notificacion_contestacion_demanda").val(moment(data.juicio.fecha_notificacion_contestacion_demanda).format('YYYY-MM-DD'));
                $(".editarFechasJ-modal #fecha_desahogo_vista").val(moment(data.juicio.fecha_desahogo_vista).format('YYYY-MM-DD'));
                $(".editarFechasJ-modal #fecha_apertura_periodo_probatorio").val(moment(data.juicio.fecha_apertura_periodo_probatorio).format('YYYY-MM-DD'));
                $(".editarFechasJ-modal #fecha_ofrecimiento_pruebas").val(moment(data.juicio.fecha_ofrecimiento_pruebas).format('YYYY-MM-DD'));
                $(".editarFechasJ-modal #observaciones").val(data.juicio.observaciones);
                $(".editarFechasJ-modal #fecha_presentacion_alegatos").val(moment(data.juicio.fecha_presentacion_alegatos).format('YYYY-MM-DD'));
                $(".editarFechasJ-modal #fecha_citacion_sentencia").val(moment(data.juicio.fecha_citacion_sentencia).format('YYYY-MM-DD'));
                $(".editarFechasJ-modal #fecha_sentencia_primera_instancia").val(moment(data.juicio.fecha_sentencia_primera_instancia).format('YYYY-MM-DD'));
                $(".editarFechasJ-modal #fecha_notificacion_sentencia").val(moment(data.juicio.fecha_notificacion_sentencia).format('YYYY-MM-DD'));
                $(".editarFechasJ-modal #fecha_presentacion_recursos_apelacion").val(moment(data.juicio.fecha_presentacion_recursos_apelacion).format('YYYY-MM-DD'));
                $(".editarFechasJ-modal #fecha_recepcion_expediente_supremo_tribunal").val(moment(data.juicio.fecha_recepcion_expediente_supremo_tribunal).format('YYYY-MM-DD'));
                $(".editarFechasJ-modal #fecha_ejecutoria").val(moment(data.juicio.fecha_ejecutoria).format('YYYY-MM-DD'));
                $(".editarFechasJ-modal #fecha_notificacion_ejecutoria").val(moment(data.juicio.fecha_notificacion_ejecutoria).format('YYYY-MM-DD'));
                $(".editarFechasJ-modal #fecha_presentacion_amparo_directo").val(moment(data.juicio.fecha_presentacion_amparo_directo).format('YYYY-MM-DD'));
                $(".editarFechasJ-modal #fecha_resolucion_amparo").val(moment(data.juicio.fecha_resolucion_amparo).format('YYYY-MM-DD'));
                $(".editarFechasJ-modal #fecha_interposicion_incidente_liquidacion_suerte_principal").val(moment(data.juicio.fecha_interposicion_incidente_liquidacion_suerte_principal).format('YYYY-MM-DD'));
                $(".editarFechasJ-modal #fecha_pago_suerte_principal").val(moment(data.juicio.fecha_pago_suerte_principal).format('YYYY-MM-DD'));
                $(".editarFechasJ-modal #fecha_interposicion_incidente_liquidacion_intereses").val(moment(data.juicio.fecha_interposicion_incidente_liquidacion_intereses).format('YYYY-MM-DD'));
                $(".editarFechasJ-modal #fecha_pago_intereses").val(moment(data.juicio.fecha_pago_intereses).format('YYYY-MM-DD'));
                $(".editarFechasJ-modal #fecha_interposicion_incidente_costas").val(moment(data.juicio.fecha_interposicion_incidente_costas).format('YYYY-MM-DD'));
                $(".editarFechasJ-modal #fecha_pago_incidente_costas").val(moment(data.juicio.fecha_pago_incidente_costas).format('YYYY-MM-DD'));
                $(".editarFechasJ-modal #fecha_ultimo_seguimiento").val(moment(data.juicio.fecha_ultimo_seguimiento).format('YYYY-MM-DD'));
                $(".editarFechasJ-modal #observaciones_ultimo_seguimiento").val(data.juicio.observaciones_ultimo_seguimiento);
                $(".editarFechasJ-modal #actividad_realizar_ultimo_seguimiento").val(data.juicio.actividad_realizar_ultimo_seguimiento);
                $(".editarFechasJ-modal #fecha_conclusion").val(moment(data.juicio.fecha_conclusion).format('YYYY-MM-DD'));
                $(".editarFechasJ-modal #id").val(id);
                
              }
          }
      })
  });

$('.btn-editarAcuerdoJ').on('click',function()
  {
    var id = $(this).data('id');
    $.ajax({
          url: '../busqueda/acuerdo/'+id,
          dataType:'json',
          type:'GET',

          success: function (data) {
              if (data.success==false) {
                $(".editarAcuerdoJ-modal #id").val(id);
              }
              else{
                $(".editarAcuerdoJ-modal #mes").val(data.acuerdo.mes);
                $(".editarAcuerdoJ-modal #año").val(data.acuerdo.año);
                $(".editarAcuerdoJ-modal #acuerdo").val(data.acuerdo.acuerdo);
                $(".editarAcuerdoJ-modal #detalle").val(data.acuerdo.detalle);
                $(".editarAcuerdoJ-modal #fecha_publicacion").val(moment(data.acuerdo.fecha_publicacion).format('YYYY-MM-DD'));
                $(".editarAcuerdoJ-modal #fecha_surte_efecto").val(moment(data.acuerdo.fecha_surte_efecto).format('YYYY-MM-DD'));
                $(".editarAcuerdoJ-modal #fecha_vencimiento_impulso").val(moment(data.acuerdo.fecha_vencimiento_impulso).format('YYYY-MM-DD'));
                $(".editarAcuerdoJ-modal #fecha_impulso").val(moment(data.acuerdo.fecha_impulso).format('YYYY-MM-DD'));
                $(".editarAcuerdoJ-modal #fecha_limite_acuerdo_impulso").val(moment(data.acuerdo.fecha_limite_acuerdo_impulso).format('YYYY-MM-DD'));
                $(".editarAcuerdoJ-modal #fecha_acuerdo_impulso").val(moment(data.acuerdo.fecha_acuerdo_impulso).format('YYYY-MM-DD'));
                $(".editarAcuerdoJ-modal #id").val(id);
                
              }
          }
      })
  });


});



