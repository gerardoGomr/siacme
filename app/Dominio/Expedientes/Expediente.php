<?php
namespace Siacme\Dominio\Expedientes;

use Siacme\Dominio\Pacientes\Paciente;
use Siacme\Dominio\Usuarios\Usuario;

/**
 * Class Expediente
 * @package Siacme\Dominio\Expedientes
 * @author  Gerardo Adrián Gómez Ruiz
 */
class Expediente
{
	/**
	 * @var int
	 */
	protected $id;

	/**
	 * @var string
	 */
	protected $firma;

	/**
	 * @var bool
	 */
	protected $primeraVez;

	/**
	 * @var Paciente
	 */
	protected $paciente;

	/**
	 * @var Usuario
	 */
	protected $medico;

	/**
	 * @var Collection
	 */
	protected $listaInterconsultas;

	/**
	 * @var Collection
	 */
	protected $listaPlanesTratamiento;

	/**
	 * @var Collection
	 */
	protected $listaOdontogramas;

	/**
	 * Expediente constructor.
	 * @param null $id
	 */
	public function __construct($id = null)
	{
		$this->id = $id;
	}

	/**
	 * @return int
	 */
	public function getId()
	{
		return $this->id;
	}

	/**
	 * @param int $id
	 */
	public function setId($id)
	{
		$this->id = $id;
	}

	/**
	 * @return string
	 */
	public function getFirma()
	{
		return $this->firma;
	}

	/**
	 * @param string $firma
	 */
	public function setFirma($firma)
	{
		$this->firma = $firma;
	}

	/**
	 * @return boolean
	 */
	public function primeraVez()
	{
		return $this->primeraVez;
	}

	/**
	 * @param boolean $primeraVez
	 */
	public function setPrimeraVez($primeraVez)
	{
		$this->primeraVez = false;

		if (is_numeric($primeraVez)) {
			if ((int)$primeraVez === 1) {
				$this->primeraVez = true;
			}
		} else {
			$this->primeraVez = $primeraVez;
		}
	}

	/**
	 * @return Paciente
	 */
	public function getPaciente()
	{
		return $this->paciente;
	}

	/**
	 * @param Paciente $paciente
	 */
	public function setPaciente(Paciente $paciente)
	{
		$this->paciente = $paciente;
	}

	/**
	 * @return Usuario
	 */
	public function getMedico()
	{
		return $this->medico;
	}

	/**
	 * @param Usuario $medico
	 */
	public function setMedico(Usuario $medico)
	{
		$this->medico = $medico;
	}

	/**
	 * evalua la existencia del campo firma
	 * si es nulo, necesita firma devuelve true
	 * caso contrario, devuelve false
	 * @return bool
	 */
	public function necesitaFirma()
	{
		if(is_null($this->firma)) {
			return true;
		}

		return false;
	}

    /**
     * devuelve el número de expediente a 6 cifras
     * @return string
     */
    public function numeroExpediente()
    {
    	$longitudId = strlen((string)$this->id);
    	$aRellenar  = 6 - $longitudId;
    	$numero     = '';

    	for($i = 1; $i <= $aRellenar; $i++) {
    		$numero .= '0';
    	}

    	return $numero . (string)$this->id;
    }
}