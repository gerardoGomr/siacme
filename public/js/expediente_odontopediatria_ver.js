$(function() {
	$('#firmar').on('click', function() {
		bootbox.confirm('Se procederá a firmar el expediente, ¿desea continuar?', function(r) {
			if(r === true) {
				$.ajax({
					url:      $('#urlFirmar').val(),
					type:     'post',
					data:     {idExpediente: $('#idExpediente').val(),idCita: $('#idCita').val() , _token: $('#_token').val()}
				})
				.done(function(resultado) {
					if(resultado === '0') {
						bootbox.alert('Ocurrió un error al firmar el expediente');
					}

					bootbox.alert('Expediente firmado con éxito', function() {
						window.location.href = $('#urlDetalles').val();
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