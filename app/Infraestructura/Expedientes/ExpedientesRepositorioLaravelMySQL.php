<?php
namespace Siacme\Infraestructura\Expedientes;

use DB;
use Siacme\Dominio\Expedientes\Expediente;
use Siacme\Dominio\Pacientes\Paciente;
use Siacme\Dominio\Usuarios\Usuario;
use Siacme\Dominio\Usuarios\Especialidad;
use Siacme\Dominio\Interconsultas\Interconsulta;
use Siacme\Dominio\Interconsultas\MedicoReferencia;

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

				$interconsultas = DB::table('interconsulta')
					->join('medico_referencia', 'medico_referencia.idMedicoReferencia', '=', 'interconsulta.idMedicoReferencia')
					->where('interconsulta.idExpediente', $expediente->getId())
					->orderBy('interconsulta.idInterconsulta', 'desc')
					->limit(50)
					->get();

				if (count($interconsultas) > 0) {

					foreach ($interconsultas as $interconsultas) {
						$interconsulta = new Interconsulta(
							$interconsultas->idInterconsulta,
							new MedicoReferencia(
								$interconsultas->idMedicoReferencia,
								$interconsultas->Direccion,
								new Especialidad(
									$interconsultas->idEspecialidad,
									$interconsultas->Especialidad
								)
							),
							$interconsultas->Referencia
						);

						$expediente->agregarInterconsulta($interconsulta);
					}
				}
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
		try {
			$expedientes = DB::table('expediente')
				->where('expediente.idExpediente', $idExpediente)
				->first();

		} catch (\PDOException $e) {
			echo $e->getMessage();
			return null;
		}
	}

	/**
	 * @param Expediente $expediente
	 * @return bool
	 */
	public function guardarElementosDeConsulta(Expediente $expediente)
	{
		try {
			// actualizar el expediente
			$operacion = DB::table('expediente')
				->where('idExpediente', $expediente->getId())
				->update([
					'PrimeraVez' 		 => 0,
					'FechaActualizacion' => date('Y-m-d H:m:i')
				]);

			// insertar nuevo odontograma
			foreach ($expediente->getListaOdontogramas() as $odontograma) {
				$idOdontograma = DB::table('odontograma')
					->insertGetId([
						'idExpediente'  => $expediente->getId(),
						'FechaCreacion' => date('Y-m-d H:m:i')
					]);

				$odontograma->setId($idOdontograma);

				// insertar la lista de dientes
				foreach ($odontograma->getListaDientes() as $diente) {

					$operacion = DB::table('odontograma_diente')
						->insert([
							'idOdontograma'     => $odontograma->getId(),
							'Numero'            => $diente->getNumero(),
							'FechaModificacion' => date('Y-m-d H:m:i')
						]);
				}
			}

			// insertar interconsulta
			foreach ($expediente->getListaInterconsultas() as $interconsulta) {
				$operacion = DB::table('interconsulta')
					->insert([
						'idMedicoReferencia' => $interconsulta->getMedico()->getId(),
						'idExpediente'		 => $expediente->getId(),
						'Referencia'		 => $interconsulta->getReferencia(),
						'Respondida'		 => 0,
						'FechaModificacion'  => date('Y-m-d H:m:i')
					]);
			}

			// insertar nuevo plan de tratamiento
			foreach ($expediente->getListaPlanesTratamiento() as $plan) {
				$idPlan = DB::table('plan_tratamiento')
					->insertGetId([
						'idExpediente'      => $expediente->getId(),
						'Activo'            => 1,
						'Costo'             => $plan->costo(),
						'FechaCreacion'     => date('Y-m-d H:m:i'),
						'FechaModificacion' => date('Y-m-d H:m:i')
					]);

				$plan->setId($idPlan);

				// insertar la lista de dientes y
				foreach ($plan->getListaDientes() as $diente) {
					// nuevo padecimiento por diente
					if (!is_null($diente->getListaPadecimientos())) {
						foreach ($diente->getListaPadecimientos() as $padecimiento) {
							$operacion = DB::table('diente_diente_padecimiento')
								->insert([
									'idPlanTratamiento'    => $plan->getId(),
									'Numero'			   => $diente->getNumero(),
									'idDientePadecimiento' => $padecimiento->getId(),
									'FechaModificacion'    => date('Y-m-d H:m:i')
								]);
						}
					}

					// nuevo tratamiento por diente
					if (!is_null($diente->getListaTratamientos())) {
						foreach ($diente->getListaTratamientos() as $tratamiento) {
							$operacion = DB::table('diente_diente_tratamiento')
								->insert([
									'idPlanTratamiento'   => $plan->getId(),
									'Numero'			  => $diente->getNumero(),
									'idDienteTratamiento' => $tratamiento->getDienteTratamiento()->getId(),
									'FechaModificacion'   => date('Y-m-d H:m:i')
								]);
						}
					}
				}

				// insertar otros tratamientos
				foreach ($plan->getListaOtrosTratamientos() as $otrosTratamientos) {
					$operacion = DB::table('plan_tratamiento_otros')
						->insert([
							'idPlanTratamiento' => $plan->getId(),
							'idOtroTratamiento' => $otrosTratamientos->getId(),
							'FechaModificacion' => date('Y-m-d H:m:i')
						]);
				}
			}

			return true;

		} catch(\PDOException $e) {
			echo $e->getMessage();
			return false;
		}
	}
}