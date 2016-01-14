<?php
namespace Siacme\Expedientes;

use DB;

/**
 * @author Gerardo Adrián Gómez Ruiz
 * @date   03/08/2015
 */
class TrastornoRepositorioMySQL implements TrastornoRepositorioInterface
{
	/**
	 * obtener una lista de trastornos de la base de datos
	 * @return array $listadeTrastornos or null
	 */
	public function obtenerTrastornos()
	{
		$listaTrastornos = array();

		try
		{
			$trastornos = DB::table('trastorno_lenguaje')
				->select('idTrastornoLenguaje', 'TrastornoLenguaje')
				->get();

			$totalTrastornos = count($trastornos);

			if($totalTrastornos > 0) {

				foreach ($trastornos as $trastornos) {

					$trastorno = new TrastornoLenguaje();
					$trastorno->setId($trastornos->idTrastornoLenguaje);
					$trastorno->setTrastornoLenguaje($trastornos->TrastornoLenguaje);

					$listaTrastornos[] = $trastorno;

				}
				return $listaTrastornos;
			}

			return null;
		}
		catch(Exception $e)
		{
			mail("gerardo.gomr@gmail.com", "Error en el sistema SIACM", "Error: ".$e->getMessage());
			return null;
		}
	}
}