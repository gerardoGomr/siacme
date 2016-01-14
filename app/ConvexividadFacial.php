<?php

class ConvexividadFacial
{
	//int
	private $id;
	//string
	private $convexividadFacial;

	public function getId()
	{
		return $this->id;
	}

	public function getConvexividadFacial()
	{
		return $this->convexividadFacial;
	}

	public function setId($id)
	{
		$this->id = $id;
	}

	public function setConvexividadFacial($convexividadFacial)
	{
		$this->convexividadFacial = $convexividadFacial;
	}

	//cargar de la base de datos
	public function cargarDatos()
	{

	}
}