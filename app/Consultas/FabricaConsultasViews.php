<?php
namespace Siacme\Consultas;

use Siacme\Usuarios\Especialidad;
use Siacme\Expedientes\Expediente;
use Siacme\Expedientes\DibujadorInterface;
use View;

/**
* @author Gerardo Adrián Gómez Ruiz
*/
class FabricaConsultasViews
{
	public static function construirVista(Especialidad $especialidad, Expediente $expediente, DibujadorInterface $dibujadorOdontograma = null)
	{
		$vista = '';
		switch ($especialidad->getId()) {
			case 3:
				// vista para odontopediatria
				$vista = 'consultas_odontopediatria_capturar';
				break;

			default:
				# code...
				break;
		}

		return View::make('consultas.consultas_odontopediatria_capturar.blade' . $vista, compact('expediente', 'dibujadorOdontograma'));
	}
}