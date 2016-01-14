<?php
namespace Siacme\Trastornos;

/**
 * @author Gerardo Adrián Gómez Ruiz
 * @date   03/08/2015
 */
class TrastornoLenguaje
{
	/**
	 * id autonumerico
	 * @var int
	 */
	private $id;

	/**
	 * la descripcion del trastorno
	 * @var [type]
	 */
	private $trastornoLenguaje;

	/**
	 * retornar el id
	 * @return int
	 */
	public function getId()
	{
		return $this->id;
	}

	/**
	 * retornar la descripcion
	 * @return string
	 */
	public function getTrastornoLenguaje()
	{
		return $this->trastornoLenguaje;
	}

	/**
	 * setear id
	 * @param int $id
	 */
	public function setId($id)
	{
		$this->id = $id;
	}

	/**
	 * setear descripcion
	 * @param string $trastornoLenguaje
	 */
	public function setTrastornoLenguaje($trastornoLenguaje)
	{
		$this->trastornoLenguaje = $trastornoLenguaje;
	}
}