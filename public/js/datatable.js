$(document).ready(function(){
	/*$('#tabla_tareas').DataTable({
		responsive: true,
		"paging": false,
		"ordering": false,
		"info": false,
		"searching": false,
		"columnDefs": [
			{ "orderable": false, "searchable": false, "targets": 6 }
		]
	});*/

	$('#tabla_promSiniestros').DataTable({
		
	});

	$('#tabla_tableroReclamacion').DataTable({
		"columnDefs": [
			{ "orderable": false, "searchable": false, "targets": [1, 2]}
		]
	});

	$('#tabla_JuiciosExtrajudicial').DataTable({
		"columnDefs": [
			{ "orderable": false, "searchable": false, "targets": [1, 2]}
		]
	});
	

	$('#tabla_JuiciosDirectamenteJudicial').DataTable({
		"columnDefs": [
			{ "orderable": false, "searchable": false, "targets": [1, 2]}
		]
	});

});
