<?php
class EstadoCivil
{
	//int
	private $id;
	//string
	private $estadoCivil;

	public function getId()
	{
		return $this->id;
	}

	public function getEstadoCivil()
	{
		return $this->estadoCivil;
	}

	public function setId($id)
	{
		$this->id = $id;
	}

	public function setEstadoCivil($estadoCivil)
	{
		$this->estadoCivil = $estadoCivil;
	}
}