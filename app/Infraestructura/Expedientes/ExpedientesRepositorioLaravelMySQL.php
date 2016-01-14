<?php
namespace Siacme\Infraestructura\Expedientes;

use DB;
use Siacme\Dominio\Expedientes\Expediente;
use Siacme\Dominio\Pacientes\Paciente;
use Siacme\Dominio\Usuarios\Usuario;

/**
 * Class ExpedientesRepositorioLaravelMySQL
 * @package Siacme\Infraestructura\Expedientes
 * @author  Gerardo Adrián Gómez Ruiz
 */
class ExpedientesRepositorioLaravelMySQL implements ExpedientesRepositorioInterface
{
	/**
	 * @param Expediente $expediente
	 * @return bool
	 */
	public function persistir(Expediente $expediente)
	{
		try {
			if(is_null($expediente->getId())) {
				$idExpediente = DB::table('expediente')
					->insertGetId([
						'idPaciente'         => $expediente->getPaciente()->getId(),
						'UserMedico'         => $expediente->getMedico()->getUsername(),
						'PrimeraVez'         => $expediente->primeraVez() ? '1' : '0',
						'FechaCreacion'      => date('Y-m-d'),
						'FechaActualizacion' => date('Y-m-d')
					]);
				// obtener el Id
				$expediente->setId($idExpediente);
			} else {
				// editar
				DB::table('expediente')
					->where('idExpediente', '=', $expediente->getId())
					->update([
						'PrimeraVez'		 => $expediente->primeraVez() ? '1' : '0',
						'Firma'				 => $expediente->getFirma(),
						'FechaActualizacion' => date('Y-m-d')
					]);
			}

			return true;

		} catch(\PDOException $e) {
			echo $e->getMessage();
			return false;
		}
	}

	/**
	 * @param \Siacme\Dominio\Pacientes\Paciente $paciente
	 * @param \Siacme\Dominio\Usuarios\Usuario   $medico
	 * @return array
	 */
	public function obtenerExpedientePorPacienteMedico(Paciente $paciente, Usuario $medico)
	{
		try {
			$expedientes = DB::table('expediente')
				->where('idPaciente', $paciente->getId())
				->where('UserMedico', $medico->getUsername())
				->first();

			$totalExpedientes = count($expedientes);

			if($totalExpedientes > 0) {
				$expediente = new Expediente($expedientes->idExpediente);
				$expediente->setPaciente($paciente);
				$expediente->setMedico($medico);
				$expediente->setPrimeraVez($expedientes->PrimeraVez);
				return $expediente;
			}

			return null;
		} catch(\PDOException $e) {
			return null;
		}
	}

	/**
	 * @param  int		  $idExpediente
	 * @return Expediente
	 */
	public function obtenerExpedientePorId($idExpediente)
	{

	}
}