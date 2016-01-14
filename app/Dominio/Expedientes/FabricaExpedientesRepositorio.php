<?php
namespace Siacme\Expedientes;

use Siacme\Usuarios\Especialidad;
use Siacme\Expedientes\ExpedientesOdontopediatriaRepositorioMySQL;

/**
* @author Gerardo Adrián Gómez Ruiz
* @version 1.0
* @date    25/08/2015
*/
class FabricaExpedientesRepositorio
{
	/**
	 * crear un repositorio para un expediente específico
	 * @param  Especialidad $especialidad
	 * @return repositorio
	 */
	public static function construirRepositorio(Especialidad $especialidad)
	{
		switch ($especialidad->getId()) {
			case 3:
				return new ExpedientesOdontopediatriaRepositorioMySQL();
				break;

			case 1:
				return new ExpedienteOtorrino();
				break;

			default:
				throw new \Exception('Intentando crear un repositorio inexistente');
				break;
		}
	}
}