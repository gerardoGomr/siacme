<?php
namespace Siacme\Expedientes;

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
	 * @param  int $tipo
	 * @return repositorio
	 */
	public static function construirRepositorio($tipo = 1)
	{
		switch ($tipo) {
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