<?php
namespace Siacme\Citas;

use DB;
use Siacme\Usuarios\Especialidad;
use Siacme\Usuarios\Usuario;
use Siacme\Expedientes\Expediente;
use Siacme\Expedientes\FabricaExpediente;
use Siacme\Pacientes\Paciente;
use Siacme\Usuarios\Medico;

/**
 * @author Gerardo Adrián Gómez Ruiz
 * @version 1.0
 * @date    25/08/2015
 */
class CitasRepositorioMySQL implements CitasRepositorioInterface
{
	/**
	 * guardar o editar una cita
	 * @param  Cita   $cita
	 * @return bool
	 */
	public function persistir(Cita $cita)
	{
		try {
			if(is_null($cita->getId())) {
				$idCita = DB::table('cita')
						      ->insertGetId([
									'UserDoctor'         => $cita->getMedico()->getUsername(),
									'idCitaEstatus'      => $cita->getEstatus()->getId(),
									'idPaciente'		 => $cita->getPaciente()->getId(),
									'FechaCita'          => $cita->getFecha(),
									'HoraCita'           => $cita->getHora(),
									'FechaCreacion' 	 => \Carbon\Carbon::now(),
									'FechaActualizacion' => \Carbon\Carbon::now()
						      	]);

				$cita->setId($idCita);

			} else {

				$idCita = DB::table('cita')
					->where('idCita', $cita->getId())
		      		->update([
						'FechaCita'			 => $cita->getFecha(),
						'HoraCita'			 => $cita->getHora(),
						'FechaActualizacion' => \Carbon\Carbon::now()
			      	]);
			}

			return true;

		} catch(Exception $e) {
			echo $e->getMessage();
			//mail del error para debug
			mail("gerardo.gomr@gmail.com", "Error en el sistema SIACM", "Error: ".$e->getMessage());
			return false;
		}
	}

	//asignar un expediente a la cita actual
	public function guardarExpediente(Cita $cita)
	{
		try {

			DB::table('cita_expediente')
				->insert([
					'idCita'             => $cita->getId(),
					'idExpediente'       => $cita->getExpediente()->getId(),
					'FechaCreacion'      => \Carbon\Carbon::now(),
					'FechaActualizacion' => \Carbon\Carbon::now()
				  ]);

			return true;
		} catch(Exception $e) {
			//mail del error para debug
			mail("gerardo.gomr@gmail.com", "Error en el sistema SIACM", "Error: ".$e->getMessage());

			return false;
		}
	}

	//obtener las citas del dia especificado
	public function obtenerCitasPorMedico($username, $fecha = '')
	{
		$listaCitas = array();

		// corregir la fecha en formato año/mes/dia para la base de datos
		$fecha = Cita::verificaFechaCita($fecha);

		try {

			$citas = DB::table('cita')
				->join('paciente', 'paciente.idPaciente', '=', 'cita.idPaciente')

				->where('cita.UserDoctor', $username)
				->where('cita.idCitaEstatus', '<>', '5')
				->where('cita.FechaCita', $fecha)
				->get();

			$totalCitas = count($citas);

			if($totalCitas > 0) {
				foreach ($citas as $citas) {

					$cita     = new Cita();
					$paciente = new Paciente();

					$paciente->setId($citas->idPaciente);
					$paciente->setNombre($citas->Nombre);
					$paciente->setPaterno($citas->Paterno);
					$paciente->setMaterno($citas->Materno);
					$paciente->setTelefono($citas->Telefono);
					$paciente->setCelular($citas->Celular);
					$paciente->setEmail($citas->Email);

					$cita->setId($citas->idCita);
					$cita->setFecha($citas->FechaCita);
					$cita->setHora($citas->HoraCita);
					$cita->setPaciente($paciente);

					$listaCitas[] = $cita;
				}

				return $listaCitas;
			}

			return null;

		} catch(Exception $e) {
			//mail del error para debug
			mail("gerardo.gomr@gmail.com", "Error en el sistema SIACM", "Error: ".$e->getMessage());
			echo $e->getMessage();
			return null;
		}
	}

	//cargar datos de la cita actual
	public function cargarDatos(Cita $cita)
	{
		try {

			$citas = DB::table('cita_expediente')
				->rightJoin('cita', 'cita_expediente.idCita', '=', 'cita.idCita')
				->leftJoin('expediente', 'expediente.idExpediente', '=', 'cita_expediente.idExpediente')
				->join('cita_estatus', 'cita.idCitaEstatus', '=', 'cita_estatus.idCitaEstatus')
				->join('usuario', 'usuario.Username', '=', 'cita.UserDoctor')
				->join('especialidad', 'usuario.idEspecialidad', '=', 'especialidad.idEspecialidad')
				->join('paciente', 'paciente.idPaciente', '=', 'cita.idPaciente')
				->select('cita.idCita', 'cita.idCitaEstatus', 'cita_estatus.CitaEstatus', 'cita.FechaCita', 'cita.HoraCita', 'cita_expediente.idExpediente', 'expediente.Firma','usuario.Username', 'usuario.idEspecialidad', 'expediente.Firma', 'paciente.Nombre', 'paciente.Paterno', 'paciente.Materno', 'paciente.idPaciente', 'paciente.Telefono', 'paciente.Celular', 'paciente.Email')
				->where('cita.idCita', $cita->getId())
				->first();

			$totalCitas = count($citas);

			if($totalCitas > 0) {
				$especialidad = new Especialidad();
				$especialidad->setId($citas->idEspecialidad);

				//cita estatus
				$citaEstatus = new CitaEstatus();
				$citaEstatus->setId($citas->idCitaEstatus);
				$citaEstatus->setEstatus($citas->CitaEstatus);

				// paciente
				$paciente = new Paciente();
				$paciente->setId($citas->idPaciente);
				$paciente->setNombre($citas->Nombre);
				$paciente->setPaterno($citas->Paterno);
				$paciente->setMaterno($citas->Materno);
				$paciente->setTelefono($citas->Telefono);
				$paciente->setCelular($citas->Celular);
				$paciente->setEmail($citas->Email);

				//expediente
				$expediente = FabricaExpediente::construirExpedienteBasico($citas->idEspecialidad);
				$expediente->setId($citas->idExpediente);
				$expediente->setFirma($citas->Firma);

				//medico
				$medico = new Medico($citas->Username);
				$medico->setEspecialidad($especialidad);

				$cita->setFecha($citas->FechaCita);
				$cita->setHora($citas->HoraCita);
				$cita->setMedico($medico);

				$cita->setEstatus($citaEstatus);
				$cita->setExpediente($expediente);
				$cita->setPaciente($paciente);

				return true;

			}

			return false;

		} catch(Exception $e) {
			//mail del error para debug
			mail("gerardo.gomr@gmail.com", "Error en el sistema SIACM", "Error: ".$e->getMessage());
			return false;
		}
	}

	public function actualizaEstatus(Cita $cita)
	{
		try {
			DB::table('cita')
				->where('idCita', $cita->getId())
				->update(['idCitaEstatus' => $cita->getEstatus()->getId()]);

			return true;

		} catch(Exception $e) {
			echo $e->getMessage();
			//mail del error para debug
			mail("gerardo.gomr@gmail.com", "Error en el sistema SIACM", "Error: ".$e->getMessage());
			return false;
		}
	}
}