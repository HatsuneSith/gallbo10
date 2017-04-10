$(document).ready(function(){

    //Funcion para cambiar los select si la pagina se abre en un dispositivo movil.
    var dispositivo = navigator.userAgent.toLowerCase();
    if( dispositivo.search(/iphone|ipod|ipad|android/) > -1 ){

      
      $.ajax({

          url: 'array_usuarios',
          dataType:'json',
          type:'get',

          success: function (data) {
              if (data.success==false) {
                  alert("error");
              }
              else{
                var id_responsable = document.getElementById("id_responsable").value;
                var estado = document.getElementById("estado").value;
                var indicador = document.getElementById("indicador").value;

                $('.form-select').html(formselect);
                var formselect = '';
                formselect += '<label for="id_responsable" aria-hidden="true">Responsable: </label>';
                formselect += '<input id="id_responsable"  name="id_responsable" placeholder="Seleccione un responsable" class="form-control" aria-label="Seleccione un responsable" style="width: 100%;">';
                //formselect += '<input id="id_responsable" data-bind="value: selectedId, source: responsables" name="id_responsable" placeholder="Seleccione un responsable" class="form-control" aria-label="Seleccione un responsable" style="width: 100%;" />'
                $('.form-select').html(formselect);

                /*$("#id_responsable").kendoComboBox({
                  valuePrimitive: true,
                  dataTextField: "text",
                  dataValueField: "value",
                  filter: "contains",
                  suggest: true
                });

                var responsables = [];
                for(datos in data.usuarios){
                  responsables.push({ text: data.usuarios[datos].nombre + ' ' +data.usuarios[datos].apellido, value: data.usuarios[datos].id});                
                }

                var viewModel = kendo.observable({
                  selectedId: id_responsable,
                  responsables
                });

                kendo.bind($("#id_responsable"), viewModel);
                */

                var responsables = [];
                for(datos in data.usuarios){
                  responsables.push({ text: data.usuarios[datos].nombre + ' ' +data.usuarios[datos].apellido, value: data.usuarios[datos].id});                
                }
      
                $("#id_responsable").kendoComboBox({
                    dataTextField: "text",
                    dataValueField: "value",
                    dataSource: responsables,
                    filter: "contains",
                    suggest: true
                });

                $('.formmes').html(formmes);
                var formmes = '';
                formmes += '<label for="mes" aria-hidden="true">Fecha Mes: </label>';
                formmes += '<input id="mes"  name="mes" class="form-control" style="width: 100%;">';
                $('.formmes').html(formmes);

                var mes_actual = data.mes_actual;
                var meses = [
                {text: 'Enero', value: '01'},
                {text: 'Febrero', value: '02'},
                {text: 'Marzo', value: '03'},
                {text: 'Abril', value: '04'},
                {text: 'Mayo', value: '05'},
                {text: 'Junio', value: '06'},
                {text: 'Julio', value: '07'},
                {text: 'Agosto', value: '08'},
                {text: 'Septiembre', value: '09'},
                {text: 'Octubre', value: '10'},
                {text: 'Noviembre', value: '11'},
                {text: 'Diciembre', value: '12'}
                ];

                if (mes_actual == '01') {var selected = 0};
                if (mes_actual == '02') {var selected = 1};
                if (mes_actual == '03') {var selected = 2};
                if (mes_actual == '04') {var selected = 3};
                if (mes_actual == '05') {var selected = 4};
                if (mes_actual == '06') {var selected = 5};
                if (mes_actual == '07') {var selected = 6};
                if (mes_actual == '08') {var selected = 7};
                if (mes_actual == '09') {var selected = 8};
                if (mes_actual == '10') {var selected = 9};
                if (mes_actual == '11') {var selected = 10};
                if (mes_actual == '12') {var selected = 11};
                
      
                $("#mes").kendoComboBox({
                    dataTextField: "text",
                    dataValueField: "value",
                    dataSource: meses,
                    filter: "contains",
                    suggest: true,
                    index: selected
                    
                });

                $('.formaño').html(formaño);
                var formaño = '';
                formaño += '<label for="año" aria-hidden="true">Fecha Año: </label>';
                formaño += '<input id="año"  name="año" class="form-control" style="width: 100%;">';
                $('.formaño').html(formaño);

                var año_actual = data.año_actual;
                var años = [
                  {text: año_actual, value: año_actual},
                  {text: parseInt(año_actual)+1, value: parseInt(año_actual)+1},
                  {text: parseInt(año_actual)+2, value: parseInt(año_actual)+2},
                ];

                $("#año").kendoComboBox({
                    dataTextField: "text",
                    dataValueField: "value",
                    dataSource: años,
                    filter: "contains",
                    suggest: true,
                    index: 0
                });

                //ComboBox Estado
                /*$('.form-estado').html(formestado);
                var formestado = '';
                formestado += '<label for="estado" aria-hidden="true">Estado: </label>';
                formestado += '<input id="estado" data-bind="value: selectedEd, source: estados" name="estado" placeholder="Seleccione un Estado" class="form-control" aria-label="Seleccione un estado" style="width: 100%;" />'
                $('.form-estado').html(formestado);

                $("#estado").kendoComboBox({
                  valuePrimitive: true,
                  dataTextField: "text",
                  dataValueField: "value",
                  filter: "contains",
                  suggest: true
                });

                var estados = [];
                estados.push({ text: 'Seleccione un estado', value: ''});           
                estados.push({ text: 'Sin Ver', value: 'Sin Ver'});
                estados.push({ text: 'Tramite', value: 'Tramite'});
                estados.push({ text: 'Vencido', value: 'Vencido'});
                estados.push({ text: 'Concluida A Tiempo', value: 'Concluida A Tiempo'});
                estados.push({ text: 'Concluida A Destiempo', value: 'Concluida A Destiempo'});
                estados.push({ text: 'Todos', value: ''});

                var viewModelE = kendo.observable({
                  selectedEd: estado,
                  estados
                });
                kendo.bind($("#estado"), viewModelE);

                //ComboBox Indicador
                $('.form-indicador').html(formindicador);
                var formindicador = '';
                formindicador += '<label for="indicador" aria-hidden="true">Indicador: </label>';
                formindicador += '<input id="indicador" data-bind="value: selectedEd, source: indicadores" name="indicador" placeholder="Seleccione un Indicador" class="form-control" aria-label="Seleccione un indicador" style="width: 100%;" />'
                $('.form-indicador').html(formindicador);

                $("#indicador").kendoComboBox({
                  valuePrimitive: true,
                  dataTextField: "text",
                  dataValueField: "value",
                  filter: "contains",
                  suggest: true
                });

                var indicadores = [];
                indicadores.push({ text: 'Seleccione un indicador', value: ''});           
                indicadores.push({ text: 'Amarillo', value: 'Amarillo'});
                indicadores.push({ text: 'Naranja', value: 'Naranja'});
                indicadores.push({ text: 'Rojo', value: 'Rojo'});
                indicadores.push({ text: 'Verde', value: 'Verde'});
                indicadores.push({ text: 'Todos', value: ''});

                var viewModelE = kendo.observable({
                  selectedEd: indicador,
                  indicadores
                });
                kendo.bind($("#indicador"), viewModelE);
                */
                  

              }
          }
      })

    };

});

