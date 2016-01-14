<?php
namespace Siacme\Expedientes;

use Siacme\Citas\Cita;
use Siacme\Expedientes\TrastornoRepositorioMySQL;
use Siacme\Expedientes\MarcaPastaRepositorioMySQL;
use Siacme\Expedientes\PadecimientoOdontopediatriaRepositorioMySQL;
use View;
/**
* @author Gerardo Adrián Gómez Ruiz
* @version 1.0
* @date    25/08/2015
*/

class FabricaExpedientesViews
{
	/**
	 * crear un repositorio para un expediente específico
	 * @param  string $idEspecialidad
	 * @return repositorio
	 */
	public static function construirVista(Cita $cita)
	{
		switch ($cita->getMedico()->getEspecialidad()->getId()) {
			case 3:
				// odontopediatría

				$padecimientosRepositorio = new PadecimientoOdontopediatriaRepositorioMySQL();
				$trastornosRepositorio    = new TrastornoRepositorioMySQL();

				$marcasRepositorio		  = new MarcaPastaRepositorioMySQL();
				$listaPadecimientos       = $padecimientosRepositorio->obtenerPadecimientos();
				$listaTrastornos		  = $trastornosRepositorio->obtenerTrastornos();
				$listaMarcas			  = $marcasRepositorio->obtenerMarcaPastas();
				// var_dump($listaMarcas);exit;
				// var_dump(is_null($cita->getExpediente()->getId()));exit;
				if(is_null($cita->getExpediente()->getId())) {
					// regresar vista sin expediente
					return View::make('expedientes.expediente_odontopediatria', compact('cita', 'listaPadecimientos', 'listaTrastornos',  'listaMarcas'));
				}

				// regresar vista con expediente
				$expedienteRepositorio = new ExpedientesOdontopediatriaRepositorioMySQL();
				$expedienteRepositorio->obtenerExpedientePorExpediente($cita->getExpediente());
				$expediente = $cita->getExpediente();
				// var_dump($expediente);exit;
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