<?php
namespace Siacme\Servicios\Consultas;

use Siacme\Dominio\Expedientes\Expediente;
use Siacme\Dominio\Usuarios\Usuario;
use Siacme\Dominio\Pacientes\Paciente;
use Siacme\Servicios\Pacientes\DibujadorInterface;
use View;

/**
* @author Gerardo Adrián Gómez Ruiz
*/
class FabricaConsultasViews
{
	/**
	 * @param \Siacme\Dominio\Expedientes\Expediente              $expediente
	 * @param \Siacme\Servicios\Pacientes\DibujadorInterface|null $dibujadorOdontograma
	 * @return \Siacme\Servicios\Consultas\ExpedienteOtorrino
	 * @throws \Exception
	 */
	public static function construirVista(Expediente $expediente, DibujadorInterface $dibujadorOdontograma = null)
	{
		switch ($expediente->getMedico()->getUsername()) {
			case 'johanna.vazquez':
				// odontopediatría
				return View::make('consultas.consultas_odontopediatria_capturar', compact('expediente', 'dibujadorOdontograma'));
				break;

			case 1:
				return new ExpedienteOtorrino();
				break;

			default:
				throw new \Exception('Intentando crear una vista inexistente');
				break;
		}
	}
}