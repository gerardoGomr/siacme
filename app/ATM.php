<?php

class ATM
{
	//int
	private $id;
	//string
	private $atm;

	public function getId()
	{
		return $this->id;
	}

	public function getATM()
	{
		return $this->atm;
	}

	public function setId($id)
	{
		$this->id = $id;
	}

	public function setATM($atm)
	{
		$this->atm = $atm;
	}

	//cargar de la base de datos
	public function cargarDatos()
	{

	}
}