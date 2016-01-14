function guardarAjax(url, tipo, tipoDeDatos, parametros, asunto)
{
	$.ajax({
		url:  	  url,
		type: 	  tipo,
		dataType: tipoDeDatos,
		data:     parametros.serialize()
	})
	.done(function(resultado) {
		if(resultado === 1) {
			bootbox.alert('');
		}
	})
	.fail(function() {
		console.log("error");
	});
}