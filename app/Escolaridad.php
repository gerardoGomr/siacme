<?php
class Escolaridad
{
	//int
	private $id;
	//string
	private $escolaridad;

	public function getId()
	{
		return $this->id;
	}

	public function getEscolaridad()
	{
		return $this->escolaridad;
	}

	public function setId($id)
	{
		$this->id = $id;
	}

	public function setEscolaridad($escolaridad)
	{
		$this->escolaridad = $escolaridad;
	}
}