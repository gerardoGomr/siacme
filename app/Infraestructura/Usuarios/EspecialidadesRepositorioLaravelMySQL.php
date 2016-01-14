<?php
namespace Siacme\Infraestructura\Usuarios;

use DB;

/**
 * Class EspecialidadesRepositorioLaravelMySQL
 * @package Siacme\Infraestructura\Usuarios
 * @author  Gerardo Adrián Gómez Ruiz
 */
class EspecialidadesRepositorioLaravelMySQL implements EspecialidadesRepositorioInterface
{
	/**
	 * obtener especialidad por id
	 * @param  int $id
	 * @return Especialidad
	 */
	public function obtenerEspecialidadPorId($id)
	{
		try
		{
			$especialidades = DB::table('especialidad')
				->where('idEspecialidad', $id)
				->first();

			$totalEspecialidad = count($especialidades);

			if($totalEspecialidad > 0) {

				$especialidad = new Especialidad($especialidades->idEspecialidad);
				$especialidad->setEspecialidad($especialidades->Especialidad);

				return $especialidad;
			}

			return null;
		} catch(Exception $e) {
			mail("gerardo.gomr@gmail.com", "Error en el sistema SIACM", "Error: ".$e->getMessage());
			return null;
		}
	}
}