$(function() {
	$('#firmar').on('click', function() {
		bootbox.confirm('Se procederá a firmar el expediente, ¿desea continuar?', function(r) {
			if(r === true) {
				var respuesta = ajax($('#urlFirmar').val(), 'post', 'html', {idPaciente: $('#idPaciente').val(), userMedico: $('#userMedico').val(), _token: $('#_token').val()}, 'guardar', '', '');
				respuesta.done(function(resultado) {
					if(resultado === '0') {
						bootbox.alert('Ocurrió un error al firmar el expediente');
					}

					bootbox.alert('Expediente firmado con éxito', function() {
						//window.location.href = $('#urlDetalles').val();
						window.opener.location.reload(true);
						window.close();
					});
				})
				.fail(function(XMLHttpRequest, textStatus, errorThrown) {
					console.log(errorThrown);
					bootbox.alert('Imposible realizar la operación solicitada.');
				});

			}
		});
	});

});