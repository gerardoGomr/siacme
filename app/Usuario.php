<?php
namespace Siacme;

class Usuario
{
	//string
	protected $username,
			  $passwd,
			  $nombre,
			  $paterno,
			  $materno,
			  $celular,
			  $telefono,
			  $activo,
			  $usuarioTipo;

	public function __construct($username = '')
	{
		$this->username = $username;
	}

	//////////////////////////////getters/////////////////////////////
	public function getUsername()
	{
		return $this->username;
	}

	public function getPasswd()
	{
		return $this->passwd;
	}

	public function getNombre()
	{
		return $this->nombre;
	}

	public function getPaterno()
	{
		return $this->paterno;
	}

	public function getMaterno()
	{
		return $this->materno;
	}

	public function getCelular()
	{
		return $this->celular;
	}

	public function getTelefono()
	{
		return $this->telefono;
	}

	public function getActivo()
	{
		return $this->activo;
	}

	public function getUsuarioTipo()
	{
		return $this->usuarioTipo;
	}

	//////////////////////////////SETTERS/////////////////////////////////////
	public function setUsername($username)
	{
		$this->username = $username;
	}

	public function setPasswd($passwd)
	{
		$this->passwd = $passwd;
	}

	public function setNombre($nombre)
	{
		$this->nombre = $nombre;
	}

	public function setPaterno($paterno)
	{
		$this->paterno = $paterno;
	}

	public function setMaterno($materno)
	{
		$this->materno = $materno;
	}

	public function setCelular($celular)
	{
		$this->celular = $celular;
	}

	public function setTelefono($telefono)
	{
		$this->telefono = $telefono;
	}

	public function setActivo($activo)
	{
		$this->activo = $activo;
	}

	public function setUsuarioTipo(UsuarioTipo $usuarioTipo)
	{
		$this->usuarioTipo = $usuarioTipo;
	}

	public function getNombreCompleto()
	{
		return $this->nombre.' '.$this->paterno.' '.$this->materno;
	}
}