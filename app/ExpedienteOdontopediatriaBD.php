<?php
require_once 'BaseDatos.php';
require_once 'ExpedienteOdontopediatria.php';
require_once 'TrastornoLenguaje.php';
require_once 'MarcaPasta.php';
/**
 * 
 */
class ExpedienteOdontopediatriaBD
{	
	//string
	private $query;

	//cargar datos
	public function cargarDatos(ExpedienteOdontopediatria $expediente)
	{
		$this->query = "SELECT expediente.idExpediente , expediente.idEstadoCivil , expediente.idReligion , expediente.idEscolaridad , expediente.idInstitucionMedica , expediente.Nombre , expediente.Paterno , expediente.Materno , expediente.Telefono , expediente.Celular , expediente.Email , expediente.Direccion , expediente.CP , expediente.Municipio , expediente.FechaNacimiento , expediente.Edad , expediente.EdadMeses , expediente.LugarNacimiento , expediente.NombrePediatra , expediente.NombreQuienRecomienda , expediente.SeHaAutomedicado , expediente.ConQue , expediente.EsAlergico , expediente.ACual , expediente.EstaVivaMadre , expediente.CausaMuerteMadre , expediente.EnfermedadesPadeceMadre , expediente.EstaVivoPadre , expediente.CausaMuertePadre , expediente.EnfermedadesPadecePadre , expediente.NumHermanos , expediente.NumHermanosVivos , expediente.NumHermanosFinados , expediente.CausaMuerteHermanos , expediente.EnfermedadesPadecenHermanos , expediente.EnfermedadesAbuelosPaternos , expediente.EnfermedadesAbuelosMaternos , expediente.SeLeHacenMoretones , expediente.HaRequeridoTransfusion , expediente.HaTenidoFracturas , expediente.EspecifiqueFracturas , expediente.HaSidoIntervenido , expediente.EspecifiqueIntervencion , expediente.HaSidoHospitalizado , expediente.EspecifiqueHospitalizacion , expediente.EsExAdicto , expediente.EstaBajoTratamiento , expediente.EspecifiqueTratamiento , expediente.MotivoConsulta , expediente.HistoriaEnfermedad , expediente.PadecimientoActual , expediente.Subsecuente, expediente_odontopediatria.idExpediente , expediente_odontopediatria.idMarcaPasta , expediente_odontopediatria.idTrastornoLenguaje , expediente_odontopediatria.NombrePadre , expediente_odontopediatria.NombreMadre , expediente_odontopediatria.OcupacionPadre , expediente_odontopediatria.OcupacionMadre , expediente_odontopediatria.NombreEdadesHermanos , expediente_odontopediatria.HaPresentadoDolorBoca , expediente_odontopediatria.PresentaMalOlorBoca , expediente_odontopediatria.HaNotadoSangradoEncias , expediente_odontopediatria.PrimeraVisitaDentista , expediente_odontopediatria.SienteDienteFlojo , expediente_odontopediatria.FechaUltimoExamenBucal , expediente_odontopediatria.MotivoVisitaDentista , expediente_odontopediatria.LeHanColocadoAnestesico , expediente_odontopediatria.TuvoMalaReaccionAnestesico , expediente_odontopediatria.ReaccionAnestesico , expediente_odontopediatria.TraumatismoBucal , expediente_odontopediatria.TipoCepilloAdulto , expediente_odontopediatria.EdadErupcionoPrimerDiente , expediente_odontopediatria.VecesCepillaDiente , expediente_odontopediatria.AlguienAyudaACepillarse , expediente_odontopediatria.VecesComeDia , expediente_odontopediatria.HiloDental , expediente_odontopediatria.EnjuagueBucal , expediente_odontopediatria.LimpiadorLingual , expediente_odontopediatria.TabletasReveladoras , expediente_odontopediatria.OtroAuxiliar , expediente_odontopediatria.EspecifiqueAuxiliar , expediente_odontopediatria.SuccionDigital , expediente_odontopediatria.SuccionLingual , expediente_odontopediatria.Biberon , expediente_odontopediatria.Bruxismo , expediente_odontopediatria.SuccionLabial , expediente_odontopediatria.RespiracionBucal , expediente_odontopediatria.Onicofagia , expediente_odontopediatria.Chupon , expediente_odontopediatria.OtroHabito , expediente_odontopediatria.DescripcionHabito, marca_pasta.MarcaPasta, trastorno_lenguaje.TrastornoLenguaje
						FROM expediente_odontopediatria INNER JOIN expediente ON (expediente_odontopediatria.idExpediente = expediente.idExpediente) INNER JOIN marca_pasta ON marca_pasta.idMarcaPasta = expediente_odontopediatria.idMarcaPasta INNER JOIN trastorno_lenguaje ON trastorno_lenguaje.idTrastornoLenguaje = expediente_odontopediatria.idTrastornoLenguaje
						WHERE expediente.idExpediente = ?";
		
		$valores = $expediente->getId();
		$tiposDatos = "i";

		try
		{
			BaseDatos::conectar();
			$reader = BaseDatos::leer($this->query, $tiposDatos, $valores);
			if($reader != null)
			{
				$trastorno = new TrastornoLenguaje();
				$trastorno->setId($reader["idTrastornoLenguaje"]);
				$trastorno->setTrastornoLenguaje($reader["TrastornoLenguaje"]);
				
				$marcaPasta = new MarcaPasta();
				$marcaPasta->setId($reader["idMarcaPasta"]);
				$marcaPasta->setMarcaPasta($reader["MarcaPasta"]);
				
				$expediente->setNombre($reader["Nombre"]);
			    $expediente->setPaterno($reader["Paterno"]);
			    $expediente->setMaterno($reader["Materno"]);
			    $expediente->setFechaNacimiento($reader["FechaNacimiento"]);
			    $expediente->setEdadAnios($reader["Edad"]);
			    $expediente->setEdadMeses($reader["EdadMeses"]);
			    $expediente->setLugarNacimiento($reader["LugarNacimiento"]);
			    $expediente->setNombrePadre($reader["NombrePadre"]);
			    $expediente->setNombreMadre($reader["NombreMadre"]);
			    $expediente->setOcupacionPadre($reader["OcupacionPadre"]);
			    $expediente->setOcupacionMadre($reader["OcupacionMadre"]);
			    $expediente->setDireccion($reader["Direccion"]);
			    $expediente->setCP($reader["CP"]);
			    $expediente->setMunicipio($reader["Municipio"]);
			    $expediente->setTelefono($reader["Telefono"]);
			    $expediente->setCelular($reader["Celular"]);
			    $expediente->setEmail($reader["Email"]);
			    $expediente->setNombrePediatra($reader["NombrePediatra"]);
			    $expediente->setNombreRecomienda($reader["NombreQuienRecomienda"]);
			    $expediente->setMotivoConsulta($reader["MotivoConsulta"]);
				$expediente->setHistoriaEnfermedad($reader["HistoriaEnfermedad"]);
			    $expediente->setSeHaAutomedicado($reader["SeHaAutomedicado"]);
			    $expediente->setConQueSeHaAutomedicado($reader["ConQue"]);
			    $expediente->setEsAlergico($reader["EsAlergico"]);
			    $expediente->setAQueMedicamentoEsAlergico($reader["ACual"]);
			    $expediente->setViveMadre($reader["EstaVivaMadre"]);
			    $expediente->setCausaMuerteMadre($reader["CausaMuerteMadre"]);
			    $expediente->setEnfermedadesMadre($reader["EnfermedadesPadeceMadre"]);
			    $expediente->setVivePadre($reader["EstaVivoPadre"]);
			    $expediente->setCausaMuertePadre($reader["CausaMuertePadre"]);
			    $expediente->setEnfermedadesPadre($reader["EnfermedadesPadecePadre"]);
			    $expediente->setNumHermanos($reader["NumHermanos"]);
			    $expediente->setNumHermanosVivos($reader["NumHermanosVivos"]);
			    $expediente->setNumHermanosFinados($reader["NumHermanosFinados"]);
				$expediente->setNombreEdadesHermanos($reader["NombreEdadesHermanos"]);
			    $expediente->setEnfermedadesHermanos($reader["EnfermedadesPadecenHermanos"]);
			    $expediente->setEnfermedadesAbuelosPaternos($reader["EnfermedadesAbuelosPaternos"]);
			    $expediente->setEnfermedadesAbuelosMaternos($reader["EnfermedadesAbuelosMaternos"]);
			    $expediente->setSeLeHacenMoretones($reader["SeLeHacenMoretones"]);
			    $expediente->setHaRequeridoTransfusion($reader["HaRequeridoTransfusion"]);
			    $expediente->setHaTenidoFracturas($reader["HaTenidoFracturas"]);
			    $expediente->setEspecifiqueFracturas($reader["EspecifiqueFracturas"]);
			    $expediente->setHaSidoIntervenido($reader["HaSidoIntervenido"]);
			    $expediente->setEspecifiqueIntervencion($reader["EspecifiqueIntervencion"]);
			    $expediente->setHaSidoHospitalizado($reader["HaSidoHospitalizado"]);
			    $expediente->setEspecifiqueHospitalizacion($reader["EspecifiqueHospitalizacion"]);
			    $expediente->setExAdicto($reader["EsExAdicto"]);
			    $expediente->setEstaBajoTratamiento($reader["EstaBajoTratamiento"]);
			    $expediente->setEspecifiqueTratamiento($reader["EspecifiqueTratamiento"]);
				$expediente->setFechaUltimoExamenBucal($reader["FechaUltimoExamenBucal"]);
				$expediente->setMotivoVisitaDentista($reader["MotivoVisitaDentista"]);
				$expediente->setReaccionAnestesico($reader["ReaccionAnestesico"]);
				$expediente->setTraumatismoBucal($reader["TraumatismoBucal"]);
				$expediente->setTipoCepilloAdulto($reader["TipoCepilloAdulto"]);
				$expediente->setEdadErupcionoPrimerDiente($reader["EdadErupcionoPrimerDiente"]);
				$expediente->setVecesCepillaDiente($reader["VecesCepillaDiente"]);
				$expediente->setAlguienAyudaACepillarse($reader["AlguienAyudaACepillarse"]);
				$expediente->setVecesComeDia($reader["VecesComeDia"]);
				$expediente->setHiloDental($reader["HiloDental"]);
				$expediente->setEnjuagueBucal($reader["EnjuagueBucal"]);
				$expediente->setLimpiadorLingual($reader["LimpiadorLingual"]);
				$expediente->setTabletasReveladoras($reader["TabletasReveladoras"]);
				$expediente->setOtroAuxiliar($reader["OtroAuxiliar"]);
				$expediente->setEspecifiqueAuxiliar($reader["EspecifiqueAuxiliar"]);
				$expediente->setSuccionDigital($reader["SuccionDigital"]);
				$expediente->setSuccionLingual($reader["SuccionLingual"]);
				$expediente->setBiberon($reader["Biberon"]);
				$expediente->setBruxismo($reader["Bruxismo"]);
				$expediente->setSuccionLabial($reader["SuccionLabial"]);
				$expediente->setRespiracionBucal($reader["RespiracionBucal"]);
				$expediente->setOnicofagia($reader["Onicofagia"]);
				$expediente->setChupon($reader["Chupon"]);
				$expediente->setOtroHabito($reader["OtroHabito"]);
				$expediente->setDescripcionHabito($reader["DescripcionHabito"]);
				$expediente->setSubsecuente($reader["Subsecuente"]);
				$expediente->setTrastornoLenguaje($trastorno);
				$expediente->setMarcaPasta($marcaPasta);

			    BaseDatos::liberarResultado();
			    BaseDatos::desconectar();

			    $this->cargarListaPadecimientos($expediente);
			    return true;
			}
		}
		catch(Exception $e)
		{
			echo $e->getMessage();
			mail("gerardo.gomr@gmail.com", "Error en el sistema SIACM", "Error: ".$e->getMessage());
			return false;
		}	
	}

