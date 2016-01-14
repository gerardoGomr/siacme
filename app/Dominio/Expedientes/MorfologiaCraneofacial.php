<?php
namespace Siacme\Expedientes;

/**
 * @author Gerardo Adrián Gómez Ruiz
 */
class MorfologiaCraneofacial
{
	//int
	private $id;
	//string
	private $morfologiaCraneofacial;

	public function getId()
	{
		return $this->id;
	}

	public function getMorfologiaCraneofacial()
	{
		return $this->morfologiaCraneofacial;
	}

	public function setId($id)
	{
		$this->id = $id;
	}

	public function setMorfologiaCraneofacial($morfologiaCraneofacial)
	{
		$this->morfologiaCraneofacial = $morfologiaCraneofacial;
	}

	//cargar de la base de datos
	public function cargarDatos()
	{

	}
}