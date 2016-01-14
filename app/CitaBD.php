<?php

namespace Siacme;

use DB;

class CitaBD
{
	//string
	private $query;

	//guardar nueva cita
	public function guardar(Cita $cita)
	{
		try {

			$idCita = DB::table('cita')
					      ->insertGetId([
								'UserDoctor'         => $cita->getMedico()->getUsername(),
								'idCitaEstatus'      => $cita->getEstatus()->getId(),
								'FechaCita'          => $cita->getFecha(),
								'HoraCita'           => $cita->getHora(),
								'NombreSolicita'     => $cita->getNombre(),
								'PaternoSolicita'    => $cita->getPaterno(),
								'MaternoSolicita'    => $cita->getMaterno(),
								'Telefono'           => $cita->getTelefono(),
								'Celular'            => $cita->getCelular(),
								'Email'              => $cita->getEmail(),
								'FechaCreacion' 	 => \Carbon\Carbon::now(),
								'FechaActualizacion' => \Carbon\Carbon::now()
					      	]);

			$cita->setId($idCita);


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
	public function obtenerCitasPorMedico($medico)
	{
		$listaCitas = array();

		try {

			$citas = DB::table('cita')
				->select('idCita', 'FechaCita', 'HoraCita', 'NombreSolicita', 'PaternoSolicita', 'MaternoSolicita')
				->where('UserDoctor', $medico)
				->where('idCitaEstatus', '<>', '5')
				->get();

			if($citas === null) {
				return null;
			}

			foreach ($citas as $citas) {

				$cita = new Cita();

				$cita->setId($citas->idCita);
				$cita->setFecha($citas->FechaCita);
				$cita->setHora($citas->HoraCita);
				$cita->setNombre($citas->NombreSolicita);
				$cita->setPaterno($citas->PaternoSolicita);
				$cita->setMaterno($citas->MaternoSolicita);

				$listaCitas[] = $cita;
			}

			return $listaCitas;

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
				->select('cita.idCita', 'cita.idCitaEstatus', 'cita_estatus.CitaEstatus', 'cita.FechaCita', 'cita.HoraCita', 'cita.NombreSolicita', 'cita.PaternoSolicita', 'cita.MaternoSolicita', 'cita.Telefono', 'cita.Celular', 'cita.Email', 'cita_expediente.idExpediente', 'usuario.Username', 'usuario.idEspecialidad', 'expediente.Firma')
				->where('cita.idCita', $cita->getId())
				->first();

			if($citas === null) {
				return false;
			}

			$especialidad = new Especialidad();
			$especialidad->setId($citas->idEspecialidad);

			//cita estatus
			$citaEstatus = new CitaEstatus();
			$citaEstatus->setId($citas->idCitaEstatus);
			$citaEstatus->setEstatus($citas->CitaEstatus);

			//expediente
			$expediente = new Expediente();
			$expediente->setId($citas->idExpediente);
			$expediente->setFirma($citas->Firma);

			//medico
			$medico = new Medico();
			$medico->setUsername($citas->Username);
			$medico->setEspecialidad($especialidad);

			$cita->setFecha($citas->FechaCita);
			$cita->setHora($citas->HoraCita);
			$cita->setNombre($citas->NombreSolicita);
			$cita->setPaterno($citas->PaternoSolicita);
			$cita->setMaterno($citas->MaternoSolicita);
			$cita->setTelefono($citas->Telefono);
			$cita->setEmail($citas->Email);
			$cita->setCelular($citas->Celular);
			$cita->setMedico($medico);

			$cita->setEstatus($citaEstatus);
			$cita->setExpediente($expediente);

			return true;

		} catch(Exception $e) {
			//mail del error para debug
			mail("gerardo.gomr@gmail.com", "Error en el sistema SIACM", "Error: ".$e->getMessage());
			return false;
		}
	}

	public function cambiarEstatus(Cita $cita)
	{
		$this->query = "UPDATE cita SET idCitaEstatus = ? WHERE idCita = ?";//echo $this->query;exit;
		$tiposDatos = "ii";
		$valores = $cita->getEstatus()->getId()."::".
					$cita->getId();

		try
		{
			BaseDatos::conectar();
			BaseDatos::insertar($this->query, $tiposDatos, $valores);
			BaseDatos::desconectar();
			return "1";
		}
		catch(Exception $e)
		{
			echo $e->getMessage();
			//mail del error para debug
			mail("gerardo.gomr@gmail.com", "Error en el sistema SIACM", "Error: ".$e->getMessage());
			return "0";
		}
	}

	public function cambiarFechaYHora(Cita $cita)
	{
		$this->query = "UPDATE cita SET FechaCita = ?, HoraCita = ? WHERE idCita = ?";//echo $this->query;exit;
		$tiposDatos = "ssi";
		$valores = $cita->getFecha()."::".
					$cita->getHora()."::".
					$cita->getId();

		try
		{
			BaseDatos::conectar();
			BaseDatos::insertar($this->query, $tiposDatos, $valores);
			BaseDatos::desconectar();
			return "1";
		}
		catch(Exception $e)
		{
			echo $e->getMessage();
			//mail del error para debug
			mail("gerardo.gomr@gmail.com", "Error en el sistema SIACM", "Error: ".$e->getMessage());
			return "0";
		}
	}

	public function asignarExpediente(Cita $cita, Expediente $expediente)
	{
		$this->query = "INSERT INTO cita_expediente (idCita, idExpediente, FechaActualizacion)
						VALUES (?, ?, NOW())";//echo $this->query;exit;
		$tiposDatos = "ii";
		$valores = $cita->getId()."::".
					$expediente->getId();

		try
		{
			BaseDatos::conectar();
			BaseDatos::insertar($this->query, $tiposDatos, $valores);
			BaseDatos::desconectar();
			return "1";
		}
		catch(Exception $e)
		{
			echo $e->getMessage();
			//mail del error para debug
			mail("gerardo.gomr@gmail.com", "Error en el sistema SIACM", "Error: ".$e->getMessage());
			return "0";
		}

	}
}