	public function cargarListaPadecimientos(ExpedienteOdontopediatria $expediente)
	{
		$this->query = "SELECT padecimiento.idPadecimiento , padecimiento.Padecimiento
						FROM expediente_padecimiento INNER JOIN padecimiento ON (expediente_padecimiento.idPadecimiento = padecimiento.idPadecimiento)
						WHERE expediente_padecimiento.idExpediente = ?";
		
		$valores = $expediente->getId();
		$tiposDatos = "i";
		$listaPadecimientos = array();

		try
		{
			BaseDatos::conectar();
			$reader = BaseDatos::leer($this->query, $tiposDatos, $valores);
			if($reader != null)
			{
				do
				{
					//crear nuevo padecimiento y asignar al array
					$padecimiento = new Padecimiento();
					$padecimiento->setId($reader["idPadecimiento"]);
					$padecimiento->setPadecimiento($reader["Padecimiento"]);

					$listaPadecimientos[] = $padecimiento;
				}while($reader = BaseDatos::siguienteRegistro());

				$expediente->setListaPadecimientos($listaPadecimientos);

			    BaseDatos::liberarResultado();
			    BaseDatos::desconectar();
			    return true;
			}
		}
		catch(Exception $e)
		{
			echo $e->getMessage();
			mail("gerardo.gomr@gmail.com", "Error en el sistema SIACM", "Error: ".$e->getMessage());
			return false;
		}	
	}
	
