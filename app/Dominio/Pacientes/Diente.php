<?php
namespace Siacme\Dominio\Pacientes;

/**
 * Class Diente
 * @package Siacme\Dominio\Pacientes
 * @author  Gerardo Adrián Gómez Ruiz
 */
class Diente
{
	/**
	 * numero de diente
	 * @var int
	 */
	protected $numero;

	/**
	 * estatus del diente
	 * @var array
	 */
	protected $listaEstatus;

	/**
	 * constructor
	 * @param int
	 */
	public function __construct($numero, $listaEstatus = null)
	{
        $this->numero       = $numero;
        $this->listaEstatus = $listaEstatus;
	}

    /**
     * Gets the numero de diente.
     *
     * @return int
     */
    public function getNumero()
    {
        return $this->numero;
    }

    /**
     * Sets the numero de diente.
     *
     * @param int $numero the numero
     */
    public function setNumero($numero)
    {
        $this->numero = $numero;
    }

    /**
     * Gets the imagen del diente.
     *
     * @return string
     */
    public function getListaEstatus()
    {
        return $this->estatus;
    }

    /**
     * Sets the imagen del diente.
     *
     * @param array $estatus the imagen
     */
    public function setListaEstatus($listaEstatus)
    {
        $this->listaEstatus = $listaEstatus;
    }

    public function estatus($id)
    {
        foreach ($this->listaEstatus as $estatus) {

            if($estatus->getId() === $id) {
                return $estatus;
            }
        }

        return null;
    }
}