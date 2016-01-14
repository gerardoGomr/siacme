<?php

namespace Siacme;

class Medico extends Usuario
{
	//especialidad
	private $especialidad;

	public function getEspecialidad()
	{
		return $this->especialidad;
	}

	public function setEspecialidad($especialidad)
	{
		$this->especialidad = $especialidad;
	}
}