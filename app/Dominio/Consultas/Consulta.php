<?php
namespace Siacme\Dominio\Consultas;

/**
 * Class Consulta
 * @package Siacme\Dominio\Consultas
 * @author  Gerardo Adrián Gómez Ruiz
 */
class Consulta
{
	/**
	 * id autonumerico
	 * @var int
	 */
	protected $id;

	/**
	 * descripcion del motivo de consulta
	 * @var string
	 */
	protected $motivoConsulta;

	/**
	 * descripción de síntomas
	 * @var string
	 */
	protected $sintomas;

	/**
	 * descripción de patologías
	 * @var string
	 */
	protected $patologias;

	/**
	 * descripción de cirugías
	 * @var string
	 */
	protected $cirugias;

	/**
	 * receta que se expide
	 * @var Receta
	 */
	protected $receta;

	/**
	 * exploración física que se lleva a cabo
	 * @var ExploracionFisica
	 */
	protected $exploracionFisica;

	/**
	 * el costo de la consulta
	 * @var double
	 */
	protected $costo;

	/**
	 * el tratamiento que se llevará a cabo
	 * @var Tratamiento
	 */
	protected $tratamiento;

	/**
	 * cuando se envía a consulta con otro especialista
	 * @var Interconsulta
	 */
	protected $interconsulta;

	/**
	 * marcar como envío a interconsulta
	 * @var bool
	 */
	protected $envioAInterconsulta;

	/**
	 * marcar como envío a estudios
	 * @var bool
	 */
	protected $envioAEstudiosDeLaboratorio;

	/**
	 * cuando se genera una orden de estudio de laboratorio
	 * @var EstudioLaboratorio
	 */
	protected $estudioLaboratorio;

	/**
	 * fecha de consulta
	 * @var date
	 */
	protected $fecha;


	public function __construct($id = null)
	{
        $this->id = $id;
	}

    /**
     * Gets the id autonumerico.
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Sets the id autonumerico.
     *
     * @param int $id the id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * Gets the descripcion del motivo de consulta.
     *
     * @return string
     */
    public function getMotivoConsulta()
    {
        return $this->motivoConsulta;
    }

    /**
     * Sets the descripcion del motivo de consulta.
     *
     * @param string $motivoConsulta the motivo consulta
     */
    public function setMotivoConsulta($motivoConsulta)
    {
        $this->motivoConsulta = $motivoConsulta;
    }

    /**
     * Gets the descripción de síntomas.
     *
     * @return string
     */
    public function getSintomas()
    {
        return $this->sintomas;
    }

    /**
     * Sets the descripción de síntomas.
     *
     * @param string $sintomas the sintomas
     */
    public function setSintomas($sintomas)
    {
        $this->sintomas = $sintomas;
    }

    /**
     * Gets the descripción de patologías.
     *
     * @return string
     */
    public function getPatologias()
    {
        return $this->patologias;
    }

    /**
     * Sets the descripción de patologías.
     *
     * @param string $patologias the patologias
     */
    public function setPatologias($patologias)
    {
        $this->patologias = $patologias;
    }

    /**
     * Gets the descripción de cirugías.
     *
     * @return string
     */
    public function getCirugias()
    {
        return $this->cirugias;
    }

    /**
     * Sets the descripción de cirugías.
     *
     * @param string $cirugias the cirugias
     */
    public function setCirugias($cirugias)
    {
        $this->cirugias = $cirugias;
    }

    /**
     * Gets the receta que se expide.
     *
     * @return Receta
     */
    public function getReceta()
    {
        return $this->receta;
    }

    /**
     * Sets the receta que se expide.
     *
     * @param Receta $receta the receta
     */
    public function setReceta(Receta $receta)
    {
        $this->receta = $receta;
    }

    /**
     * Gets the exploración física que se lleva a cabo.
     *
     * @return ExploracionFisica
     */
    public function getExploracionFisica()
    {
        return $this->exploracionFisica;
    }

    /**
     * Sets the exploración física que se lleva a cabo.
     *
     * @param ExploracionFisica $exploracionFisica the exploracion fisica
     */
    public function setExploracionFisica(ExploracionFisica $exploracionFisica)
    {
        $this->exploracionFisica = $exploracionFisica;
    }

    /**
     * Gets the el costo de la consulta.
     *
     * @return double
     */
    public function getCosto()
    {
        return $this->costo;
    }

    /**
     * Sets the el costo de la consulta.
     *
     * @param double $costo the costo
     */
    public function setCosto($costo)
    {
        $this->costo = $costo;
    }

    /**
     * Gets the el tratamiento que se llevará a cabo.
     *
     * @return Tratamiento
     */
    public function getTratamiento()
    {
        return $this->tratamiento;
    }

    /**
     * Sets the el tratamiento que se llevará a cabo.
     *
     * @param Tratamiento $tratamiento the tratamiento
     */
    public function setTratamiento(Tratamiento $tratamiento)
    {
        $this->tratamiento = $tratamiento;
    }

    /**
     * Gets the cuando se envía a consulta con otro especialista.
     *
     * @return Interconsulta
     */
    public function getInterconsulta()
    {
        return $this->interconsulta;
    }

    /**
     * Sets the cuando se envía a consulta con otro especialista.
     *
     * @param Interconsulta $interconsulta the interconsulta
     */
    public function setInterconsulta(Interconsulta $interconsulta)
    {
        $this->interconsulta = $interconsulta;
    }

    /**
     * Gets the cuando se genera una orden de estudio de laboratorio.
     *
     * @return EstudioLaboratorio
     */
    public function getEstudioLaboratorio()
    {
        return $this->estudioLaboratorio;
    }

    /**
     * Sets the cuando se genera una orden de estudio de laboratorio.
     *
     * @param EstudioLaboratorio $estudioLaboratorio the estudio laboratorio
     */
    public function setEstudioLaboratorio(EstudioLaboratorio $estudioLaboratorio)
    {
        $this->estudioLaboratorio = $estudioLaboratorio;
    }

    /**
     * Gets the marcar como envío a interconsulta.
     *
     * @return bool
     */
    public function getEnvioAInterconsulta()
    {
        return $this->envioAInterconsulta;
    }

    /**
     * Sets the marcar como envío a interconsulta.
     *
     * @param bool $envioAInterconsulta the envio ainterconsulta
     */
    public function setEnvioAInterconsulta($envioAInterconsulta)
    {
        $this->envioAInterconsulta = $envioAInterconsulta;
    }

    /**
     * Gets the marcar como envío a estudios.
     *
     * @return bool
     */
    public function getEnvioAEstudiosDeLaboratorio()
    {
        return $this->envioAEstudiosDeLaboratorio;
    }

    /**
     * Sets the marcar como envío a estudios.
     *
     * @param bool $envioAEstudiosDeLaboratorio the envio aestudios de laboratorio
     */
    public function setEnvioAEstudiosDeLaboratorio($envioAEstudiosDeLaboratorio)
    {
	}

    /**
     * Gets the fecha de consulta.
     *
     * @return date
     */
    public function getFecha()
    {
        return $this->fecha;
    }

    /**
     * Sets the fecha de consulta.
     *
     * @param date $fecha the fecha
     */
    public function setFecha($fecha)
    {
        $this->fecha = $fecha;
    }

    /**
     * verifica si la consulta generó receta
     * @return bool
     */
    public function tieneReceta()
    {
    	if(is_null($this->receta)) {
    		return false;
    	}

    	return true;
    }
}