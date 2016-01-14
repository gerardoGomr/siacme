<?php

class TrastornoLenguaje
{
	//int
	private $id;
	//string
	private $trastornoLenguaje;

	public function getId()
	{
		return $this->id;
	}

	public function getTrastornoLenguaje()
	{
		return $this->trastornoLenguaje;
	}

	public function setId($id)
	{
		$this->id = $id;
	}

	public function setTrastornoLenguaje($trastornoLenguaje)
	{
		$this->trastornoLenguaje = $trastornoLenguaje;
	}

	//cargar datos de la base de datos
	public function cargarDatos()
	{
		//
	}
}