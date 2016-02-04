<?php
namespace Siacme\Dominio\Consultas;
use Illuminate\Support\Collection;
use Siacme\Dominio\Pacientes\Odontograma;

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
	 * @param bool $atendido
	 * @param Collection $listaDientes
	 */
	public function __construct($atendido = true, Collection $listaDientes = null)
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
		foreach ($this->listaDientes as $diente) {
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
		foreach ($this->listaDientes as $diente) {
			foreach ($diente->getListaTratamientos() as $tratamiento) {
				$atendido = $tratamiento->atendido();
			}
		}

		return $atendido;
	}

	/**
	 * generar el plan a partir de la lista de dientes del odontograma
	 * @param Odontograma $odontograma
	 */
	public function generarDeOdontograma(Odontograma $odontograma)
	{
		$this->listaDientes = $odontograma->getListaDientes();
	}

	/**
	 * @return Collection
	 */
	public function getListaDientes()
	{
		return $this->listaDientes;
	}

	/**
	 * @param Collection $listaDientes
	 */
	public function setListaDientes(Collection $listaDientes)
	{
		$this->listaDientes = $listaDientes;
	}

	public function diente($numero)
	{
		foreach ($this->listaDientes as $diente) {

			if($diente->getNumero() === $numero) {
				return $diente;
			}
		}
		/*if ($this->existeDiente($numero)) {
			return $this->listaDientes->get($numero);
		}*/
	}

	private function existeDiente($numero)
	{
		if ($this->listaDientes->has($numero)) {
			return true;
		}

		return false;
	}
}