<?php
namespace Siacme\Pacientes;

use DB;

/**
* @author Gerardo Adrián Gómez Ruiz
*/
class PacientesRepositorioMySQL implements PacientesRepositorioInterface
{
	/**
	 * comentario heredado
	 * @param  string $nombres
	 * @return array
	 */
	public function obtenerPacientesPorNombre($nombres)
	{
		try {
			$listaPacientes = array();

			$pacientes = DB::table('paciente')
							->select('idPaciente', 'Nombre', 'Paterno', 'Materno', 'Telefono', 'Celular', 'Email')
							->where(DB::raw("REPLACE(CONCAT(Nombre, Paterno, Materno), ' ', '')"), 'LIKE', "%$nombres%")
							->orWhere(DB::raw("REPLACE(CONCAT(Paterno, Materno, Nombre), ' ', '')"), 'LIKE', "%$nombres%")
							->orWhere('Telefono', 'LIKE', "%$nombres%")
							->orWhere('Celular', 'LIKE', "%$nombres%")
							->orWhere('Email', 'LIKE', "%$nombres%")
							->get();

			$totalPacientes = count($pacientes);

			if($totalPacientes > 0) {
				foreach ($pacientes as $pacienteActual) {
					// crear paciente
					$paciente = new Paciente();
					$paciente->setId($pacienteActual->idPaciente);
					$paciente->setNombre($pacienteActual->Nombre);
					$paciente->setPaterno($pacienteActual->Paterno);
					$paciente->setMaterno($pacienteActual->Materno);
					$paciente->setTelefono($pacienteActual->Telefono);
					$paciente->setCelular($pacienteActual->Celular);
					$paciente->setEmail($pacienteActual->Email);

					$listaPacientes[] = $paciente;
				}

				// devolver lista de Pacientes
				return $listaPacientes;
			}

			return null;


		} catch (\Exception $e) {
			echo $e->getMessage();
			return null;
		}
	}

	public function persistir(Paciente $paciente)
	{
		// var_dump($paciente);exit;
		try {

			if($paciente->nuevoPaciente(true) || is_null($paciente->getId())) {
				// insertar

				$idPaciente = DB::table('paciente')
					->insertGetId([
						'Nombre'   => $paciente->getNombre(),
						'Paterno'  => $paciente->getPaterno(),
						'Materno'  => $paciente->getMaterno(),
						'Telefono' => $paciente->getTelefono(),
						'Celular'  => $paciente->getCelular(),
						'Email'    => $paciente->getEmail()
					]);

				$paciente->setId($idPaciente);

			} else {
				// actualizar
				$idPaciente = DB::table('paciente')
					->where('idPaciente', $paciente->getId())
					->update([
						'Nombre'   => $paciente->getNombre(),
						'Paterno'  => $paciente->getPaterno(),
						'Materno'  => $paciente->getMaterno(),
						'Telefono' => $paciente->getTelefono(),
						'Celular'  => $paciente->getCelular(),
						'Email'    => $paciente->getEmail()
					]);
			}

			return true;
		} catch(\Exception $e) {
			return false;
		}
	}
}