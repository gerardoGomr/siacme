<?php
namespace Siacme\Dominio\Pacientes;
use Illuminate\Support\Collection;

/**
 * Class Anexo
 * @package Siacme\Dominio\Pacientes
 * @author  Gerardo Adrián Gómez Ruiz
 */
class Anexo
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var Collection
     */
    private $listaArchivos;

    /**
     * @var int
     */
    private $numeroArchivos;

    /**
     * Anexo constructor.
     * @param int $id
     */
    public function __construct($id = null)
    {
        $this->id             = $id;
        $this->numeroArchivos = 0;

        if (is_null($this->listaArchivos)) {
            $this->listaArchivos = new Collection();
        }
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
    public function getListaArchivos()
    {
        return $this->listaArchivos;
    }

    /**
     * @param Collection $listaArchivos
     */
    public function setListaArchivos(Collection $listaArchivos)
    {
        $this->listaArchivos = $listaArchivos;
    }

    public function agregarArchivo(Archivo $archivo)
    {
        $this->numeroArchivos += 1;
        $this->listaArchivos->put($this->numeroArchivos, $archivo);
    }
}