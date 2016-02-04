$(function() {
	// variables
	var $dvPlanTratamiento = $('#dvPlanTratamiento');

	// evento change de los selects
	$dvPlanTratamiento.on('change', 'select.tratamientos', function(event) {
		if ($(this).val() !== '') {

			var datos = {
					_token: 	   $('#_token').val(),
					numeroDiente:  $(this).parent('td').siblings('td.diente').text(),
					idTratamiento: $(this).val()
				},
				respuestaAjax = ajax($('#urlAgregarTratamientos').val(), 'post', 'html', datos, 'guardar');

			respuestaAjax.done(function(resultado) {
				console.log('éxito');

				$('#dvPlanTratamiento').html(resultado);
			})
			.fail(function(XMLHttpRequest, textStatus, errorThrown) {
				console.log(errorThrown);
			});
		}
	});
});