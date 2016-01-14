<?php
namespace Siacme\Expedientes;

use DB;

/**
* @author Gerardo Adrián Gómez Ruiz
*/
class DienteEstatusRepositorioLaravelMySQL implements DienteEstatusRepositorioInterface
{
	/**
	 * obtener una serie de estatus
	 * @return array
	 */
	public function obtenerEstatus()
	{
		$listaEstatus = array();

		try {

			$estatus = DB::table('diente_estatus')
				->get();

			$totalEstatus = count($estatus);

			if($totalEstatus > 0) {

				foreach ($estatus as $estatus) {

					$listaEstatus[] = new DienteEstatus($estatus->idDienteEstatus, $estatus->DienteEstatus, $estatus->RutaImagen);
				}

				return $listaEstatus;
			}

			return null;

		} catch(\Exception $e) {
			echo $e->getMessage();
			return null;
		}
	}

	/**
	 * obtener un estatus por el id especificado
	 * @param  int $id
	 * @return DienteEstatus
	 */
	public function obtenerEstatusPorId($id)
	{
		try {
			$estatus = DB::table('diente_estatus')
				->where('idDienteEstatus', $id)
				->first();

			$totalEstatus = count($estatus);

			if($totalEstatus > 0) {
				return new DienteEstatus($estatus->idDienteEstatus, $estatus->DienteEstatus, $estatus->RutaImagen);
			}

			return null;

		} catch(\Exception $e) {
			echo $e->getMessage();
			return null;
		}
	}
}