<?php
class Religion
{
	//int
	private $id;
	//string
	private $religion;

	public function getId()
	{
		return $this->id;
	}

	public function getReligion()
	{
		return $this->religion;
	}

	public function setId($id)
	{
		$this->id = $id;
	}

	public function setReligion($religion)
	{
		$this->religion = $religion;
	}
}