	//insertar un expediente con datos básicos / modulo citas
	public function guardarDatos(ExpedienteOdontopediatria $expediente)
	{
		//insertando en la tabla de expediente, colocando la id institucion como 1 por default para evitar el constraint
		$this->query = "INSERT INTO expediente (idEstadoCivil,  idReligion,  idEscolaridad, idInstitucionMedica, FechaCreacion,  Nombre,  Paterno,  Materno,  Telefono,  Celular,  Email,  Direccion,  CP,  Municipio,  FechaNacimiento,  Edad,  EdadMeses,  LugarNacimiento,  NombrePediatra,  NombreQuienRecomienda, MotivoConsulta, HistoriaEnfermedad, SeHaAutomedicado,  ConQue,  EsAlergico,  ACual,  EstaVivaMadre,  CausaMuerteMadre,  EnfermedadesPadeceMadre,  EstaVivoPadre,  CausaMuertePadre,  EnfermedadesPadecePadre,  NumHermanos,  NumHermanosVivos,  NumHermanosFinados,  CausaMuerteHermanos,  EnfermedadesPadecenHermanos,  EnfermedadesAbuelosPaternos,  EnfermedadesAbuelosMaternos, SeLeHacenMoretones, HaRequeridoTransfusion, HaTenidoFracturas, EspecifiqueFracturas, HaSidoIntervenido, EspecifiqueIntervencion, HaSidoHospitalizado, EspecifiqueHospitalizacion, EsExAdicto, EstaBajoTratamiento, EspecifiqueTratamiento, FechaActualizacion, Subsecuente)
						VALUES (1, 1, 1, 1, NOW(), ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, NOW(), 0)";

		try
		{
			BaseDatos::conectar();
			$valores = $expediente->getNombre()."::".
						$expediente->getPaterno()."::".
						$expediente->getMaterno()."::".
						$expediente->getTelefono()."::".
						$expediente->getCelular()."::".
						$expediente->getEmail()."::".
						$expediente->getDireccion()."::".
						$expediente->getCP()."::".
						$expediente->getMunicipio()."::".
						$expediente->getFechaNacimiento()."::".
						$expediente->getEdadAnios()."::".
						$expediente->getEdadMeses()."::".
						$expediente->getLugarNacimiento()."::".
						$expediente->getNombrePediatra()."::".
						$expediente->getNombreRecomienda()."::".
						$expediente->getMotivoConsulta()."::".
						$expediente->getHistoriaEnfermedad()."::".
						$expediente->getSeHaAutomedicado()."::".
						$expediente->getConQueSeHaAutomedicado()."::".
						$expediente->getEsAlergico()."::".
						$expediente->getAQueMedicamentoEsAlergico()."::".
						$expediente->getViveMadre()."::".
						$expediente->getCausaMuerteMadre()."::".
						$expediente->getEnfermedadesMadre()."::".
						$expediente->getVivePadre()."::".
						$expediente->getCausaMuertePadre()."::".
						$expediente->getEnfermedadesPadre()."::".
						$expediente->getNumHermanos()."::".
						$expediente->getNumHermanosVivos()."::".
						$expediente->getNumHermanosFinados()."::".
						$expediente->getCausaMuerteHermanos()."::".
						$expediente->getEnfermedadesHermanos()."::".
						$expediente->getEnfermedadesAbuelosPaternos()."::".
						$expediente->getEnfermedadesAbuelosMaternos()."::".
						$expediente->getSeLeHacenMoretones()."::".
						$expediente->getHaRequeridoTransfusion()."::".
						$expediente->getHaTenidoFracturas()."::".
						$expediente->getEspecifiqueFracturas()."::".
						$expediente->getHaSidoIntervenido()."::".
						$expediente->getEspecifiqueIntervencion()."::".
						$expediente->getHaSidoHospitalizado()."::".
						$expediente->getEspecifiqueHospitalizacion()."::".
						$expediente->getExAdicto()."::".
						$expediente->getEstaBajoTratamiento()."::".
						$expediente->getEspecifiqueTratamiento();

			$tiposDatos = "ssssssssssiisssssisisississiiissssiiisisisiis";

			BaseDatos::insertar($this->query, $tiposDatos, $valores);
			//asignar id a expediente
			$expediente->setId(BaseDatos::getIdInsertado());
			BaseDatos::desconectar();
			//guardar en tabla auxilia
			if(!$this->guardarDatosOdontopediatria($expediente))
			{
				throw new Exception("Error guardando el expediente");	
			}
			//guardar padecimientos
			if($expediente->getListaPadecimientos() != null)
			{
				if(!$this->guardarPadecimientos($expediente))
				{
					throw new Exception("Error guardando padecimientos");	
				}
			}
			
			return true;
		}
		catch(Exception $e)
		{
			echo $e->getMessage();
			mail("gerardo.gomr@gmail.com", "Error en el sistema SIACM", "Error: ".$e->getMessage());
			return false;
		}
	}

