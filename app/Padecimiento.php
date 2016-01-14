<?php

class Padecimiento
{
	//int
	private $id;
	//string
	private $padecimiento;

	public function getId()
	{
		return $this->id;
	}

	public function getPadecimiento()
	{
		return $this->padecimiento;
	}

	public function setId($id)
	{
		$this->id = $id;
	}

	public function setPadecimiento($padecimiento)
	{
		$this->padecimiento = $padecimiento;
	}
}