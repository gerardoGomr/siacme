<?php
namespace Siacme\Dominio\Pacientes;
use Illuminate\Support\Collection;
use Siacme\Dominio\Consultas\DientePlan;

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
     * tratamientos del diente
     * @var Collection
     */
    protected $listaTratamientos;

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
     * @throws \Exception
     */
    public function agregarPadecimiento(DientePadecimiento $padecimiento)
    {
        if (count($this->listaPadecimientos) > 2) {
            throw new \Exception('Solo se permiten hasta dos padecimientos');
        }
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

    /**
     * @return Collection
     */
    public function getListaTratamientos()
    {
        return $this->listaTratamientos;
    }

    /**
     * @param Collection $listaTratamientos
     */
    public function setListaTratamientos(Collection $listaTratamientos)
    {
        $this->listaTratamientos = $listaTratamientos;
    }

    /**
     * agregar nuevo tratamiento al diente
     * @param DientePlan $tratamiento
     * @throws \Exception
     */
    public function agregarTratamiento(DientePlan $tratamiento)
    {
        if(is_null($this->listaTratamientos)) {
            $this->listaTratamientos = new Collection();
        }

        if (count($this->listaTratamientos) === 2) {
            throw new \Exception('Solo se permiten hasta dos tratamientos por diente');
        }

        $this->listaTratamientos->push($tratamiento);
    }

    /**
     * remover todos los tratamientos del diente
     */
    public function removerTratamientos()
    {
        $this->listaTratamientos = null;
    }

    /**
     * devolver un padecimiento en base a su id
     * @param $id
     * @return DientePlan
     */
    public function tratamiento($id)
    {
        foreach ($this->listaTratamientos as $tratamiento) {

            if($tratamiento->getId() === $id) {
                return $tratamiento;
            }
        }

        return null;
    }
}