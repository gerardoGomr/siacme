<?php
namespace Siacme\Consultas;

/**
* @author Gerardo Adrián Gómez Ruiz
*/
class Receta
{
	/**
	 * id autonumerico
	 * @var int
	 */
	protected $id;

	/**
	 * lista de indicaciones
	 * @var array
	 */
	protected $listaIndicaciones;

	/**
	 * firma de la receta
	 * @var string
	 */
	protected $firma;

	function __construct()
	{
		# code...
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
     * Gets the lista de indicaciones.
     *
     * @return array
     */
    public function getListaIndicaciones()
    {
        return $this->listaIndicaciones;
    }

    /**
     * Sets the lista de indicaciones.
     *
     * @param array $listaIndicaciones the lista indicaciones
     */
    public function setListaIndicaciones(array $listaIndicaciones)
    {
        $this->listaIndicaciones = $listaIndicaciones;
    }

    /**
     * agregar indicación a la receta
     * @param  Indicacion $indicacion
     * @return void
     */
    public function agregaIndicacion(Indicacion $indicacion)
    {
    	$this->listaIndicaciones[] = $indicacion;
    }

    /**
     * Gets the firma de la receta.
     *
     * @return string
     */
    public function getFirma()
    {
        return $this->firma;
    }

    /**
     * Sets the firma de la receta.
     *
     * @param string $firma the firma
     */
    public function setFirma($firma)
    {
        $this->firma = $firma;
    }

    /**
     * verifica si la receta es valida
     * cuando tiene al menos una indicación
     * @return bool
     */
    public function valida()
    {
    	if(is_null($this->listaIndicaciones) || count($this->listaIndicaciones) === 0) {
    		return false;
    	}

    	return true;
    }
}