<?php
namespace Siacme\Expedientes;

use Siacme\Citas\Cita;
use Siacme\Usuarios\Especialidad;
use Siacme\Expedientes\TrastornoRepositorioInterface;
use Siacme\Expedientes\MarcaPastaRepositorioInterface;
use Siacme\Expedientes\PadecimientoOdontopediatriaRepositorioInterface;
use View;
/**
* @author Gerardo Adrián Gómez Ruiz
* @version 1.0
* @date    25/08/2015
*/

class FabricaExpedientesViews
{
	/**
	 * construir una vista para captura de expedientes
	 * @param  Especialidad                     $especialidad
	 * @param  PadecimientoRepositorioInterface $padecimientosRepositorio
	 * @param  TrastornoRepositorioInterface    $trastornosRepositorio
	 * @param  MarcaPastaRepositorioInterface   $pastasRepositorio
	 * @return View
	 */
	public static function construirVista(Cita $cita, PadecimientoRepositorioInterface $padecimientosRepositorio, TrastornoRepositorioInterface $trastornosRepositorio, MarcaPastaRepositorioInterface $pastasRepositorio)
	{
		switch ($cita->getMedico()->getEspecialidad()->getId()) {
			case 3:
				// odontopediatría
				$listaPadecimientos    = $padecimientosRepositorio->obtenerPadecimientos();
				$listaTrastornos       = $trastornosRepositorio->obtenerTrastornos();
				$listaMarcas           = $pastasRepositorio->obtenerMarcaPastas();
				$expedienteRepositorio = FabricaExpedientesRepositorio::construirRepositorio($cita->getMedico()->getEspecialidad());

				$expediente = $expedienteRepositorio->obtenerExpedientePorPaciente($cita->getPaciente());

				if(is_null($expediente)) {
					// regresar vista sin expediente
					return View::make('expedientes.expediente_odontopediatria', compact('cita', 'listaPadecimientos', 'listaTrastornos',  'listaMarcas'));
				}

				// regresar vista con expediente
				return View::make('expedientes.expediente_odontopediatria', compact('cita', 'listaPadecimientos', 'listaTrastornos',  'listaMarcas', 'expediente'));
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