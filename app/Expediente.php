<?php
namespace Siacme;

class Expediente
{
	//int
	protected $id, $edadAnios, $edadMeses, $seHaAutomedicado, $esAlergico, $viveMadre, $vivePadre, $numHermanos, $numHermanosVivos, $numHermanosFinados, $seLeHacenMoretones, $haRequeridoTransfusion, $haTenidoFracturas, $haSidoIntervenido, $haSidoHospitalizado, $exAdicto, $estaBajoTratamiento, $subsecuente;
	//string
	protected $nombre, $paterno, $materno, $telefono, $celular, $email, $direccion, $cp, $municipio, $lugarNacimiento, $nombrePediatra, $nombreRecomienda, $conQueSeHaAutomedicado, $aQueMedicamentoEsAlergico, $causaMuerteMadre, $enfermedadesMadre, $causaMuertePadre, $enfermedadesPadre, $causaMuerteHermanos, $enfermedadesHermanos, $enfermedadesAbuelosPaternos, $enfermedadesAbuelosMaternos, $especifiqueFracturas, $especifiqueIntervencion, $especifiqueHospitalizacion, $especifiqueTratamiento, $firma, $nombreRepresentante, $nombreTutor, $ocupacionTutor, $motivoConsulta, $historiaEnfermedad, $padecimientoActual, $interrogatorioPorAparatos, $resultadosLaboratorio, $terapeuticaEmpleada;
	//date
	protected $fechaCreacion, $fechaNacimiento;
	//estado civil
	protected $estadoCivil;
	//religion
	protected $religion;
	//escolaridad
	protected $escolaridad;
	//lista padecimientos
	protected $listaPadecimientos;
	//institucion médica
	protected $institucionMedica;

	//double
	protected $peso, $talla, $pulso, $temperatura, $tensionArterial;

	public function getId()
	{
		return $this->id;
	}

	public function getEdadAnios()
	{
		return $this->edadAnios;
	}

	public function getEdadMeses()
	{
		return $this->edadMeses;
	}

	public function getSeHaAutomedicado()
	{
		return $this->seHaAutomedicado;
	}

	public function getEsAlergico()
	{
		return $this->esAlergico;
	}

	public function getViveMadre()
	{
		return $this->viveMadre;
	}

	public function getVivePadre()
	{
		return $this->vivePadre;
	}

	public function getNumHermanos()
	{
		return $this->numHermanos;
	}

	public function getNumHermanosVivos()
	{
		return $this->numHermanosVivos;
	}

	public function getNumHermanosFinados()
	{
		return $this->numHermanosFinados;
	}

	public function getSeLeHacenMoretones()
	{
		return $this->seLeHacenMoretones;
	}

	public function getHaRequeridoTransfusion()
	{
		return $this->haRequeridoTransfusion;
	}

	public function getHaTenidoFracturas()
	{
		return $this->haTenidoFracturas;
	}

	public function getHaSidoIntervenido()
	{
		return $this->haSidoIntervenido;
	}

	public function getHaSidoHospitalizado()
	{
		return $this->haSidoHospitalizado;
	}

	public function getExAdicto()
	{
		return $this->exAdicto;
	}