	//insertar en expediente odontopediatria, tipo private
	private function guardarDatosOdontopediatria(ExpedienteOdontopediatria $expediente)
	{
		$this->query = "INSERT INTO expediente_odontopediatria (idExpediente, idMarcaPasta, idComportamientoInicial, idComportamientoFrankl, idTrastornoLenguaje, idMorfologiaCraneofacial, idMorfologiaFacial, idConvexividadFacial, idATM, NombrePadre,  NombreMadre,  OcupacionPadre,  OcupacionMadre, NombreEdadesHermanos, HaPresentadoDolorBoca, PresentaMalOlorBoca, HaNotadoSangradoEncias, SienteDienteFlojo, PrimeraVisitaDentista, FechaUltimoExamenBucal, MotivoVisitaDentista, LeHanColocadoAnestesico, TuvoMalaReaccionAnestesico, ReaccionAnestesico, TraumatismoBucal, TipoCepilloAdulto, EdadErupcionoPrimerDiente, VecesCepillaDiente, AlguienAyudaACepillarse, VecesComeDia, HiloDental, EnjuagueBucal, LimpiadorLingual, TabletasReveladoras, OtroAuxiliar, EspecifiqueAuxiliar, SuccionDigital, SuccionLingual, Biberon, Bruxismo, SuccionLabial, RespiracionBucal, Onicofagia, Chupon, OtroHabito, DescripcionHabito, FechaActualizacion)
						VALUES (?, ?, 1, 1, ?, 1, 1, 1, 1, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, NOW())"; //echo $this->query;exit;

		try
		{
			BaseDatos::conectar();
			$valores = $expediente->getId()."::".
						$expediente->getMarcaPasta()->getId()."::".
						$expediente->getTrastornoLenguaje()->getId()."::".
						$expediente->getNombrePadre()."::".
						$expediente->getNombreMadre()."::".
						$expediente->getOcupacionPadre()."::".
						$expediente->getOcupacionMadre()."::".
						$expediente->getNombreEdadesHermanos()."::".
						$expediente->getHaPresentadoDolorBoca()."::".
						$expediente->getPresentaMalOlorBoca()."::".
						$expediente->getHaNotadoSangradoEncias()."::".
						$expediente->getSienteDienteFlojo()."::".
						$expediente->getPrimeraVisitaDentista()."::".
						$expediente->getFechaUltimoExamenBucal()."::".
						$expediente->getMotivoVisitaDentista()."::".
						$expediente->getLeHanColocadoAnestesico()."::".
						$expediente->getTuvoMalaReaccionAnestesico()."::".
						$expediente->getReaccionAnestesico()."::".
						$expediente->getTraumatismoBucal()."::".
						$expediente->getTipoCepilloAdulto()."::".
						$expediente->getEdadErupcionoPrimerDiente()."::".
						$expediente->getVecesCepillaDiente()."::".
						$expediente->getAlguienAyudaACepillarse()."::".
						$expediente->getVecesComeDia()."::".
						$expediente->getHiloDental()."::".
						$expediente->getEnjuagueBucal()."::".
						$expediente->getLimpiadorLingual()."::".
						$expediente->getTabletasReveladoras()."::".
						$expediente->getOtroAuxiliar()."::".
						$expediente->getEspecifiqueAuxiliar()."::".
						$expediente->getSuccionDigital()."::".
						$expediente->getSuccionLingual()."::".
						$expediente->getBiberon()."::".
						$expediente->getBruxismo()."::".
						$expediente->getSuccionLabial()."::".
						$expediente->getRespiracionBucal()."::".
						$expediente->getOnicofagia()."::".
						$expediente->getChupon()."::".
						$expediente->getOtroHabito()."::".
						$expediente->getDescripcionHabito();

			$tiposDatos = "iiisssssiiiiissiissiiiiiiiiiisiiiiiiiiis";
			
			$reader = BaseDatos::insertar($this->query, $tiposDatos, $valores);

			BaseDatos::desconectar();
			return true;
		}
		catch(Exception $e)
		{
			mail("gerardo.gomr@gmail.com", "Error en el sistema SIACM", "Error: ".$e->getMessage());
			return false;
		}
	}

