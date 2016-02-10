<?php
namespace Siacme\Infraestructura\Consultas;

/**
 * Interface RecetasRepositorioInterface
 * @package Siacme\Infraestructura\Consultas
 * @author  Gerardo Adrián Gómez Ruiz
 */
interface RecetasRepositorioInterface
{
    /**
     * @return Collection
     */
    public function obtenerRecetas();
}