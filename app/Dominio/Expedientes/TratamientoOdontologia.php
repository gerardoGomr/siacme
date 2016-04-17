<?php
namespace Siacme\Dominio\Expedientes;

use Illuminate\Support\Collection;

/**
 * Class TratamientoOdontologia
 * @package Siacme\Dominio\Expedientes
 * @author Gerardo Adrián Gómez Ruiz
 */
class TratamientoOdontologia
{
    private $dx, $costo, $duracion, $mensualidades;
    private $listaTratamientos;

    /**
     * TratamientoOdontologia constructor.
     * @param string $dx
     * @param string $costo
     * @param string $duracion
     * @param int $mensualidades
     */
    public function __construct($dx, $costo, $duracion, $mensualidades)
    {
        $this->dx                = $dx;
        $this->costo             = $costo;
        $this->duracion          = $duracion;
        $this->mensualidades     = $mensualidades;
        $this->listaTratamientos = new Collection();
    }

    /**
     * generar uno o dos tratamientos
     * @param bool $ortopedia
     * @param bool $ortodoncia
     */
    public function generarTratamientos($ortopedia, $ortodoncia)
    {
        if ($ortopedia === true) {
            $this->listaTratamientos->put('ortopedia', new TratamientoOdontologiaTipo('ortopedia'));
        }

        if ($ortodoncia === true) {
            $this->listaTratamientos->put('ortodoncia', new TratamientoOdontologiaTipo('ortodoncia'));
        }
    }

    /**
     * @return string
     */
    public function getDx()
    {
        return $this->dx;
    }

    /**
     * @return string
     */
    public function getCosto()
    {
        return $this->costo;
    }

    /**
     * @return string
     */
    public function getDuracion()
    {
        return $this->duracion;
    }

    /**
     * @return int
     */
    public function getMensualidades()
    {
        return $this->mensualidades;
    }

    /**
     * @return Collection
     */
    public function getListaTratamientos()
    {
        return $this->listaTratamientos;
    }
}