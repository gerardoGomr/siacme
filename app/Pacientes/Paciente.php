<?php
namespace Siacme\Pacientes;

/**
* @author Gerardo Adrián Gómez Ruiz
*/
class Paciente
{
	/**
	 * id
	 * @var int
	 */
	protected $id;

	/**
	 * nombre de paciente
	 * @var string
	 */
	protected $nombre;

	/**
	 * apellido paterno
	 * @var string
	 */
	protected $paterno;

	/**
	 * apellido materno
	 * @var string
	 */
	protected $materno;

	/**
	 * telefono
	 * @var string
	 */
	protected $telefono;

	/**
	 * celular
	 * @var string
	 */
	protected $celular;

	/**
	 * correo electrónico
	 * @var string
	 */
	protected $email;

	/**
	 * bandera que indica si es nuevo o subsecuente
	 * @var bool
	 */
	protected $nuevoPaciente;

    /**
     * Gets the id.
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Sets the id.
     *
     * @param int $id the id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * Gets the nombre de paciente.
     *
     * @return string
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * Sets the nombre de paciente.
     *
     * @param string $nombre the nombre
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
    }

    /**
     * Gets the apellido paterno.
     *
     * @return string
     */
    public function getPaterno()
    {
        return $this->paterno;
    }

    /**
     * Sets the apellido paterno.
     *
     * @param string $paterno the paterno
     */
    public function setPaterno($paterno)
    {
        $this->paterno = $paterno;
    }

    /**
     * Gets the apellido materno.
     *
     * @return string
     */
    public function getMaterno()
    {
        return $this->materno;
    }

    /**
     * Sets the apellido materno.
     *
     * @param string $materno the materno
     */
    public function setMaterno($materno)
    {
        $this->materno = $materno;
    }

    /**
     * Gets the telefono.
     *
     * @return string
     */
    public function getTelefono()
    {
        return $this->telefono;
    }

    /**
     * Sets the telefono.
     *
     * @param string $telefono the telefono
     */
    public function setTelefono($telefono)
    {
        $this->telefono = $telefono;
    }

    /**
     * Gets the celular.
     *
     * @return string
     */
    public function getCelular()
    {
        return $this->celular;
    }

    /**
     * Sets the celular.
     *
     * @param string $celular the celular
     */
    public function setCelular($celular)
    {
        $this->celular = $celular;
    }

    /**
     * Gets the correo electrónico.
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Sets the correo electrónico.
     *
     * @param string $email the email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * Gets the bandera que indica si es nuevo o subsecuente.
     *
     * @return bool
     */
    public function nuevoPaciente()
    {
        return $this->nuevoPaciente;
    }

    /**
     * Sets the bandera que indica si es nuevo o subsecuente.
     *
     * @param bool $nuevoPaciente the nuevo paciente
     */
    public function setNuevoPaciente($nuevoPaciente)
    {
        $this->nuevoPaciente = $nuevoPaciente;
    }
	
	/**
	 * devuelve el nombre completo de la persona
	 * @return string
	 */
	public function nombreCompleto()
	{
		$nombre = $this->nombre;
		
		if(strlen($this->paterno)) {
			$nombre .= ' '.$this->paterno;
		}
		
		if(strlen($this->materno)) {
			$nombre .= ' '.$this->materno;
		}
		
		return $nombre;
		
		
	}
}