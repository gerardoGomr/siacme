$(function() {
	// espacios para variables
	var $formUsuarios    = $('#formUsuarios'),
		$usuariosLoading = $('#usuariosLoading'),
		$listaUsuarios   = $('#listaUsuarios'),
		$detalleLoading  = $('#detalleLoading'),
		$dvDetalles      = $('#dvDetalles'),
		$nombre			 = $('#nombre');


	// prevenir submit al enter
	$nombre.on('keypress', function(event) {
		if (event === 13 || event.which === 13) {
			return false;
		}
	});

	// buscar coincidencias
	$nombre.on('keyup', function(event) {
		if (event === 13 || event.which === 13) {
			$.ajax({
				url:      $formUsuarios.attr('action'),
				type:     'post',
				dataType: 'json',
				data:     $formUsuarios.serialize(),
				beforeSend: function() {
					$usuariosLoading.show(300);
				}
			})
			.done(function(respuesta) {
				$usuariosLoading.hide(300);
				if(respuesta.resultado === 'fail') {
					bootbox.alert('Ocurrió un error al realizar la petición; intente de nuevo');
					return false;
				}

				$listaUsuarios.html(atob(respuesta.contenido));
			})
			.fail(function(a, textStatus, errorThrown) {
				$usuariosLoading.hide(300);
				console.log("error -- " + textStatus + ': ' + errorThrown);
			});
		}
	});

	// evento click a elemento de lista usuarios
	$listaUsuarios.on('click', 'li', function(event){
		$listaUsuarios.find('li.active').removeClass('active');
		$(this).addClass('active');

		// buscar sus detalles
		alert('buscando detalles de este elemento');
	});

	// focus a nombre de usuario
	setTimeout(function(){
		$('#nombre').focus();
	}, 500);
});