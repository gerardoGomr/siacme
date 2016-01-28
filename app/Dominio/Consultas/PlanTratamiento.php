<?php
namespace Siacme\Dominio\Consultas;

/**
 * @package Siacme\Dominio\Consultas
 * @author  Gerardo Adrián Gómez Ruiz
 */
class PlanTratamiento
{
	/**
	 * @var bool
	 */
	private $atendido;

	/**
	 * @var double
	 */
	private $costo;

	/**
	 * @var Collection
	 */
	private $listaDientes;

	/**
	 * @var string
	 */
	private $aQuienSeDirige;

	/**
	 * constructor
	 * @param bool $activo
	 * @param Collection $listaDientes
	 */
	public function __construct($atendido = true, $listaDientes = null)
	{
		$this->atendido     = $atendido;
		$this->listaDientes = $listaDientes;
	}

	/**
	 * devuelve el costo total del tratamiento
	 * @return double
	 */
	public function costo()
	{
		$costo = 0;
		foreach ($listaDientes as $diente) {
			foreach ($diente->getListaTratamientos() as $tratamiento) {
				$costo += $tratamiento->getDienteTratamiento()->getCosto();
			}
		}

		return $costo;
	}

	/**
	 * verifica si esta atendido o no el plan
	 * @return bool
	 */
	public function atendido()
	{
		$atendido = false;
		foreach ($listaDientes as $diente) {
			foreach ($diente->getListaTratamientos() as $tratamiento) {
				$atendido = $tratamiento->atendido();
			}
		}

		return $atendido;
	}
}