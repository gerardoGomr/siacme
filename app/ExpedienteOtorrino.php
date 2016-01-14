<?php
require_once "Expediente.php";
require_once "ExpedienteOtorrinoBD.php";

class ExpedienteOtorrino extends Expediente
{
	//string
	/*private $nombreRepresentante, $nombreTutor, $institucionMedica;

	public function getNombreRepresentante()
	{
		return $this->nombreRepresentante;
	}

	public function getNombreTutor()
	{
		return $this->nombreTutor;
	}

	public function getInstitucionMedica()
	{
		return $this->institucionMedica;
	}

	public function setNombreRepresentante($nombreRepresentante)
	{
		$this->nombreRepresentante = $nombreRepresentante;
	}

	public function setNombreTutor($nombreTutor)
	{
		$this->nombreTutor = $nombreTutor;
	}

	public function setInstitucionMedica($institucionMedica)
	{
		$this->institucionMedica = $institucionMedica;
	}
*/
	public function cargarDatos()
	{
		$expedienteBD = new ExpedienteOtorrinoBD();
		return $expedienteBD->cargarDatos($this);	
	}
	
	public function guardarDatos()
	{
		$expedienteBD = new ExpedienteOtorrinoBD();
		return $expedienteBD->guardarDatos($this);
	}

	public function editarDatos() 
	{
		$expedienteBD = new ExpedienteOtorrinoBD();
		return $expedienteBD->editarDatos($this);
	}
}