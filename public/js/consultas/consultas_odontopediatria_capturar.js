$(function() {
	// variables
	var $formConsulta       = $('#formConsulta'),
		$btnGuardarConsulta = $('#btnGuardarConsulta'),
		$btnInterconsulta   = $('#btnInterconsulta'),
		$btnLaboratorio     = $('#btnLaboratorio'),
		$btnReceta 			= $('#btnReceta');

	// inicializar form
	init();

	// validar formulario
	agregaValidacionesElementos($formConsulta);

	// evento click de los dientes
	$('#odontograma').on('click', 'a.diente', function(event) {
		event.preventDefault();
		// abrir ventana de selección de estatus usando fancybox
		// $.fancybox.open([{
	 //        fitToView:   true,
	 //        width:       '40%',
		// 	maxHeight:   '40%',
	 //        openEffect:  'fade',
	 //        closeEffect: 'fade',
	 //        type:        'iframe',
	 //        href:        $(this).attr('href')
	 //    }]);
		window.open($(this).attr('href'), '_blank', 'width=400, height=500, scrollbars=yes');
	});

	// evento click para botón receta, abrir ventana
	$btnReceta.on('click', function(event) {
		event.preventDefault();

		window.open($(this).attr('href'), '_blank', 'width=600, height=500, scrollbars=yes');
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