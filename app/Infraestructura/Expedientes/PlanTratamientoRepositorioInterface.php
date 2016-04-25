<?php
namespace Siacme\Infraestructura\Expedientes;

use Siacme\Dominio\Consultas\PlanTratamiento;

/**
 * Interface PlanTratamientoRepositorioInterface
 * @package Siacme\Infraestructura\Expedientes
 * @author Gerardo Adrián Gómez Ruiz
 */
interface PlanTratamientoRepositorioInterface
{
    public function actualizarAtencionTratamiento(PlanTratamiento $plan);
}