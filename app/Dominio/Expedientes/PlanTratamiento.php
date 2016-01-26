<?php
namespace Siacme\Dominio\Expedientes;
use Illuminate\Support\Collection;

/**
 * Class PlanTratamiento
 * @package Siacme\Dominio\Expedientes
 * @author  Gerardo Adrián Gómez Ruiz
 */
class PlanTratamiento
{
    /**
     * @var int
     */
    protected $id;

    /**
     * @var Collection
     */
    protected $listaDientes;

    /**
     * @var double
     */
    protected $costo;

    /**
     * @var bool
     */
    protected $activo;

    /**
     * @var bool
     */
    protected $pagado;

    /**
     * PlanTratamiento constructor.
     * @param null $id
     * @param Collection|null $listaDientes
     */
    public function __construct($id = null, Collection $listaDientes = null)
    {
        $this->id = $id;
        $this->listaDientes = $listaDientes;
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
     * @return Collection
     */
    public function getListaDientes()
    {
        return $this->listaDientes;
    }

    /**
     * @param Collection $listaDientes
     */
    public function setListaDientes($listaDientes)
    {
        $this->listaDientes = $listaDientes;
    }

    /**
     * @return float
     */
    public function getCosto()
    {
        return $this->costo;
    }

    /**
     * @param float $costo
     */
    public function setCosto($costo)
    {
        $this->costo = $costo;
    }

    /**
     * @return boolean
     */
    public function activo()
    {
        return $this->activo;
    }

    /**
     * @param boolean $activo
     */
    public function setActivo($activo)
    {
        $this->activo = $activo;
    }

    /**
     * @return boolean
     */
    public function pagado()
    {
        return $this->pagado;
    }

    /**
     * @param boolean $pagado
     */
    public function setPagado($pagado)
    {
        $this->pagado = $pagado;
    }

    public function generarCosto()
    {
        $this->costo = 0;
        foreach ($this->listaDientes as $diente) {
            foreach ($diente->getListaTratamientos() as $tratamiento) {
                $this->costo += $tratamiento->getCosto();
            }
        }
    }
}