$(function(){

  

  $('.btnAddTareaCompromiso').on('click',function()
  {
    var id_compromiso = $(this).data('id');
    $(".modal-body #id_compromiso").val( id_compromiso );
      
  });

  $('.btnEditarCompromiso').on('click',function()
  {
    var id = $(this).data('id');
    

    $.ajax({
          url: 'compromisos/editar/'+id,
          dataType:'json',
          type:'GET',

          success: function (data) {
              if (data.success==false) {
                  alert("error");
              }
              else{
                $(".modal-body #id_compromiso").val( id );
                $(".modal-body #compromiso").val( data.compromiso );
              }
          }
      })
      
  });

$('.btnListaTareasCompromisos').on('click',function()
  {
    var id= $(this).data('id');
    $.ajax({
          url: 'compromisos/tareas/'+id,
          dataType:'json',
          type:'GET',

          success: function (data) {
              if (data.success==false) {
                  alert("error");
              }
              else{
                  //tabla que muestra las tareas
                      $('.tabla_tareas').html(lista_tareas);
                      var lista_tareas = '';   
                      lista_tareas += '<table class="table">';
                      lista_tareas += '<thead>';
                      lista_tareas += '<tr>';
                      lista_tareas += '<th> Id </th>';
                      lista_tareas += '<th> Responsable </th>';
                      lista_tareas += '<th> Tarea </th>';
                      lista_tareas += '<th> Fecha </th>';
                      lista_tareas += '<th> Estado </th>';
                      lista_tareas += '<th> Indicador </th>';
                      lista_tareas += '</tr>';
                      lista_tareas += '</thead>';
                      lista_tareas += '<tbody>';
                        for(datos in data.tareas){
                            lista_tareas += '<tr>'+ '<td>' +  data.tareas[datos].id + '</td>' + '<td>' +  data.tareas[datos].nombre_responsable + '</td>' + '<td>' +  data.tareas[datos].tarea + '</td>' + '<td>' +  data.tareas[datos].fecha + '</td>' + '<td>' +  data.tareas[datos].estado + '</td>' + '<td>' +  data.tareas[datos].indicador + '</td>' + '</tr>';
                        }
                      lista_tareas += '</tbody>';
                      lista_tareas += '</table>';
                      $('.tabla_tareas').html(lista_tareas);
              }
          }
      })
      
  });

    //reporte por departamento
    $('#btn_Rcompromisos').on('click',function()
    {
      
      var fecha_de = document.getElementById("fecha_de").value;
      var fecha_hasta = document.getElementById("fecha_hasta").value;
      var departamento = document.getElementById("departamento").value;
     

      var parametros = {
                "departamento" : departamento,
                "fecha_de" : fecha_de,
                "fecha_hasta" : fecha_hasta
        };

      $.ajax({
            data:  parametros,
            url: 'reportes/ajax',
            dataType:'json',
            type:'get',

            success: function (data) {
                if (data.success==false) {
                    alert("error");
                }
                else{

                    var compromisos_total = data.compromisos_total;
                    var compromisos_cumplidos = data.compromisos_cumplidos;
                    var compromisos_nocumplidos = data.compromisos_nocumplidos;
                    var tareas_completadas_total = data.tareas_completadas_total;

                    $('.compromisos_total').html(compromisos_total);
                    $('.compromisos_cumplidos').html(compromisos_cumplidos);
                    $('.compromisos_nocumplidos').html(compromisos_nocumplidos);

                    // Create the data table. Grafica de cumplimiento
                    var data_cumplimiento = new google.visualization.DataTable();
                    data_cumplimiento.addColumn('string', 'Porcentaje');
                    data_cumplimiento.addColumn('number', 'Valor');
                    data_cumplimiento.addRows([
                      ['Cumplidos', compromisos_cumplidos],
                      ['No Cumplidos', compromisos_nocumplidos]
                    ]);

                    // Set chart options
                    var options_cumplimiento = {
                                  };

                    // Instantiate and draw our chart, passing in some options.
                    var chart = new google.visualization.PieChart(document.getElementById('chart_cumplimiento'));
                    chart.draw(data_cumplimiento, options_cumplimiento);

                    
                    //tabla que muestra las tareas cumplidas a tiempo
                    $('.tabla_compromisos').html(tabla_compromisos);
                    var tabla_compromisos = '';   
                    tabla_compromisos += '<table class="table">';
                    tabla_compromisos += '<thead>';
                    tabla_compromisos += '<tr>';
                    tabla_compromisos += '<th> Compromiso </th>';
                    tabla_compromisos += '<th> Responsable </th>';
                    tabla_compromisos += '<th> Fecha Compromiso </th>';
                    tabla_compromisos += '<th> Semana sin Cumplir </th>';
                    tabla_compromisos += '<th> Cumplido </th>';
                    tabla_compromisos += '</tr>';
                    tabla_compromisos += '</thead>';
                    tabla_compromisos += '<tbody>';

                      for(datos in data.compromisos){

                            var date1 = moment(data.compromisos[datos].fecha);
                            var date2 = moment(fecha_de);
                            var sdesfase = date2.diff(date1,"weeks");
                            tabla_compromisos  += '<tr>'+ '<td>' +  data.compromisos[datos].compromiso + '</td>' + '<td>' +  data.compromisos[datos].nombre + ' ' + data.compromisos[datos].apellido + '</td>' + '<td>' +  data.compromisos[datos].fecha + '</td>' + '<td>' + sdesfase + '</td>' + '<td>' +  data.compromisos[datos].cumplido + '</td>' + '</tr>';
                      }

                    tabla_compromisos += '</tbody>';
                    tabla_compromisos += '</table>';
                    $('.tabla_compromisos').html(tabla_compromisos);


                }
            }
        })
    });

    $('#btn_BuscarIndicadores').on('click',function()
    {
      
      var mes = document.getElementById("mes").value;
      var año = document.getElementById("año").value;
     

      var parametros = {
                "mes" : mes,
                "año" : año,
        };

      $.ajax({
            data:  parametros,
            url: 'indicadores/ajax',
            dataType:'json',
            type:'get',

            success: function (data) {
                if (data.success==false) {
                    alert("error");
                }
                else{

                    var ind_prom = data.ind_prom;
                    var ind_prom_count = data.ind_prom_count;
                    var ind_recl = data.ind_recl;
                    var ind_recl_count = data.ind_recl_count;
                    var ind_cobr = data.ind_cobr;
                    var ind_cobr_count = data.ind_cobr_count;
                    var ind_jur = data.ind_jur;
                    var ind_jur_count = data.ind_jur_count;

                    /*if (indicadores === undefined || indicadores.length == 0) {
                      alert("vacio");
                    };*/

                }
            }
        })
    });

    $('.btnEditarObj').on('click',function()
      {
        var id_departamento = $(this).data('id');
        var mes = document.getElementById("mes").value;
        var año = document.getElementById("año").value;

        var parametros = {
                "mes" : mes,
                "año" : año,
                "id_departamento" : id_departamento,
        };

        $.ajax({
              data:  parametros,
              url: 'indicadores/editarobj',
              dataType:'json',
              type:'get',

              success: function (data) {
                  if (data.success==false) {
                      alert("error");
                  }
                  else{

                    var nom_dpto = data.nom_dpto;
                    $('.nom_dpto').html(nom_dpto);

                    $('.objdpto').html(objdpto);
                    var objdpto = '';
                    for(datos in data.ind_dpto){
                      objdpto += '<div class="col-md-12">';
                      objdpto += '<div class="form-group">';
                      objdpto += '<label for="objetivo" class="col-sm-4 control-label">'+ data.ind_dpto[datos].indicador +'</label>';
                      objdpto += '<div class="col-sm-1">';
                      objdpto += '<input type="text" class="form-control" id="objetivo" name="objetivo[]" value="'+ data.ind_dpto[datos].objetivo +'" autocomplete="off" required>';
                      objdpto += '</div>';
                      objdpto += '</div>';
                      objdpto += '</div>';
                      objdpto += '<div class="hidden">';
                      objdpto += '<input type="text" name="id_indicador[]" id="id_indicador" value="'+ data.ind_dpto[datos].id_indicador +'"/>';
                      objdpto += '</div>';
                    }

                    $('.objdpto').html(objdpto);


                  }
              }
          })
          
      });

    $('.btnAddCumplido').on('click',function()
      {
        var id_departamento = $(this).data('id');
        var mes = document.getElementById("mes").value;
        var año = document.getElementById("año").value;

        var parametros = {
                "mes" : mes,
                "año" : año,
                "id_departamento" : id_departamento,
        };

        $.ajax({
              data:  parametros,
              url: 'indicadores/addcumplido',
              dataType:'json',
              type:'get',

              success: function (data) {
                  if (data.success==false) {
                      alert("error");
                  }
                  else{

                    var nom_dpto_c = data.nom_dpto_c;
                    $('.nom_dpto_c').html(nom_dpto_c);

                    $('.cumplidodpo').html(cumplidodpo);
                    var cumplidodpo = '';
                    for(datos in data.cumplido_dpto){
                      cumplidodpo += '<div class="col-md-12">';
                      cumplidodpo += '<div class="form-group">';
                      cumplidodpo += '<label for="objetivo" class="col-sm-4 control-label">'+ data.cumplido_dpto[datos].indicador +'</label>';
                      cumplidodpo += '<label for="objetivo" class="col-sm-1 control-label"> S1 </label>';
                      cumplidodpo += '<div class="col-sm-1">';
                      cumplidodpo += '<input type="text" class="form-control" id="s1" name="s1[]" value="'+ data.cumplido_dpto[datos].semana1 +'" autocomplete="off" required>';
                      cumplidodpo += '</div>';
                      cumplidodpo += '<label for="objetivo" class="col-sm-1 control-label"> S2 </label>';
                      cumplidodpo += '<div class="col-sm-1">';
                      cumplidodpo += '<input type="text" class="form-control" id="s2" name="s2[]" value="'+ data.cumplido_dpto[datos].semana2 +'" autocomplete="off" required>';
                      cumplidodpo += '</div>';
                      cumplidodpo += '<label for="objetivo" class="col-sm-1 control-label"> S3 </label>';
                      cumplidodpo += '<div class="col-sm-1">';
                      cumplidodpo += '<input type="text" class="form-control" id="s3" name="s3[]" value="'+ data.cumplido_dpto[datos].semana3 +'" autocomplete="off" required>';
                      cumplidodpo += '</div>';
                      cumplidodpo += '<label for="objetivo" class="col-sm-1 control-label"> S4 </label>';
                      cumplidodpo += '<div class="col-sm-1">';
                      cumplidodpo += '<input type="text" class="form-control" id="s4" name="s4[]" value="'+ data.cumplido_dpto[datos].semana4 +'" autocomplete="off" required>';
                      cumplidodpo += '</div>';
                      cumplidodpo += '</div>';
                      cumplidodpo += '</div>';
                      cumplidodpo += '<div class="hidden">';
                      cumplidodpo += '<input type="text" name="id_indicador[]" id="id_indicador" value="'+ data.cumplido_dpto[datos].id_indicador +'"/>';
                      cumplidodpo += '</div>';
                    }

                    $('.cumplidodpo').html(cumplidodpo);


                  }
              }
          })
          
      });


});

// Load the Visualization API and the piechart package.
google.load('visualization', '1.0', {'packages':['corechart']});