$(function() {
	var $txtPaciente  = $('#txtPaciente'),
		$formPaciente = $('#formPaciente');

	setTimeout(function(){
		$txtPaciente.focus();
	}, 500);

	// prevenir submit normal
	$txtPaciente.on('keypress', function(event) {
		if (event === 13 || event.which === 13) {
			return false;
		}
	});

	// buscar pacientes
	$txtPaciente.on('keyup', function(event) {
		if (event === 13 || event.which === 13) {
			// busqueda ajax - modo cargar
        	ajax($formPaciente.attr('action'), 'post', 'html', $formPaciente.serialize(), 'cargar', 'pacientesLoading', 'listaPacientes');
		}
	});

	// detalles de un paciente
	$('#listaPacientes').on('click', 'a.paciente', function(event) {
		event.preventDefault();

		var url   = $(this).attr('href'),
			datos = {
				'idPaciente': $(this).siblings('input.idPaciente').val(),
				'username'  : $('#username').val(),
				'_token'    : $formPaciente.find('input[name="_token"]').val()
			};
			ajax(url, 'post', 'html', datos, 'cargar', 'detalleLoading', 'dvDetalles');
	});
});