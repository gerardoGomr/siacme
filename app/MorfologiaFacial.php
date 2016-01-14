<?php

class MorfologiaFacial
{
	//int
	private $id;
	//string
	private $morfologiaFacial;

	public function getId()
	{
		return $this->id;
	}

	public function getMorfologiaFacial()
	{
		return $this->morfologiaFacial;
	}

	public function setId($id)
	{
		$this->id = $id;
	}

	public function setMorfologiaFacial($morfologiaFacial)
	{
		$this->morfologiaFacial = $morfologiaFacial;
	}

	public function cargarDatos()
	{
		
	}
}