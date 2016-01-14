<?php
namespace Siacme\Usuarios;

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

	/**
	 * ve si el usuario está o no registrado
	 * @var bool
	 */
	protected $registrado;

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

    /**
     * Gets the ve si el usuario está o no registrado.
     *
     * @return bool
     */
    public function registrado()
    {
        return $this->registrado;
    }

    /**
     * Sets the ve si el usuario está o no registrado.
     *
     * @param bool $registrado the registrado
     */
    public function setRegistrado($registrado)
    {
        $this->registrado = $registrado;
    }

    /**
     * verifica la contraseña proporcionada
     * contra la seteada al usuario
     * @param  string $pass
     * @return bool
     */
    public function compruebaPassword($pass)
    {
    	if($this->passwd !== $pass) {
    		return false;
    	}

    	return true;
    }
}