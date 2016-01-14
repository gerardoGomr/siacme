<?php

namespace Siacme\Citas;

class CitaEstatus
{
	//int
	private $id;
	//string
	private $estatus;

	public function __construct($id = null)
	{
		$this->id = $id;
	}

	public function getId()
	{
		return $this->id;
	}

	public function getEstatus()
	{
		return $this->estatus;
	}

	public function setId($id)
	{
		$this->id = $id;
	}

	public function setEstatus($estatus)
	{
		$this->estatus = $estatus;
	}
}