	//insertar en expediente padecimientos, tipo private
	private function guardarPadecimientos(ExpedienteOdontopediatria $expediente)
	{
		try
		{
			foreach ($expediente->getListaPadecimientos() as $padecimientos) 
			{
				$this->query = "INSERT INTO expediente_padecimiento (idExpediente, idPadecimiento, FechaActualizacion)
								VALUES (?, ?, NOW())";
				BaseDatos::conectar();
				$valores = $expediente->getId()."::".
							$padecimientos->getId();
				$tiposDatos = "ii";
				$reader = BaseDatos::insertar($this->query, $tiposDatos, $valores);

				BaseDatos::desconectar();
			}
			
			return true;
		}
		catch(Exception $e)
		{
			mail("gerardo.gomr@gmail.com", "Error en el sistema SIACM", "Error: ".$e->getMessage());
			return false;
		}
	}

	//update a expediente
	public function editarDatos(ExpedienteOdontopediatria $expediente)
	{
		$this->query = "UPDATE expediente 
						SET idEstadoCivil = 1,  idReligion = 1,  idEscolaridad = 1,  Nombre = ?,  Paterno = ?,  Materno = ?,  Telefono = ?,  Celular = ?,  Email = ?,  Direccion = ?,  CP = ?,  Municipio = ?,  FechaNacimiento = ?,  Edad = ?,  EdadMeses = ?,  LugarNacimiento = ?,  NombrePediatra = ?,   NombreQuienRecomienda = ?, SeHaAutomedicado = ?,  ConQue = ?,  EsAlergico = ?,  ACual = ?,  EstaVivaMadre = ?,  CausaMuerteMadre = ?,  EnfermedadesPadeceMadre = ?,  EstaVivoPadre = ?,  CausaMuertePadre = ?,  EnfermedadesPadecePadre = ?,  NumHermanos = ?,  NumHermanosVivos = ?,  NumHermanosFinados = ?,  CausaMuerteHermanos = ?,  EnfermedadesPadecenHermanos = ?,  EnfermedadesAbuelosPaternos = ?,  EnfermedadesAbuelosMaternos = ?, SeLeHacenMoretones = ?, HaRequeridoTransfusion = ?, HaTenidoFracturas = ?, EspecifiqueFracturas = ?, HaSidoIntervenido = ?, EspecifiqueIntervencion = ?, HaSidoHospitalizado = ?, EspecifiqueHospitalizacion = ?, EsExAdicto = ?, EstaBajoTratamiento = ?, EspecifiqueTratamiento = ?, FechaActualizacion = NOW()
						WHERE idExpediente = ?";

		try
		{
			BaseDatos::conectar();
			$valores = $expediente->getNombre()."::".
						$expediente->getPaterno()."::".
						$expediente->getMaterno()."::".
						$expediente->getTelefono()."::".
						$expediente->getCelular()."::".
						$expediente->getEmail()."::".
						$expediente->getDireccion()."::".
						$expediente->getCP()."::".
						$expediente->getMunicipio()."::".
						$expediente->getFechaNacimiento()."::".
						$expediente->getEdadAnios()."::".
						$expediente->getEdadMeses()."::".
						$expediente->getLugarNacimiento()."::".
						$expediente->getNombrePediatra()."::".
						$expediente->getNombreRecomienda()."::".
						$expediente->getSeHaAutomedicado()."::".
						$expediente->getConQueSeHaAutomedicado()."::".
						$expediente->getEsAlergico()."::".
						$expediente->getAQueMedicamentoEsAlergico()."::".
						$expediente->getViveMadre()."::".
						$expediente->getCausaMuerteMadre()."::".
						$expediente->getEnfermedadesMadre()."::".
						$expediente->getVivePadre()."::".
						$expediente->getCausaMuertePadre()."::".
						$expediente->getEnfermedadesPadre()."::".
						$expediente->getNumHermanos()."::".
						$expediente->getNumHermanosVivos()."::".
						$expediente->getNumHermanosFinados()."::".
						$expediente->getCausaMuerteHermanos()."::".
						$expediente->getEnfermedadesHermanos()."::".
						$expediente->getEnfermedadesAbuelosPaternos()."::".
						$expediente->getEnfermedadesAbuelosMaternos()."::".
						$expediente->getSeLeHacenMoretones()."::".
						$expediente->getHaRequeridoTransfusion()."::".
						$expediente->getHaTenidoFracturas()."::".
						$expediente->getEspecifiqueFracturas()."::".
						$expediente->getHaSidoIntervenido()."::".
						$expediente->getEspecifiqueIntervencion()."::".
						$expediente->getHaSidoHospitalizado()."::".
						$expediente->getEspecifiqueHospitalizacion()."::".
						$expediente->getExAdicto()."::".
						$expediente->getEstaBajoTratamiento()."::".
						$expediente->getEspecifiqueTratamiento()."::".
						$expediente->getId();

			$tiposDatos = "ssssssssssiisssisisississiiissssiiisisisiisi";
			BaseDatos::insertar($this->query, $tiposDatos, $valores);
			//asignar id a expediente
			BaseDatos::desconectar();
			//guardar en tabla auxilia
			if(!$this->editarDatosOdontopediatria($expediente))
			{
				throw new Exception("Error actualizando datos odonto");
			}
			//guardar padecimientos
			if($expediente->getListaPadecimientos() != null)
				$this->editarPadecimientos($expediente);
			return true;
		}
		catch(Exception $e)
		{
			echo $e->getMessage();
			mail("gerardo.gomr@gmail.com", "Error en el sistema SIACM", "Error: ".$e->getMessage());
			return false;
		}		
	}

