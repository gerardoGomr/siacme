<?php

namespace Siacme\Usuarios;

class Especialidad
{
	//especialidad
	private $id;
	private $especialidad;

	public function getId()
	{
		return $this->id;
	}

	public function getEspecialidad()
	{
		return $this->especialidad;
	}

	public function setId($id)
	{
		$this->id = $id;
	}

	public function setEspecialidad($especialidad)
	{
		$this->especialidad = $especialidad;
	}
}