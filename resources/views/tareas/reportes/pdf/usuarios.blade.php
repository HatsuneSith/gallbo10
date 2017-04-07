<html>
<head >
    
<style>
     table {
          width:100%;
          font-size:small;
          border-spacing: 0;
          border-collapse: collapse;
     }

     table>thead>tr>th {
          vertical-align: bottom;
          border-bottom: 2px solid #ddd;
     }

     table>tbody>tr>td{
          padding: 8px;
          line-height: 1.42857143;
          vertical-align: top;
          border-top: 1px solid #ddd;
     }


</style>
</head>
<body >
	<h3>Reporte de {{$nombre}} {{$apellido}} del {{$fecha_de}} al {{$date_hasta}}</h3>
	<h4>Tabla de Tareas Concluidas a Tiempo</h4>
	<table>
          <thead>
               <tr>
                    <th>Id</th>
                    <th>Tarea</th>
                    <th>Objetivo</th>
                    <th>Fecha Asignada</th>
                    <th>Fecha Concluida</th>
                    <th>Check</th>
               </tr>
          </thead>
          <tbody>
          	@foreach($tareas as $tarea)
          		@if($tarea->estado=='Concluida A Tiempo')
					<tr>
						<td>{{$tarea->id}}</td>
						<td>{{$tarea->tarea}}</td>
						<td>{{$tarea->objetivo}}</td>
						<td>{{$tarea->fecha}}</td>
						<td>{{$tarea->fecha_concluida}}</td>
						<td>     </td>
					</tr>
				@endif
          	@endforeach
          </tbody>
	</table>
	<br>
	<h4>Tabla de Tareas Concluidas a Destiempo</h4>
	<table>
          <thead>
               <tr>
                    <th>Id</th>
                    <th>Tarea</th>
                    <th>Objetivo</th>
                    <th>Fecha Asignada</th>
                    <th>Fecha Concluida</th>
                    <th>Check</th>
               </tr>
          </thead>
          <tbody>
          	@foreach($tareas as $tarea)
          		@if($tarea->estado=='Concluida A Destiempo')
					<tr>
						<td>{{$tarea->id}}</td>
						<td>{{$tarea->tarea}}</td>
						<td>{{$tarea->objetivo}}</td>
						<td>{{$tarea->fecha}}</td>
						<td>{{$tarea->fecha_concluida}}</td>
						<td>     </td>
					</tr>
				@endif
          	@endforeach
          </tbody>
	</table>

    

</body>
</html>
