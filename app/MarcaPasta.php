<?php
class MarcaPasta
{
	//int
	private $id;
	//string
	private $marcaPasta;

	//getters
	public function getId()
	{
		return $this->id;
	}

	public function getMarcaPasta()
	{
		return $this->marcaPasta;
	}

	/////////////////////////////////////////
	//setters
	public function setId($id)
	{
		$this->id = $id;
	}

	public function setMarcaPasta($marcaPasta)
	{
		$this->marcaPasta = $marcaPasta;
	}
}