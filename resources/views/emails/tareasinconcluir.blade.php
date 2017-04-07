<html>
	<head>
		
	</head>
	<body>
		<p>Estimado {{$destinatario}}</p>
		<br>
		<p>Se le informa que la tarea: "{{$descripcion}}" fue marcada como "Sin Concluir" por lo que su estado a cambiado a "{{$estado}}" y su indicador a "{{$indicador}}".</p>
		<br>
		<p>Revisa bien tu tarea y asegurate de concluirla correctamente antes de volverla a marcar como concluida.</p>
		<br>
		<p>Da click en el siguiente para enlace volver a ver los detalles de la tarea: <a href="http://sire.gallbo.com/tareas/ver/{{$id}}">"Ver Tarea"</a></p>
	</body>
</html>