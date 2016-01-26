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
     * @param DientePadecimiento|null $padecimiento
     * @param bool|true $existe
     */
	public function __construct($numero, DientePadecimiento $padecimiento = null, $existe = true)
	{
        $this->numero               = $numero;
        $this->listaPadecimientos[] = $padecimiento;
        $this->existe               = $existe;
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

    /**
     * agregar nuevo padecimiento al diente
     * @param DientePadecimiento $padecimiento
     */
    public function agregarPadecimiento(DientePadecimiento $padecimiento)
    {
        $this->listaPadecimientos[] = $padecimiento;
    }

    /**
     * remover todos los padecimientos del diente
     */
    public function removerPadecimientos()
    {
        $this->listaPadecimientos = null;
    }

    /**
     * devolver un padecimiento en base a su id
     * @param $id
     * @return DientePadecimiento
     */
    public function padecimiento($id)
    {
        foreach ($this->listaPadecimientos as $padecimiento) {

            if($padecimiento->getId() === $id) {
                return $padecimiento;
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