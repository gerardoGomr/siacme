<?php

class ComportamientoInicial
{
	//int
	private $id;
	//string
	private $comportamientoInicial;

	public function getId()
	{
		return $this->id;
	}

	public function getComportamientoInicial()
	{
		return $this->comportamientoInicial;
	}

	public function setId($id)
	{
		$this->id = $id;
	}

	public function setComportamientoInicial($comportamientoInicial)
	{
		$this->comportamientoInicial = $comportamientoInicial;
	}

	//cargar de la base de datos
	public function cargarDatos()
	{
		
	}
}