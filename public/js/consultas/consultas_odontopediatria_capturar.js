$(function() {
	// variables
	var $formConsulta       		  = $('#formConsulta'),
		$btnGuardarPadecimientoDental = $('#btnGuardarPadecimientoDental'),
		$btnGuardarConsulta 		  = $('#btnGuardarConsulta'),
		$btnInterconsulta   		  = $('#btnInterconsulta'),
		$btnLaboratorio     		  = $('#btnLaboratorio'),
		$btnReceta 					  = $('#btnReceta');

	// inicializar form
	init();

	// validación básica
	$formConsulta.validate();

	// validar formulario
	agregaValidacionesElementos($formConsulta);

	// evento click de los dientes
	$('#odontograma').on('click', 'a.diente', function(event) {
		// setear el valor del diente seleccionado
		$('#diente').val($(this).child('input[name="valor"]').val());
	});

	/**
	 * verificar cuantos padecimientos han sido seleccionados
	 * agregar todos los padecimientos al arreglo
	 */
	$btnGuardarPadecimientoDental.on('click', function(event) {
		event.preventDefault();

		var totalPadecimientos = 0,
		 	padecimientos      = [];

		$('#dvPadecimientosDentales').find('input.padecimiento').each(function() {
			if ($(this).is(':checked')) {
				totalPadecimientos ++;

				padecimientos.push($(this).val());
			}
		});

		if (totalPadecimientos > 2) {
			bootbox.alert('Solamente puede seleccionar hasta dos padecimientos');
			return false;
		} else if(totalPadecimientos === 0) {
			bootbox.alert('Seleccione al menos un padecimiento');
			return false;
		}

		// objeto a enviar
		var datos = {
			_token:        $formConsulta.find('input[name="_token"]').val(),
			diente:        $('#diente').val(),
			padecimientos: padecimientos
		};

		var respuesta = ajax($(this).attr('href'), 'post', 'html', datos, 'guardar');
		respuesta.done(function(resultado) {
			console.log(resultado);

			if(resultado === '0') {
				bootbox.alert('Ocurrió un error al guardar los padecimientos del diente seleccionado.');
				return false;
			}

			bootbox.alert('Padecimientos asignados al diente seleccionado', function() {
			});
		})
		.fail(function(XMLHttpRequest, textStatus, errorThrown) {
			console.log(errorThrown);
			bootbox.alert('Imposible realizar la operación solicitada');
		});
	});
});

/**
 * volver a dibujar el odontograma
 * @return html
 */
function repintar() {
	var datos = {_token: $('#formConsulta').find('input[name="_token"]').val()};

	ajax($('#urlOdontograma').val(), 'post', 'html', datos, 'cargar', '', 'dvOdontograma');
}