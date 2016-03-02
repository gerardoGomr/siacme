$(function() {
	// variables
	var $formConsulta       		  = $('#formConsulta'),
		$btnGuardarPadecimientoDental = $('#btnGuardarPadecimientoDental'),
		$btnGenerarPlan				  = $('#btnGenerarPlan'),
		$btnGuardarConsulta 		  = $('#btnGuardarConsulta'),
		$btnGuardarInterconsulta      = $('#btnGuardarInterconsulta'),
		$btnLaboratorio     		  = $('#btnLaboratorio'),
		$btnGuardarReceta 			  = $('#btnGuardarReceta');

	// inicializar form
	init();

	// validación básica
	$formConsulta.validate();

	// validar formulario
	agregaValidacionesElementos($formConsulta);

	// evento click de los dientes
	$('#dvOdontograma').on('click', 'a.diente', function(event) {
		// setear el valor del diente seleccionado
		$('#diente').val($(this).children('input[name="valor"]').val());
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
				$('#dvOdontograma').html(resultado);

				$('#dvPadecimientosDentales').find('input.padecimiento').each(function() {
					// reiniciar modal
					$(this).attr('checked', false);
				});

				// cerrar modal
				$('#dvPadecimientosDentales').modal('hide');

				// activar boton de plan
				$btnGenerarPlan.attr('disabled', false);
			});
		})
		.fail(function(XMLHttpRequest, textStatus, errorThrown) {
			console.log(textStatus + ': ' + errorThrown);
			bootbox.alert('Imposible realizar la operación solicitada');
		});
	});

	/**
	 * abir nueva ventana
	 * generar plan de tratamiento en base a odontograma
	 */
	$btnGenerarPlan.on('click', function(event) {
		event.preventDefault();
		window.open($(this).attr('href'), '_blank', 'width=800, height=600, scrollbars=yes');
	});

	// change para mostrar receta
	$('#receta').on('change', function() {
		var receta = atob($('input[name="receta' + $(this).val() + '"]').val());

		$('#txtReceta').val(receta);
	});

	// guardar receta
	$btnGuardarReceta.on('click', function(event) {
		event.preventDefault();

		// objeto a enviar
		var datos = {
			_token:   $formConsulta.find('input[name="_token"]').val(),
			idReceta: $('#receta').val(),
			receta:   btoa($('#txtReceta').val())
		};

		var respuesta = ajax($(this).attr('href'), 'post', 'html', datos, 'guardar');
		respuesta.done(function(resultado) {
			console.log(resultado);

			if(resultado === '0') {
				bootbox.alert('Ocurrió un error al guardar la receta.');
				return false;
			}

			bootbox.alert('Receta guardada', function() {
				// cerrar modal
				$('#dvRecetas').modal('hide');
			});
		})
		.fail(function(XMLHttpRequest, textStatus, errorThrown) {
			console.log(textStatus + ': ' + errorThrown);
			bootbox.alert('Imposible realizar la operación solicitada');
		});
	});

	// interconsulta
	$btnGuardarInterconsulta.on('click', function(event) {
		event.preventDefault();
		if ($('#txtReferencia').val() === '') {
			bootbox.alert('Por favor, escriba una referencia');
			return false;
		}

		if ($('#medico').val() === '') {
			bootbox.alert('Por favor, seleccione a un médico');
			return false;
		}
		// objeto a enviar
		var datos = {
			_token:   $formConsulta.find('input[name="_token"]').val(),
			idMedico: $('#medico').val(),
			referencia:   btoa($('#txtReferencia').val())
		};

		var respuesta = ajax($(this).attr('href'), 'post', 'html', datos, 'guardar');
		respuesta.done(function(resultado) {
			console.log(resultado);

			if(resultado === '0') {
				bootbox.alert('Ocurrió un error al generar la interconsulta.');
				return false;
			}

			bootbox.alert('Interconsulta guardada', function() {
				// cerrar modal
				$('#dvInterconsulta').modal('hide');
			});
		})
		.fail(function(XMLHttpRequest, textStatus, errorThrown) {
			console.log(textStatus + ': ' + errorThrown);
			bootbox.alert('Imposible realizar la operación solicitada');
		});
	});

	// activar y desactivar elementos de medida
	$('input.medidas').on('click', function(event) {
		var idInputText = $(this).data('id');

		if ($(this).is(':checked')) {
			$('#' + idInputText).attr('readonly', false);
		} else {
			$('#' + idInputText).attr('readonly', true);
			$('#' + idInputText).val('');
		}
	});

	//  guardar consulta
	$btnGuardarConsulta.on('click', function(){
		if ($formConsulta.valid() === true) {
			// guardar form
			var respuesta = ajax($formConsulta.attr('action'), 'post', 'html', $formConsulta.serialize(), 'guardar');
			respuesta.done(function(resultado) {
				console.log(resultado);

				if(resultado === '0') {
					bootbox.alert('Ocurrió un error al generar la consulta.');
					return false;
				}

				bootbox.alert('Consulta generada con éxito', function() {
					// se guardó con éxito, retornar a pantalla de consultas agendadas
				});
			})
			.fail(function(XMLHttpRequest, textStatus, errorThrown) {
				console.log(textStatus + ': ' + errorThrown);
				bootbox.alert('Imposible realizar la operación solicitada');
			});
		}
	});


});