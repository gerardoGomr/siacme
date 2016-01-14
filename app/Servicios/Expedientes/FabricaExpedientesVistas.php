<?php
namespace Siacme\Servicios\Expedientes;

use Siacme\Dominio\Expedientes\Expediente;
use Siacme\Dominio\Pacientes\Paciente;
use Siacme\Dominio\Usuarios\Usuario;
use Siacme\Infraestructura\Pacientes\MarcaPastaRepositorioInterface;
use Siacme\Infraestructura\Pacientes\PadecimientoRepositorioInterface;
use Siacme\Trastornos\TrastornoRepositorioInterface;
use View;
/**
* @author Gerardo Adrián Gómez Ruiz
* @version 1.0
* @date    25/08/2015
*/

class FabricaExpedientesVistas
{
	/**
	 * @param Paciente   $paciente
	 * @param Usuario    $medico
	 * @param Expediente $expediente
	 * @param array|null $listaPadecimientos
	 * @param array|null $listaTrastornos
	 * @param array|null $listaMarcas
	 * @return ExpedienteOtorrino
	 * @throws \Exception
	 */
	public static function construirVista(Paciente $paciente, Usuario $medico, Expediente $expediente = null, $listaPadecimientos = null, $listaTrastornos = null, $listaMarcas = null)
	{
		switch ($medico->getUsername()) {
			case 'johanna.vazquez':
				// odontopediatría
				if(is_null($expediente)) {
					// regresar vista sin expediente
					return View::make('expedientes.expediente_odontopediatria', compact('paciente', 'medico', 'listaPadecimientos', 'listaTrastornos',  'listaMarcas'));

				} elseif ($expediente->necesitaFirma()) {
					// vista para ver
					return View::make('expedientes.expediente_odontopediatria_ver', compact('expediente'));
				} else {
					// regresar vista con expediente
					return View::make('expedientes.expediente_odontopediatria', compact('cita', 'listaPadecimientos', 'listaTrastornos',  'listaMarcas', 'expediente'));
				}
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