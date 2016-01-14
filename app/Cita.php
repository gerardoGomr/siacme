<?php

namespace Siacme;

class Cita
{
	//int
	private $id;
	//date
	private $fecha;
	//time
	private $hora;
	//string
	private $nombre, $paterno, $materno, $telefono, $celular, $email;
	//medico a la que pertenece
	private $medico;
	//estatus de cita
	private $estatus;
	//expediente
	private $expediente;
	///////////////////////////////////////////////////////////////
	public function getId()
	{
		return $this->id;
	}

	public function getFecha()
	{
		return $this->fecha;
	}

	public function getHora()
	{
		return $this->hora;
	}

	public function getNombre()
	{
		return $this->nombre;
	}

	public function getPaterno()
	{
		return $this->paterno;
	}

	public function getMaterno()
	{
		return $this->materno;
	}

	public function getTelefono()
	{
		return $this->telefono;
	}

	public function getCelular()
	{
		return $this->celular;
	}

	public function getEmail()
	{
		return $this->email;
	}

	public function getMedico()
	{
		return $this->medico;
	}

	public function getEstatus()
	{
		return $this->estatus;
	}

	public function getExpediente()
	{
		return $this->expediente;
	}
	///////////////////////////////////////////////////////////////
	///////////////////////////////////////////////////////////////
	public function setId($id)
	{
		$this->id = $id;
	}

	public function setFecha($fecha)
	{
		$this->fecha = $fecha;
	}

	public function setHora($hora)
	{
		$this->hora = $hora;
	}

	public function setNombre($nombre)
	{
		$this->nombre = $nombre;
	}

	public function setPaterno($paterno)
	{
		$this->paterno = $paterno;
	}

	public function setMaterno($materno)
	{
		$this->materno = $materno;
	}

	public function setTelefono($telefono)
	{
		$this->telefono = $telefono;
	}

	public function setCelular($celular)
	{
		$this->celular = $celular;
	}

	public function setEmail($email)
	{
		$this->email = $email;
	}

	public function setMedico(Medico $medico)
	{
		$this->medico = $medico;
	}

	public function setEstatus(CitaEstatus $citaEstatus)
	{
		$this->estatus = $citaEstatus;
	}

	public function setExpediente(Expediente $expediente)
	{
		$this->expediente = $expediente;
	}

	public function getNombreCompleto()
	{
		return $this->nombre.' '.$this->paterno.' '.$this->materno;
	}

	/////////////////////////////////////////////////////////////////////
	public function guardar()
	{
		//guardar cita en la BD
		$citaBD = new CitaBD();
		return $citaBD->guardar($this);
	}

	public function guardarExpediente()
	{
		//guardar expediente
		$citaBD = new CitaBD();
		return $citaBD->guardarExpediente($this);
	}

	public function getFinCita()
	{
		//calcular la duracion de la cita
		list($hora, $minuto, $segundo) = explode(":", $this->hora);
		//sumar 30 mun por default
		$finCita = mktime($hora, $minuto + 30, $segundo, 0 ,0 ,0);
		return $this->fecha." ".date("H", $finCita).":".date("i",$finCita).":".date("s",$finCita);
	}

	public function cargarDatos()
	{
		//cargar datos
		$citaBD = new CitaBD();
		return $citaBD->cargarDatos($this);
	}

	public function cambiarEstatus()
	{
		//cambiar estatus
		$citaBD = new CitaBD();
		return $citaBD->cambiarEstatus($this);
	}

	public function reprogramar()
	{
		//cambiar estatus
		$citaBD = new CitaBD();
		return $citaBD->cambiarFechaYHora($this);
	}

	public function asignaExpediente(Expediente $expediente)
	{
		$citaBD = new CitaBD();
		return $citaBD->asignarExpediente($this, $expediente);
	}
}