	public function getEstaBajoTratamiento()
	{
		return $this->estaBajoTratamiento;
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

	public function getTelefono()
	{
		return $this->telefono;
	}

	public function getCelular()
	{
		return $this->celular;
	}

	public function getEmail()
	{
		return $this->email;
	}

	public function getDireccion()
	{
		return $this->direccion;
	}

	public function getCP()
	{
		return $this->cp;
	}

	public function getMunicipio()
	{
		return $this->municipio;
	}

	public function getLugarNacimiento()
	{
		return $this->lugarNacimiento;
	}

	public function getNombrePediatra()
	{
		return $this->nombrePediatra;
	}

	public function getNombreRecomienda()
	{
		return $this->nombreRecomienda;
	}

	public function getConQueSeHaAutomedicado()
	{
		return $this->conQueSeHaAutomedicado;
	}

	public function getAQueMedicamentoEsAlergico()
	{
		return $this->aQueMedicamentoEsAlergico;
	}

	public function getCausaMuerteMadre()
	{
		return $this->causaMuerteMadre;
	}

	public function getEnfermedadesMadre()
	{
		return $this->enfermedadesMadre;
	}

	public function getCausaMuertePadre()
	{
		return $this->causaMuertePadre;
	}

	public function getEnfermedadesPadre()
	{
		return $this->enfermedadesPadre;
	}

	public function getCausaMuerteHermanos()
	{
		return $this->causaMuerteHermanos;
	}

	public function getEnfermedadesHermanos()
	{
		return $this->enfermedadesHermanos;
	}

	public function getEnfermedadesAbuelosPaternos()
	{
		return $this->enfermedadesAbuelosPaternos;
	}

	public function getEnfermedadesAbuelosMaternos()
	{
		return $this->enfermedadesAbuelosMaternos;
	}

	public function getEspecifiqueFracturas()
	{
		return $this->especifiqueFracturas;
	}

	public function getEspecifiqueIntervencion()
	{
		return $this->especifiqueIntervencion;
	}

	public function getEspecifiqueHospitalizacion()
	{
		return $this->especifiqueHospitalizacion;
	}

	public function getEspecifiqueTratamiento()
	{
		return $this->especifiqueTratamiento;
	}

	public function getFechaNacimiento()
	{
		return $this->fechaNacimiento;
	}

	public function getEstadoCivil()
	{
		return $this->estadoCivil;
	}

	public function getReligion()
	{
		return $this->religion;
	}

	public function getEscolaridad()
	{
		return $this->escolaridad;
	}

	public function getListaPadecimientos()
	{
		return $this->listaPadecimientos;
	}

	public function getFirma()
	{
		return $this->firma;
	}

	public function getNombreRepresentante()
	{
		return $this->nombreRepresentante;
	}

	public function getNombreTutor()
	{
		return $this->nombreTutor;
	}

	public function getOcupacionTutor()
	{
		return $this->ocupacionTutor;
	}

	public function getMotivoConsulta()
	{
		return $this->motivoConsulta;
	}

	public function getHistoriaEnfermedad()
	{
		return $this->historiaEnfermedad;
	}

	public function getInstitucionMedica()
	{
		return $this->institucionMedica;
	}

	public function getPadecimientoActual()
	{
		return $this->padecimientoActual;
	}

	public function getInterrogatorioPorAparatos()
	{
		return $this->interrogatorioPorAparatos;
	}

	public function getPeso()
	{
		return $this->peso;
	}

	public function getTalla()
	{
		return $this->talla;
	}

	public function getPulso()
	{
		return $this->pulso;
	}

	public function getTemperatura()
	{
		return $this->temperatura;
	}

	public function getTensionArterial()
	{
		return $this->tensionArterial;
	}

	public function getResultadosLaboratorio()
	{
		return $this->resultadosLaboratorio;
	}

	public function getTerapeuticaEmpleada()
	{
		return $this->terapeuticaEmpleada;
	}

	public function getSubsecuente()
	{
		return $this->subsecuente;
	}
	///////////////////////////////////////////////////////////
	public function setId($id)
	{
		$this->id = $id;
	}

	public function setEdadAnios($edadAnios)
	{
		$this->edadAnios = $edadAnios;
	}

	public function setEdadMeses($edadMeses)
	{
		$this->edadMeses = $edadMeses;
	}

	public function setSeHaAutomedicado($seHaAutomedicado)
	{
		$this->seHaAutomedicado = $seHaAutomedicado;
	}

	public function setEsAlergico($esAlergico)
	{
		$this->esAlergico = $esAlergico;
	}

	public function setViveMadre($viveMadre)
	{
		$this->viveMadre = $viveMadre;
	}

	public function setVivePadre($vivePadre)
	{
		$this->vivePadre = $vivePadre;
	}

	public function setNumHermanos($numHermanos)
	{
		$this->numHermanos = $numHermanos;
	}

	public function setNumHermanosVivos($numHermanosVivos)
	{
		$this->numHermanosVivos = $numHermanosVivos;
	}

	public function setNumHermanosFinados($numHermanosFinados)
	{
		$this->numHermanosFinados = $numHermanosFinados;
	}

	public function setSeLeHacenMoretones($seLeHacenMoretones)
	{
		$this->seLeHacenMoretones = $seLeHacenMoretones;
	}

	public function setHaRequeridoTransfusion($haRequeridoTransfusion)
	{
		$this->haRequeridoTransfusion = $haRequeridoTransfusion;
	}

	public function setHaTenidoFracturas($haTenidoFracturas)
	{
		$this->haTenidoFracturas = $haTenidoFracturas;
	}

	public function setHaSidoIntervenido($haSidoIntervenido)
	{
		$this->haSidoIntervenido = $haSidoIntervenido;
	}

	public function setHaSidoHospitalizado($haSidoHospitalizado)
	{
		$this->haSidoHospitalizado = $haSidoHospitalizado;
	}

	public function setExAdicto($exAdicto)
	{
		$this->exAdicto = $exAdicto;
	}

	public function setEstaBajoTratamiento($estaBajoTratamiento)
	{
		$this->estaBajoTratamiento = $estaBajoTratamiento;
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

	public function setTelefono($telefono)
	{
		$this->telefono = $telefono;
	}

	public function setCelular($celular)
	{
		$this->celular = $celular;
	}

	public function setEmail($email)
	{
		$this->email = $email;
	}

	public function setDireccion($direccion)
	{
		$this->direccion = $direccion;
	}

	public function setCP($cp)
	{
		$this->cp = $cp;
	}

	public function setMunicipio($municipio)
	{
		$this->municipio = $municipio;
	}

	public function setLugarNacimiento($lugarNacimiento)
	{
		$this->lugarNacimiento = $lugarNacimiento;
	}

	public function setNombrePediatra($nombrePediatra)
	{
		$this->nombrePediatra = $nombrePediatra;
	}

	public function setNombreRecomienda($nombreRecomienda)
	{
		$this->nombreRecomienda = $nombreRecomienda;
	}

	public function setConQueSeHaAutomedicado($conQueSeHaAutomedicado)
	{
		$this->conQueSeHaAutomedicado = $conQueSeHaAutomedicado;
	}

	public function setAQueMedicamentoEsAlergico($aQueMedicamentoEsAlergico)
	{
		$this->aQueMedicamentoEsAlergico = $aQueMedicamentoEsAlergico;
	}

	public function setCausaMuerteMadre($causaMuerteMadre)
	{
		$this->causaMuerteMadre = $causaMuerteMadre;
	}

	public function setEnfermedadesMadre($enfermedadesMadre)
	{
		$this->enfermedadesMadre = $enfermedadesMadre;
	}

	public function setCausaMuertePadre($causaMuertePadre)
	{
		$this->causaMuertePadre = $causaMuertePadre;
	}

	public function setEnfermedadesPadre($enfermedadesPadre)
	{
		$this->enfermedadesPadre = $enfermedadesPadre;
	}

	public function setCausaMuerteHermanos($causaMuerteHermanos)
	{
		$this->causaMuerteHermanos = $causaMuerteHermanos;
	}

	public function setEnfermedadesHermanos($enfermedadesHermanos)
	{
		$this->enfermedadesHermanos = $enfermedadesHermanos;
	}

	public function setEnfermedadesAbuelosPaternos($enfermedadesAbuelosPaternos)
	{
		$this->enfermedadesAbuelosPaternos = $enfermedadesAbuelosPaternos;
	}

	public function setEnfermedadesAbuelosMaternos($enfermedadesAbuelosMaternos)
	{
		$this->enfermedadesAbuelosMaternos = $enfermedadesAbuelosMaternos;
	}

	public function setEspecifiqueFracturas($especifiqueFracturas)
	{
		$this->especifiqueFracturas = $especifiqueFracturas;
	}

	public function setEspecifiqueIntervencion($especifiqueIntervencion)
	{
		$this->especifiqueIntervencion = $especifiqueIntervencion;
	}

	public function setEspecifiqueHospitalizacion($especifiqueHospitalizacion)
	{
		$this->especifiqueHospitalizacion = $especifiqueHospitalizacion;
	}

	public function setEspecifiqueTratamiento($especifiqueTratamiento)
	{
		$this->especifiqueTratamiento = $especifiqueTratamiento;
	}

	public function setFechaNacimiento($fechaNacimiento)
	{
		$this->fechaNacimiento = $fechaNacimiento;
	}

	public function setEstadoCivil(EstadoCivil $estadoCivil)
	{
		$this->estadoCivil = $estadoCivil;
	}

	public function setReligion(Religion $religion)
	{
		$this->religion = $religion;
	}

	public function setEscolaridad(Escolaridad $escolaridad)
	{
		$this->escolaridad = $escolaridad;
	}

	public function setListaPadecimientos($listaPadecimientos)
	{
		$this->listaPadecimientos = $listaPadecimientos;
	}

	public function setFirma($firma)
	{
		$this->firma = $firma;
	}

	public function setNombreRepresentante($nombreRepresentante)
	{
		$this->nombreRepresentante = $nombreRepresentante;
	}

	public function setNombreTutor($nombreTutor)
	{
		$this->nombreTutor = $nombreTutor;
	}

	public function setOcupacionTutor($ocupacionTutor)
	{
		$this->ocupacionTutor = $ocupacionTutor;
	}

	public function setMotivoConsulta($motivoConsulta)
	{
		$this->motivoConsulta = $motivoConsulta;
	}

	public function setHistoriaEnfermedad($historiaEnfermedad)
	{
		$this->historiaEnfermedad = $historiaEnfermedad;
	}

	public function setInstitucionMedica(InstitucionMedica $institucionMedica)
	{
		$this->institucionMedica = $institucionMedica;
	}

	public function setPadecimientoActual($padecimientoActual)
	{
		$this->padecimientoActual = $padecimientoActual;
	}

	public function setInterrogatorioPorAparatos($interrogatorioPorAparatos)
	{
		$this->interrogatorioPorAparatos = $interrogatorioPorAparatos;
	}

	public function setPeso($peso)
	{
		$this->peso = $peso;
	}

	public function setTalla($talla)
	{
		$this->talla = $talla;
	}

	public function setPulso($pulso)
	{
		$this->pulso = $pulso;
	}

	public function setTemperatura($temperatura)
	{
		$this->temperatura = $temperatura;
	}

	public function setTensionArterial()
	{
		$this->tensionArterial = $tensionArterial;
	}

	public function setResultadosLaboratorio($resultadosLaboratorio)
	{
		$this->resultadosLaboratorio = $resultadosLaboratorio;
	}

	public function setTerapeuticaEmpleada($terapeuticaEmpleada)
	{
		$this->terapeuticaEmpleada = $terapeuticaEmpleada;
	}

	public function setSubsecuente($subsecuente)
	{
		$this->subsecuente = $subsecuente;
	}

	//////////////////////////////////////////////////////////////////////////////////////////////////
	//////////////////////////////////////////////////////////////////////////////////////////////////
	//OPERACIONES

	public function getNombreCompleto()
	{
		return $this->nombre.' '.$this->paterno.' '.$this->materno;
	}

	public function buscarPadecimiento($idPadecimiento)
	{
		//recorrer la lista de padecimientos y verificar si algun id es igual al enviado
		try
		{
			if($this->listaPadecimientos != null)
			{
				foreach ($this->listaPadecimientos as $padecimientos)
				{
					// echo $padecimientos->getId()." ".$idPadecimiento;
					if($padecimientos->getId() == $idPadecimiento)
					{
						return true;
					}
				}
			}
			else
				throw new Exception("Error Processing Request", 1);
		}
		catch(Exception $e)
		{
			return false;
		}
	}

	public function registrarFirma()
	{
		//registrar la firma en la bd
		$expedienteBD = new ExpedienteBD();
		return $expedienteBD->editarFirma($this);
	}
}