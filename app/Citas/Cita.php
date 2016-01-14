<?php
namespace Siacme\Citas;

use Siacme\Usuarios\Medico;
use Siacme\Expedientes\Expediente;
use Siacme\Pacientes\Paciente;

class Cita
{
	//int
	private $id;
	//date
	private $fecha;
	//time
	private $hora;
	//medico al que pertenece
	private $medico;
	//estatus de cita
	private $estatus;
	//expediente
	private $expediente;
	// paciente que solicita
	private $paciente;
	///////////////////////////////////////////////////////////////
	public function getId()
	{
		return $this->id;
	}

	public function getFecha()
	{
		return $this->fecha;
	}

	public function getHora()
	{
		return $this->hora;
	}

	public function getMedico()
	{
		return $this->medico;
	}

	public function getEstatus()
	{
		return $this->estatus;
	}

	public function getExpediente()
	{
		return $this->expediente;
	}
	///////////////////////////////////////////////////////////////
	///////////////////////////////////////////////////////////////
	public function setId($id)
	{
		$this->id = $id;
	}

	public function setFecha($fecha)
	{
		$this->fecha = $fecha;
	}

	public function setHora($hora)
	{
		$this->hora = $hora;
	}

	public function setMedico(Medico $medico)
	{
		$this->medico = $medico;
	}

	public function setEstatus(CitaEstatus $citaEstatus)
	{
		$this->estatus = $citaEstatus;
	}

	public function setExpediente(Expediente $expediente)
	{
		$this->expediente = $expediente;
	}

	public function getFinCita()
	{
		//calcular la duracion de la cita
		list($hora, $minuto, $segundo) = explode(":", $this->hora);
		//sumar 30 mun por default
		$finCita = mktime($hora, $minuto + 30, $segundo, 0 ,0 ,0);
		return $this->fecha." ".date("H", $finCita).":".date("i",$finCita).":".date("s",$finCita);
	}

    /**
     * Gets the value of paciente.
     *
     * @return Paciente $paciente
     */
    public function getPaciente()
    {
        return $this->paciente;
    }

    /**
     * Sets the value of paciente.
     *
     * @param mixed $paciente the paciente
     */
    public function setPaciente(Paciente $paciente)
    {
        $this->paciente = $paciente;
    }

    /**
     * verficiar fecha de cita
     */
    public static function verificaFechaCita($fecha)
    {
    	list($dia, $mes, $anio) = explode('/', $fecha);

    	return "$anio-$mes-$dia";
    }
}