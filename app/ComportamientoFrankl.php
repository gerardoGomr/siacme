<?php

class ComportamientoFrankl
{
	//int
	private $id;
	//string
	private $comportamientoFrankl;

	public function getId()
	{
		return $this->id;
	}

	public function getComportamientoFrankl()
	{
		return $this->comportamientoFrankl;
	}

	public function setId($id)
	{
		$this->id = $id;
	}

	public function setComportamientoFrankl($comportamientoFrankl)
	{
		$this->comportamientoFrankl = $comportamientoFrankl;
	}

	//cargar de la base de datos
	public function cargarDatos()
	{
		
	}
}