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
	protected $listaPadecimientos;

    /**
     * @var bool
     */
    protected $existe;

    /**
     * Diente constructor.
     * @param $numero
     * @param null $listaPadecimientos
     * @param bool|true $existe
     */
	public function __construct($numero, $listaPadecimientos = null, $existe = true)
	{
        $this->numero             = $numero;
        $this->listaPadecimientos = $listaPadecimientos;
        $this->existe             = $existe;
	}

    /**
     * @return int
     */
    public function getNumero()
    {
        return $this->numero;
    }

    /**
     * @param int $numero the numero
     */
    public function setNumero($numero)
    {
        $this->numero = $numero;
    }

    /**
     * @return string
     */
    public function getListaPadecimientos()
    {
        return $this->listaPadecimientos;
    }

    /**
     * @param array $listaPadecimientos
     */
    public function setListaPadecimientos($listaPadecimientos)
    {
        $this->listaPadecimientos = $listaPadecimientos;
    }

    public function estatus($id)
    {
        foreach ($this->listaPadecimientos as $estatus) {

            if($estatus->getId() === $id) {
                return $estatus;
            }
        }

        return null;
    }

    /**
     * indica si el tipo de diente es de leche o permanente
     * @return string
     */
    public function tipo()
    {
        if ($this->numero >= 51) {
            return 'Leche';
        }

        return 'Permanente';
    }
}