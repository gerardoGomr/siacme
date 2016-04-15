<?php
namespace Siacme\Dominio\Expedientes;

/**
 * Class TratamientoOdontologiaTipo
 * @package Siacme\Dominio\Expedientes
 * @author Gerardo Adrián Gómez Ruiz
 */
class TratamientoOdontologiaTipo
{
    private $nombre;

    public function __construct($nombre)
    {
        $this->nombre = $nombre;
    }
}