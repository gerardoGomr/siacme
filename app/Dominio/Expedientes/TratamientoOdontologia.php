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

    public function __construct($dx, $costo, $duracion, $mensualidades)
    {
        $this->dx            = $dx;
        $this->costo         = $costo;
        $this->duracion      = $duracion;
        $this->mensualidades = $mensualidades;
        $this->listaTratamientos = new Collection();
    }

    public function generarTratamientos($ortopedia, $ortodoncia)
    {
        if ($ortopedia === true) {
            $this->listaTratamientos->put('ortopedia', new TratamientoOdontologiaTipo('ortopedia'));
        }

        if ($ortodoncia === true) {
            $this->listaTratamientos->put('ortodoncia', new TratamientoOdontologiaTipo('ortodoncia'));
        }
    }
}