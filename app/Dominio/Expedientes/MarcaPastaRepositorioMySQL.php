<?php
namespace Siacme\Expedientes;

use DB;

/**
* @author Gerardo Adrián Gómez Ruiz
* @version 1.0
*/
class MarcaPastaRepositorioMySQL implements MarcaPastaRepositorioInterface
{
	public function obtenerMarcaPastas($parametros = null)
	{
		$listaMarcas = array();

		try {
			$marcas = DB::table('marca_pasta')
				->select('idMarcaPasta', 'MarcaPasta')
				->get();

			$totalMarcas = count($marcas);

			if($totalMarcas > 0) {

				foreach ($marcas as $marcas) {
					$marcaPasta = new MarcaPasta();
					$marcaPasta->setId($marcas->idMarcaPasta);
					$marcaPasta->setMarcaPasta($marcas->MarcaPasta);

					$listaMarcas[] = $marcaPasta;
				}

				return $listaMarcas;
			}

			return null;
		} catch(Exception $e) {

			return null;
		}
	}
}