	//editar expedientes odonto, private
	private function editarDatosOdontopediatria(ExpedienteOdontopediatria $expediente)
	{
		$this->query = "UPDATE expediente_odontopediatria 
						SET idMarcaPasta = ? , idTrastornoLenguaje = ?, NombrePadre = ?,  NombreMadre = ?,  OcupacionPadre = ?,  OcupacionMadre = ?, NombreEdadesHermanos = ?, HaPresentadoDolorBoca = ?, PresentaMalOlorBoca = ?, HaNotadoSangradoEncias = ?, SienteDienteFlojo = ?, PrimeraVisitaDentista = ?, FechaUltimoExamenBucal = ?, MotivoVisitaDentista = ?, LeHanColocadoAnestesico = ?, TuvoMalaReaccionAnestesico = ?, ReaccionAnestesico = ?, TraumatismoBucal = ?, TipoCepilloAdulto = ?, EdadErupcionoPrimerDiente = ?, VecesCepillaDiente = ?, AlguienAyudaACepillarse = ?, VecesComeDia = ?, HiloDental = ?, EnjuagueBucal = ?, LimpiadorLingual = ?, TabletasReveladoras = ?, OtroAuxiliar = ?, EspecifiqueAuxiliar = ?, SuccionDigital = ?, SuccionLingual = ?, Biberon = ?, Bruxismo = ?, SuccionLabial = ?, RespiracionBucal = ?, Onicofagia = ?, Chupon = ?, OtroHabito = ?, DescripcionHabito = ?, FechaActualizacion = NOW()
						WHERE idExpediente = ?";

		try
		{
			BaseDatos::conectar();
			$valores = $expediente->getMarcaPasta()->getId()."::".
						$expediente->getTrastornoLenguaje()->getId()."::".
						$expediente->getNombrePadre()."::".
						$expediente->getNombreMadre()."::".
						$expediente->getOcupacionPadre()."::".
						$expediente->getOcupacionMadre()."::".
						$expediente->getNombreEdadesHermanos()."::".
						$expediente->getHaPresentadoDolorBoca()."::".
						$expediente->getPresentaMalOlorBoca()."::".
						$expediente->getHaNotadoSangradoEncias()."::".
						$expediente->getSienteDienteFlojo()."::".
						$expediente->getPrimeraVisitaDentista()."::".
						$expediente->getFechaUltimoExamenBucal()."::".
						$expediente->getMotivoVisitaDentista()."::".
						$expediente->getLeHanColocadoAnestesico()."::".
						$expediente->getTuvoMalaReaccionAnestesico()."::".
						$expediente->getReaccionAnestesico()."::".
						$expediente->getTraumatismoBucal()."::".
						$expediente->getTipoCepilloAdulto()."::".
						$expediente->getEdadErupcionoPrimerDiente()."::".
						$expediente->getVecesCepillaDiente()."::".
						$expediente->getAlguienAyudaACepillarse()."::".
						$expediente->getVecesComeDia()."::".
						$expediente->getHiloDental()."::".
						$expediente->getEnjuagueBucal()."::".
						$expediente->getLimpiadorLingual()."::".
						$expediente->getTabletasReveladoras()."::".
						$expediente->getOtroAuxiliar()."::".
						$expediente->getEspecifiqueAuxiliar()."::".
						$expediente->getSuccionDigital()."::".
						$expediente->getSuccionLingual()."::".
						$expediente->getBiberon()."::".
						$expediente->getBruxismo()."::".
						$expediente->getSuccionLabial()."::".
						$expediente->getRespiracionBucal()."::".
						$expediente->getOnicofagia()."::".
						$expediente->getChupon()."::".
						$expediente->getOtroHabito()."::".
						$expediente->getDescripcionHabito()."::".
						$expediente->getId();
			$tiposDatos = "iisssssiiiiissiissiiiiiiiiiisiiiiiiiiisi";
			
			$reader = BaseDatos::insertar($this->query, $tiposDatos, $valores);
			
			BaseDatos::desconectar();
			return true;
		}
		catch(Exception $e)
		{
			echo $e->getMessage();
			mail("gerardo.gomr@gmail.com", "Error en el sistema SIACM", "Error: ".$e->getMessage());
			return false;
		}
	}

	//editar padecimientos
	private function editarPadecimientos(ExpedienteOdontopediatria $expediente)
	{
		try
		{
			//BORRAR PRIMERO
			$this->query = "DELETE FROM expediente_padecimiento 
							WHERE idExpediente = ?";

			$valores = $expediente->getId();
			$tiposDatos = "i";

			BaseDatos::conectar();
			$reader = BaseDatos::insertar($this->query, $tiposDatos, $valores);
			BaseDatos::desconectar();

			//INSERTAR DESPUÉS
			foreach ($expediente->getListaPadecimientos() as $padecimientos) 
			{
				$this->query = "INSERT INTO expediente_padecimiento (idExpediente, idPadecimiento, FechaActualizacion)
								VALUES (?, ?, NOW())";
				BaseDatos::conectar();
				$valores = $expediente->getId()."::".
							$padecimientos->getId();
				$tiposDatos = "ii";
				$reader = BaseDatos::insertar($this->query, $tiposDatos, $valores);

				BaseDatos::desconectar();
			}
			
			return true;
		}
		catch(Exception $e)
		{
			mail("gerardo.gomr@gmail.com", "Error en el sistema SIACM", "Error: ".$e->getMessage());
			return false;
		}
	}
}