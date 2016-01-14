<?php
namespace Siacme\Expedientes;

/**
* @author Gerardo Adrián Gómez Ruiz
*/
class Odontograma
{
	/**
	 * lista de dientes
	 * @var array
	 */
	protected $listaDientes;

	/**
	 * construir el odontograma con una lista de dientes
	 * si la lista no se proporciona, se asignan todos los diente
	 * caso contrario, se asigna el que se pasa como parámetro
	 * @param array $listaDientes
	 */
	public function __construct($listaDientes = null)
	{
		if(!is_null($listaDientes)) {
			$this->listaDientes = $listaDientes;

		} else {
			$this->agregarDientes(11, 18);
			$this->agregarDientes(21, 28);
			$this->agregarDientes(31, 38);
			$this->agregarDientes(41, 48);
			$this->agregarDientes(51, 55);
			$this->agregarDientes(61, 65);
			$this->agregarDientes(71, 75);
			$this->agregarDientes(81, 85);

		}
	}

	/**
	 * agregar nuevo diente
	 * @param  Diente $diente
	 * @return void
	 */
	public function agregarDiente(Diente $diente)
	{
		$this->listaDientes[] = $diente;
	}

	/**
	 * agregar dientes dependiendo el rango
	 * @param  int $inicio
	 * @param  int $fin
	 * @return void
	 */
	public function agregarDientes($inicio, $fin)
	{
		for ($i = $inicio; $i <= $fin; $i++) {
			$this->agregarDiente(new Diente($i,  array(new DienteEstatus())));
		}
	}

	/**
	 * encontrar un diente por numero
	 * @param  int $numero
	 * @return Diente
	 */
	public function diente($numero)
	{
		foreach ($this->listaDientes as $diente) {

			if($diente->getNumero() === $numero) {
				return $diente;
			}
		}

		throw new \Exception('Diente no encontrado');
	}

	/**
	 * encontrar un diente por numero
	 * @param  int $numero
	 * @return bool
	 */
	public function encontrarDientePorNumero($numero) {
		foreach ($this->listaDientes as $diente) {

			if($diente->getNumero() === $numero) {
				return true;
			}
		}

		return false;
	}
}