$(function(){

  $('.datetimepicker1').datetimepicker({
    locale: 'es',
    format: 'DD/MM/YYYY HH:mm',
    sideBySide: true
  });



  //funcion para desabilitar el boton submit al presionar.
  //evitamos que el usuario lo presione dos veces y se dupliquen los registros al guardar.
  $('#btnSubmit').on('click',function()
  {
    document.getElementById("btnSubmit").value = "Guardando...";
    document.getElementById("btnSubmit").className = "btn btn-success disabled";
      
  });

  $('.btnConcluir').on('click',function()
  {
    var id = $(this).attr('value');
    var btn = this;

    $(this).attr('class', 'btnConcluir btn btn-success btn-xs disabled');
    btn.innerHTML = 'Actualizando..';

    $.ajax({
          url: 'actualizar/concluida/'+id,
          dataType:'json',
          type:'GET',

          success: function (data) {
              if (data.success==false) {
                  alert("error");
              }
              else{
                  var objFecha = new Date();
                  objFecha.setTime(objFecha.getTime()+(10*1000));
                  var strExpiracion=objFecha.toGMTString();
                  document.cookie='success=success;expires='+strExpiracion+'path=/';
                  location.reload();
              }
          }
      })
      
  });

  $('.btnEliminar').on('click',function()
  {
    
    var id= $(this).attr('value');
    var btn = this;

    $(this).attr('class', 'btnEliminar btn btn-danger btn-xs disabled');
    btn.innerHTML = 'Eliminando..';

    $.ajax({
          url: 'eliminar/'+id,
          dataType:'json',
          type:'GET',

          success: function (data) {
              if (data.success==false) {
                  alert("error");
              }
              else{
                  location.reload();
              }
          }
      })
      
  });

  //btn para eliminar usuarios
  $('.btnEliminarUser').on('click',function()
  {
    
    var id= $(this).attr('value');
    var btn = this;

    $(this).attr('class', 'btnEliminarUser btn btn-danger btn-xs disabled');
    btn.innerHTML = 'Eliminando..';

    $.ajax({
          url: 'usuarios/eliminar/'+id,
          dataType:'json',
          type:'GET',

          success: function (data) {
              if (data.success==false) {
                  alert("error");
              }
              else{
                  location.reload();
              }
          }
      })
      
  });

  //btn para cambiar contraseña
  $('.btnChangePass').on('click',function()
    {
      var id_usuario = $(this).data('id');
      $(".modal-body #id_usuario").val( id_usuario );
        
    });


    function limpiar(){
      document.getElementById('formulario_tareas').reset();
      $('#formulario_tareas > span').empty();
      $('#mensaje').empty();
      
    }
    //Se mandaa a llamar las funciones
    $('#btn_agregar_tarea').on('click',function()
    {
        AgregarTarea_ajax();
        
    });

    $('#btn_cerrar').on('click',function()
    {
        limpiar();
        
    });

    function AgregarTarea_ajax()
    {
      $.ajax({
        url: 'tareas/crear',
        dataType: 'json',
        type:'post',
        data: $('#formulario_tareas').serialize(), //Se obtienen los datos del formulario
          success: function(data)
          {
            
            //Donde se vana  mostrar los errores
            $('#_id_responsable, #_tarea #_objetivo, #_fecha ').text('');
              //Si la respuesta de ajax es false se hace esto
              if(data.success == false){
              $.each(data.errors, function(index, value)
              {                  
                $('#_'+index).text(value);
                $('#mensaje').text("Verifica los datos*");
              
              });
                
              }
              //Si la respuesta del ajax es verdadero se hace esto
              else
              {
                $('#mensaje').text("Agregado con éxito");
                window.location = 'tareas';
              }
          },
         
      });
    }

    $('#btn_cambiarpass').on('click',function()
    {
          $('.form_password').html(form_password);
          var form_password = '';
          form_password += '<form method="POST" action="cambiarpassword">';
          form_password += '<div class="row"><div class="col-xs-8 col-sm-4 col-md-4"><div class="form-group">';
          form_password += '<label for="password_anterior">Contraseña Anterior</label>';
          form_password += '<input type="password" class="form-control" name="password_anterior" id="password_anterior" placeholder="Contraseña Anterior">';
          form_password += '</div></div></div>';
          form_password += '<div class="row"><div class="col-xs-8 col-sm-4 col-md-4"><div class="form-group">';
          form_password += '<label for="password_nueva">Contraseña Nueva</label>';
          form_password += '<input type="password" class="form-control" name="password_nueva" id="password_nueva" placeholder="Contraseña Nueva">';
          form_password += '</div></div></div>';
          form_password += '<button type="submit" class="btn btn-default">Aceptar</button>';
          form_password += '</form>';
          $('.form_password').html(form_password);
    })

    $('#btn_cambiarfecha').on('click',function()
    {
      document.getElementById("form_fecha").className = "";
      document.getElementById("btn_cambiarfecha").className = "btn btn-primary hidden";
    })


    $('#btn_cancelarfecha').on('click',function()
    {
      document.getElementById("form_fecha").className = "hidden";
      document.getElementById("btn_cambiarfecha").className = "btn btn-primary";
    })

    $('#check_prog').click(function() {
        $("#masopciones").toggle(this.checked);
    });

    //reporte por usuario
    $('#btn_reporteu').on('click',function()
    {
      var id_responsable = document.getElementById("id_responsable").value;
      var fecha_de = document.getElementById("fecha_de").value;
      var fecha_hasta = document.getElementById("fecha_hasta").value;

      var parametros = {
                "id_responsable" : id_responsable,
                "fecha_de" : fecha_de,
                "fecha_hasta" : fecha_hasta
        };

      $.ajax({
            data:  parametros,
            url: 'usuarios_ajax',
            dataType:'json',
            type:'get',

            success: function (data) {
                if (data.success==false) {
                    alert("error");
                }
                else{

                    var tareas_total = data.tareas_total;
                    var tareas_autoasignadas_en = data.tareas_autoasignadas_en;
                    var tareas_autoasignadas_para = data.tareas_autoasignadas_para;
                    var tareas_completadas_tiempo = data.tareas_completadas_tiempo;
                    var tareas_completadas_destiempo = data.tareas_completadas_destiempo;
                    var tareas_completadas_total = data.tareas_completadas_total;
                    var tareas_vencidas = data.tareas_vencidas;
                    var tareas_completadas_en = data.tareas_completadas_en;

                    $('.tareas_total').html(tareas_total);
                    $('.tareas_autoasignadas_en').html(tareas_autoasignadas_en);
                    $('.tareas_autoasignadas_para').html(tareas_autoasignadas_para);
                    $('.tareas_completadas').html(tareas_completadas_total);
                    $('.tareas_destiempo').html(tareas_completadas_destiempo);
                    $('.tareas_vencidas').html(tareas_vencidas);
                    $('.tareas_completadas_en').html(tareas_completadas_en);

                    // Create the data table. Grafica de cumplimiento
                    var data_cumplimiento = new google.visualization.DataTable();
                    data_cumplimiento.addColumn('string', 'Porcentaje');
                    data_cumplimiento.addColumn('number', 'Valor');
                    data_cumplimiento.addRows([
                      ['Concluidas', tareas_completadas_total],
                      ['Vencidas', tareas_vencidas]
                    ]);

                    // Set chart options
                    var options_cumplimiento = {
                                  };

                    // Instantiate and draw our chart, passing in some options.
                    var chart = new google.visualization.PieChart(document.getElementById('chart_cumplimiento'));
                    chart.draw(data_cumplimiento, options_cumplimiento);

                    // Create the data table. Grafica de Desfase
                    var data_desfase = new google.visualization.DataTable();
                    data_desfase.addColumn('string', 'Porcentaje');
                    data_desfase.addColumn('number', 'Valor');
                    data_desfase.addRows([
                      ['A Tiempo', tareas_completadas_tiempo],
                      ['Destiempo', tareas_completadas_destiempo],
                    ]);

                    // Set chart options
                    var options_desfase = {};
 
                    // Instantiate and draw our chart, passing in some options.
                    var chart = new google.visualization.PieChart(document.getElementById('chart_desfase'));
                    chart.draw(data_desfase, options_desfase);

                    //tabla que muestra las tareas cumplidas en ese periodo
                    $('.tabla_en_ese_tiempo').html(tareas_eneseperiodo);
                    var tareas_eneseperiodo = '';   
                    tareas_eneseperiodo += '<table class="table">';
                    tareas_eneseperiodo += '<thead>';
                    tareas_eneseperiodo += '<tr>';
                    tareas_eneseperiodo += '<th> Id </th>';
                    tareas_eneseperiodo += '<th> Tarea </th>';
                    tareas_eneseperiodo += '<th> Objetivo </th>';
                    tareas_eneseperiodo += '<th> Fecha Asignada </th>';
                    tareas_eneseperiodo += '<th> Fecha Concluida </th>';
                    tareas_eneseperiodo += '</tr>';
                    tareas_eneseperiodo += '</thead>';
                    tareas_eneseperiodo += '<tbody>';
                      for(datos in data.tareas_concluidas_en_ese_periodo){
                          tareas_eneseperiodo += '<tr>'+ '<td>' +  data.tareas_concluidas_en_ese_periodo[datos].id + '</td>' + '<td>' +  data.tareas_concluidas_en_ese_periodo[datos].tarea + '</td>' + '<td>' +  data.tareas_concluidas_en_ese_periodo[datos].objetivo + '</td>' + '<td>' +  data.tareas_concluidas_en_ese_periodo[datos].fecha + '</td>' + '<td>' +  data.tareas_concluidas_en_ese_periodo[datos].fecha_concluida + '</td>' + '</tr>';
                      }
                    tareas_eneseperiodo += '</tbody>';
                    tareas_eneseperiodo += '</table>';
                    $('.tabla_en_ese_tiempo').html(tareas_eneseperiodo);

                    //tabla que muestra las tareas cumplidas a tiempo
                    $('.tabla_atiempo').html(tareas_atiempo);
                    var tareas_atiempo = '';   
                    tareas_atiempo += '<table class="table">';
                    tareas_atiempo += '<thead>';
                    tareas_atiempo += '<tr>';
                    tareas_atiempo += '<th> Id </th>';
                    tareas_atiempo += '<th> Tarea </th>';
                    tareas_atiempo += '<th> Objetivo </th>';
                    tareas_atiempo += '<th> Fecha Asignada </th>';
                    tareas_atiempo += '<th> Fecha Concluida </th>';
                    tareas_atiempo += '</tr>';
                    tareas_atiempo += '</thead>';
                    tareas_atiempo += '<tbody>';
                      for(datos in data.tareas){
                        if (data.tareas[datos].estado == 'Concluida A Tiempo') {
                            tareas_atiempo += '<tr>'+ '<td>' +  data.tareas[datos].id + '</td>' + '<td>' +  data.tareas[datos].tarea + '</td>' + '<td>' +  data.tareas[datos].objetivo + '</td>' + '<td>' +  data.tareas[datos].fecha + '</td>' + '<td>' +  data.tareas[datos].fecha_concluida + '</td>' + '</tr>';
                        }
                      }
                    tareas_atiempo += '</tbody>';
                    tareas_atiempo += '</table>';
                    $('.tabla_atiempo').html(tareas_atiempo);

                    //tabla que muestra las tareas cumplidas despues del tiempo
                    $('.tabla_destiempo').html(tareas_destiempo);
                    var tareas_destiempo = '';   
                    tareas_destiempo += '<table class="table">';
                    tareas_destiempo += '<thead>';
                    tareas_destiempo += '<tr>';
                    tareas_destiempo += '<th> Id </th>';
                    tareas_destiempo += '<th> Tarea </th>';
                    tareas_destiempo += '<th> Objetivo </th>';
                    tareas_destiempo += '<th> Fecha Asignada </th>';
                    tareas_destiempo += '<th> Fecha Concluida </th>';
                    tareas_destiempo += '</tr>';
                    tareas_destiempo += '</thead>';
                    tareas_destiempo += '<tbody>';
                      for(datos in data.tareas){
                        if (data.tareas[datos].estado == 'Concluida A Destiempo')  {
                            tareas_destiempo += '<tr>'+ '<td>' +  data.tareas[datos].id + '</td>' + '<td>' +  data.tareas[datos].tarea + '</td>' + '<td>' +  data.tareas[datos].objetivo + '</td>' + '<td>' +  data.tareas[datos].fecha + '</td>' + '<td>' +  data.tareas[datos].fecha_concluida + '</td>' + '</tr>';
                        }
                      }
                    tareas_destiempo += '</tbody>';
                    tareas_destiempo += '</table>';
                    $('.tabla_destiempo').html(tareas_destiempo);

                    //tabla que muestra las tareas vencidas
                    $('.tabla_vencidas').html(tareas_vencidas);
                    var tareas_vencidas = '';   
                    tareas_vencidas += '<table class="table">';
                    tareas_vencidas += '<thead>';
                    tareas_vencidas += '<tr>';
                    tareas_vencidas += '<th> Id </th>';
                    tareas_vencidas += '<th> Tarea </th>';
                    tareas_vencidas += '<th> Objetivo </th>';
                    tareas_vencidas += '<th> Fecha Asignada </th>';
                    tareas_vencidas += '<th> Fecha Concluida </th>';
                    tareas_vencidas += '</tr>';
                    tareas_vencidas += '</thead>';
                    tareas_vencidas += '<tbody>';
                      for(datos in data.tareas){
                        if (data.tareas[datos].estado == 'Vencido') {
                            tareas_vencidas += '<tr>'+ '<td>' +  data.tareas[datos].id + '</td>' + '<td>' +  data.tareas[datos].tarea + '</td>' + '<td>' +  data.tareas[datos].objetivo + '</td>' + '<td>' +  data.tareas[datos].fecha + '</td>' + '<td>' +  data.tareas[datos].fecha_concluida + '</td>' + '</tr>';
                        }
                      }
                    tareas_vencidas += '</tbody>';
                    tareas_vencidas += '</table>';
                    $('.tabla_vencidas').html(tareas_vencidas);

                }
            }
        })
    })

    $('#btn_reporteu_pdf').on('click',function()
    {
      //document.getElementById("btn_reporteu_pdf").value = "Generando PDF...";
      //document.getElementById("btn_reporteu_pdf").className = "btn btn-success btn-block disabled";

      var id_responsable = document.getElementById("id_responsable").value;
      var fecha_de = document.getElementById("fecha_de").value;
      var fecha_hasta = document.getElementById("fecha_hasta").value;

      window.location.href = '../reportes/usuarios_ajax_pdf' + "?id_responsable=" + id_responsable + "&fecha_de=" + fecha_de + "&fecha_hasta=" + fecha_hasta;

      /*var parametros = {
                "id_responsable" : id_responsable,
                "fecha_de" : fecha_de,
                "fecha_hasta" : fecha_hasta
        };

      $.ajax({
            data:  parametros,
            url: 'usuarios_ajax_pdf',
            dataType:'json',
            type:'get',

            success: function (data) {
                if (data.success==false) {
                    alert("error");
                }
                else{

                    document.getElementById("btn_reporteu_pdf").value = "Imprimir PDF";
                    document.getElementById("btn_reporteu_pdf").className = "btn btn-success btn-block";

                }
            }
        })*/
    })

  //reporte por departamento
  $('#btn_reported').on('click',function()
  {
    var departamento = document.getElementById("departamento").value;
    var fecha_de = document.getElementById("fecha_de").value;
    var fecha_hasta = document.getElementById("fecha_hasta").value;

    var parametros = {
              "departamento" : departamento,
              "fecha_de" : fecha_de,
              "fecha_hasta" : fecha_hasta
      };

    $.ajax({
          data:  parametros,
          url: 'departamento_ajax',
          dataType:'json',
          type:'get',

          success: function (data) {
              if (data.success==false) {
                  alert("error");
              }
              else{

                  var tareas_total = data.tareas_total;
                  var tareas_completadas_tiempo = data.tareas_completadas_tiempo;
                  var tareas_completadas_destiempo = data.tareas_completadas_destiempo;
                  var tareas_completadas_total = data.tareas_completadas_total;
                  var tareas_vencidas = data.tareas_vencidas;

                  $('.tareas_total').html(tareas_total);
                  $('.tareas_completadas').html(tareas_completadas_total);
                  $('.tareas_destiempo').html(tareas_completadas_destiempo);
                  $('.tareas_vencidas').html(tareas_vencidas);

                  // Create the data table. Grafica de cumplimiento
                  var data_cumplimiento = new google.visualization.DataTable();
                  data_cumplimiento.addColumn('string', 'Porcentaje');
                  data_cumplimiento.addColumn('number', 'Valor');
                  data_cumplimiento.addRows([
                    ['Concluidas', tareas_completadas_total],
                    ['Vencidas', tareas_vencidas]
                  ]);

                  // Set chart options
                  var options_cumplimiento = {
                                };

                  // Instantiate and draw our chart, passing in some options.
                  var chart = new google.visualization.PieChart(document.getElementById('chart_cumplimiento'));
                  chart.draw(data_cumplimiento, options_cumplimiento);

                  // Create the data table. Grafica de Desfase
                  var data_desfase = new google.visualization.DataTable();
                  data_desfase.addColumn('string', 'Porcentaje');
                  data_desfase.addColumn('number', 'Valor');
                  data_desfase.addRows([
                    ['A Tiempo', tareas_completadas_tiempo],
                    ['Destiempo', tareas_completadas_destiempo],
                  ]);

                  // Set chart options
                  var options_desfase = {};

                  // Instantiate and draw our chart, passing in some options.
                  var chart = new google.visualization.PieChart(document.getElementById('chart_desfase'));
                  chart.draw(data_desfase, options_desfase);

                  //tabla que muestra las tareas cumplidas a tiempo
                  $('.tabla_atiempo').html(tareas_atiempo);
                  var tareas_atiempo = '';   
                  tareas_atiempo += '<table class="table">';
                  tareas_atiempo += '<thead>';
                  tareas_atiempo += '<tr>';
                  tareas_atiempo += '<th> Id </th>';
                  tareas_atiempo += '<th> Tarea </th>';
                  tareas_atiempo += '<th> Objetivo </th>';
                  tareas_atiempo += '<th> Responsable </th>';
                  tareas_atiempo += '<th> Fecha Asignada </th>';
                  tareas_atiempo += '<th> Fecha Concluida </th>';
                  tareas_atiempo += '</tr>';
                  tareas_atiempo += '</thead>';
                  tareas_atiempo += '<tbody>';
                    for(datos in data.tareas){
                      if (data.tareas[datos].estado == 'Concluida A Tiempo')  {
                          tareas_atiempo  += '<tr>'+ '<td>' +  data.tareas[datos].id + '</td>' + '<td>' +  data.tareas[datos].tarea + '</td>' + '<td>' +  data.tareas[datos].objetivo + '</td>' + '<td>' +  data.tareas[datos].nombre_responsable + '</td>' + '<td>' +  data.tareas[datos].fecha + '</td>' + '<td>' +  data.tareas[datos].fecha_concluida + '</td>' + '</tr>';
                      }
                    }
                  tareas_atiempo += '</tbody>';
                  tareas_atiempo += '</table>';
                  $('.tabla_atiempo').html(tareas_atiempo);

                  //tabla que muestra las tareas cumplidas despues del tiempo
                  $('.tabla_destiempo').html(tareas_destiempo);
                  var tareas_destiempo = '';   
                  tareas_destiempo += '<table class="table">';
                  tareas_destiempo += '<thead>';
                  tareas_destiempo += '<tr>';
                  tareas_destiempo += '<th> Id </th>';
                  tareas_destiempo += '<th> Tarea </th>';
                  tareas_destiempo += '<th> Objetivo </th>';
                  tareas_destiempo += '<th> Responsable </th>';
                  tareas_destiempo += '<th> Fecha Asignada </th>';
                  tareas_destiempo += '<th> Fecha Concluida </th>';
                  tareas_destiempo += '</tr>';
                  tareas_destiempo += '</thead>';
                  tareas_destiempo += '<tbody>';
                    for(datos in data.tareas){
                      if (data.tareas[datos].estado == 'Concluida A Destiempo') {
                          tareas_destiempo  += '<tr>'+ '<td>' +  data.tareas[datos].id + '</td>' + '<td>' +  data.tareas[datos].tarea + '</td>' + '<td>' +  data.tareas[datos].objetivo + '</td>' + '<td>' +  data.tareas[datos].nombre_responsable + '</td>' + '<td>' +  data.tareas[datos].fecha + '</td>' + '<td>' +  data.tareas[datos].fecha_concluida + '</td>' + '</tr>';
                      }
                    }
                  tareas_destiempo += '</tbody>';
                  tareas_destiempo += '</table>';
                  $('.tabla_destiempo').html(tareas_destiempo);

                  //tabla que muestra las tareas vencidas
                  $('.tabla_vencidas').html(tareas_vencidas);
                  var tareas_vencidas = '';   
                  tareas_vencidas += '<table class="table">';
                  tareas_vencidas += '<thead>';
                  tareas_vencidas += '<tr>';
                  tareas_vencidas += '<th> Id </th>';
                  tareas_vencidas += '<th> Tarea </th>';
                  tareas_vencidas += '<th> Objetivo </th>';
                  tareas_vencidas += '<th> Responsable </th>';
                  tareas_vencidas += '<th> Fecha Asignada </th>';
                  tareas_vencidas += '<th> Fecha Concluida </th>';
                  tareas_vencidas += '</tr>';
                  tareas_vencidas += '</thead>';
                  tareas_vencidas += '<tbody>';
                    for(datos in data.tareas){
                      if (data.tareas[datos].estado == 'Vencido') {
                          tareas_vencidas += '<tr>'+ '<td>' +  data.tareas[datos].id + '</td>' + '<td>' +  data.tareas[datos].tarea + '</td>' + '<td>' +  data.tareas[datos].objetivo + '</td>' + '<td>' +  data.tareas[datos].nombre_responsable + '</td>' + '<td>' +  data.tareas[datos].fecha + '</td>' + '<td>' +  data.tareas[datos].fecha_concluida + '</td>' + '</tr>';
                      }
                    }
                  tareas_vencidas += '</tbody>';
                  tareas_vencidas += '</table>';
                  $('.tabla_vencidas').html(tareas_vencidas);

              }
          }
      })
  });

});


// Load the Visualization API and the piechart package.
google.load('visualization', '1.0', {'packages':['corechart']});

// Set a callback to run when the Google Visualization API is loaded.
//google.setOnLoadCallback(drawChart);


