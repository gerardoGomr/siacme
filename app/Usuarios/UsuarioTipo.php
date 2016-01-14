<?php

namespace Siacme\Usuarios;

class UsuarioTipo
{
	private $id, $usuarioTipo;

    public function __construct($id = null)
    {
    	$this->id = $id;
    }

    public function getId()
    {
    	return $this->id;
    }

    public function getUsuarioTipo()
    {
    	return $this->usuarioTipo;
    }

    public function setId($id)
    {
    	$this->id = $id;
    }

    public function setUsuarioTipo($usuarioTipo)
    {
    	$this->usuarioTipo = $usuarioTipo;
    }
}
