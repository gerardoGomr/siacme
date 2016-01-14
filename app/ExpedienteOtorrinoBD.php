<?php
require_once 'BaseDatos.php';
require_once 'ExpedienteOtorrino.php';
/**
 * 
 */
class ExpedienteOtorrinoBD
{	
	//string
	private $query;

	//cargar datos
	public function cargarDatos(ExpedienteOtorrino $expediente)
	{
		$this->query = "SELECT expediente.idExpediente , expediente.idEstadoCivil , expediente.idReligion , expediente.idEscolaridad , expediente.Nombre , expediente.Paterno , expediente.Materno , expediente.Telefono , expediente.Celular , expediente.Email , expediente.Direccion , expediente.CP , expediente.Municipio , expediente.FechaNacimiento , expediente.Edad , expediente.EdadMeses , expediente.LugarNacimiento , expediente.NombrePediatra , expediente.NombreQuienRecomienda , expediente.SeHaAutomedicado , expediente.ConQue , expediente.EsAlergico , expediente.ACual , expediente.EstaVivaMadre , expediente.CausaMuerteMadre , expediente.EnfermedadesPadeceMadre , expediente.EstaVivoPadre , expediente.CausaMuertePadre, expediente.EnfermedadesPadecePadre , expediente.NumHermanos , expediente.NumHermanosVivos , expediente.NumHermanosFinados , expediente.CausaMuerteHermanos , expediente.EnfermedadesPadecenHermanos , expediente.EnfermedadesAbuelosPaternos , expediente.EnfermedadesAbuelosMaternos , expediente.SeLeHacenMoretones, expediente.HaRequeridoTransfusion, expediente.HaTenidoFracturas, expediente.EspecifiqueFracturas, expediente.HaSidoIntervenido, expediente.EspecifiqueIntervencion,  expediente.HaSidoHospitalizado, expediente.EspecifiqueHospitalizacion, expediente.EsExAdicto, expediente.EstaBajoTratamiento, expediente.EspecifiqueTratamiento, expediente.NombreRepresentante, expediente.NombreTutor, expediente.OcupacionTutor, expediente.InstitucionMedica, estado_civil.EstadoCivil,  religion.Religion, escolaridad.Escolaridad
						FROM expediente_otorrino LEFT JOIN expediente ON (expediente_otorrino.idExpediente = expediente.idExpediente) INNER JOIN estado_civil ON estado_civil.idEstadoCivil = expediente.idEstadoCivil INNER JOIN religion ON religion.idReligion = expediente.idReligion INNER JOIN escolaridad ON escolaridad.idEscolaridad = expediente.idEscolaridad
						WHERE expediente.idExpediente = ?";
		
		$valores = $expediente->getId();
		$tiposDatos = "i";

		try
		{
			BaseDatos::conectar();
			$reader = BaseDatos::leer($this->query, $tiposDatos, $valores);
			if($reader != null)
			{
				$estadoCivil = new EstadoCivil();
				$estadoCivil->setId($reader["idEstadoCivil"]);
				$estadoCivil->setEstadoCivil($reader["EstadoCivil"]);

				$religion = new Religion();
				$religion->setId($reader["idReligion"]);
				$religion->setReligion($reader["Religion"]);

				$escolaridad = new Escolaridad();
				$escolaridad->setId($reader["idEscolaridad"]);
				$escolaridad->setEscolaridad($reader["Escolaridad"]);

				$expediente->setEstadoCivil($estadoCivil);
				$expediente->setReligion($religion);
				$expediente->setEscolaridad($escolaridad);

				$expediente->setNombre($reader["Nombre"]);
			    $expediente->setPaterno($reader["Paterno"]);
			    $expediente->setMaterno($reader["Materno"]);
			    $expediente->setFechaNacimiento($reader["FechaNacimiento"]);
			    $expediente->setEdadAnios($reader["Edad"]);
			    $expediente->setEdadMeses($reader["EdadMeses"]);
			    $expediente->setLugarNacimiento($reader["LugarNacimiento"]);
			    $expediente->setDireccion($reader["Direccion"]);
			    $expediente->setCP($reader["CP"]);
			    $expediente->setMunicipio($reader["Municipio"]);
			    $expediente->setTelefono($reader["Telefono"]);
			    $expediente->setCelular($reader["Celular"]);
			    $expediente->setEmail($reader["Email"]);
			    $expediente->setNombrePediatra($reader["NombrePediatra"]);
			    $expediente->setNombreRecomienda($reader["NombreQuienRecomienda"]);
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
			   	$expediente->setNombreRepresentante($reader["NombreRepresentante"]);
			   	$expediente->setNombreTutor($reader["NombreTutor"]);
			   	$expediente->setOcupacionTutor($reader["OcupacionTutor"]);
			   	$expediente->setInstitucionMedica($reader["InstitucionMedica"]); 

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

	public function cargarListaPadecimientos(ExpedienteOtorrino $expediente)
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
	
	//insertar un expediente
	public function guardarDatos(ExpedienteOtorrino $expediente)
	{
		$this->query = "INSERT INTO expediente (idEstadoCivil,  idReligion,  idEscolaridad,  FechaCreacion,  Nombre,  Paterno,  Materno,  Telefono,  Celular,  Email,  Direccion,  CP,  Municipio,  FechaNacimiento,  Edad,  EdadMeses,  LugarNacimiento,  NombrePediatra,  NombreQuienRecomienda, SeHaAutomedicado,  ConQue,  EsAlergico,  ACual,  EstaVivaMadre,  CausaMuerteMadre,  EnfermedadesPadeceMadre,  EstaVivoPadre,  CausaMuertePadre,  EnfermedadesPadecePadre,  NumHermanos,  NumHermanosVivos,  NumHermanosFinados,  CausaMuerteHermanos,  EnfermedadesPadecenHermanos,  EnfermedadesAbuelosPaternos,  EnfermedadesAbuelosMaternos, SeLeHacenMoretones, HaRequeridoTransfusion, HaTenidoFracturas, EspecifiqueFracturas, HaSidoIntervenido, EspecifiqueIntervencion, HaSidoHospitalizado, EspecifiqueHospitalizacion, EsExAdicto, EstaBajoTratamiento, EspecifiqueTratamiento, NombreRepresentante, NombreTutor, OcupacionTutor, InstitucionMedica, FechaActualizacion)
						VALUES (?, ?, ?, NOW(), ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, NOW())";

		try
		{
			BaseDatos::conectar();
			$valores = $expediente->getEstadoCivil()->getId()."::".
						$expediente->getReligion()->getId()."::".
						$expediente->getEscolaridad()->getId()."::".
						$expediente->getNombre()."::".
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
						$expediente->getNombreRepresentante()."::".
						$expediente->getNombreTutor()."::".
						$expediente->getOcupacionTutor()."::".
						$expediente->getInstitucionMedica();

			$tiposDatos = "iiissssssssssiisssisisississiiissssiiisisisiisssss";

			BaseDatos::insertar($this->query, $tiposDatos, $valores);
			//asignar id a expediente
			$expediente->setId(BaseDatos::getIdInsertado());
			BaseDatos::desconectar();
			//guardar en tabla auxilia
			$this->guardarDatosOtorrino($expediente);
			//guardar padecimientos
			if($expediente->getListaPadecimientos() != null)
				$this->guardarPadecimientos($expediente);
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
	private function guardarDatosOtorrino(ExpedienteOtorrino $expediente)
	{
		$this->query = "INSERT INTO expediente_otorrino (idExpediente, FechaActualizacion)
						VALUES (?, NOW())";

		try
		{
			BaseDatos::conectar();
			$valores = $expediente->getId();
			$tiposDatos = "i";
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
	private function guardarPadecimientos(ExpedienteOtorrino $expediente)
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
	public function editarDatos(ExpedienteOtorrino $expediente)
	{
		$this->query = "UPDATE expediente 
						SET idEstadoCivil = ?,  idReligion = ?,  idEscolaridad = ?,  Nombre = ?,  Paterno = ?,  Materno = ?,  Telefono = ?,  Celular = ?,  Email = ?,  Direccion = ?,  CP = ?,  Municipio = ?,  FechaNacimiento = ?,  Edad = ?,  EdadMeses = ?,  LugarNacimiento = ?,  NombrePediatra = ?,   NombreQuienRecomienda = ?, SeHaAutomedicado = ?,  ConQue = ?,  EsAlergico = ?,  ACual = ?,  EstaVivaMadre = ?,  CausaMuerteMadre = ?,  EnfermedadesPadeceMadre = ?,  EstaVivoPadre = ?,  CausaMuertePadre = ?,  EnfermedadesPadecePadre = ?,  NumHermanos = ?,  NumHermanosVivos = ?,  NumHermanosFinados = ?,  CausaMuerteHermanos = ?,  EnfermedadesPadecenHermanos = ?,  EnfermedadesAbuelosPaternos = ?,  EnfermedadesAbuelosMaternos = ?, SeLeHacenMoretones = ?, HaRequeridoTransfusion = ?, HaTenidoFracturas = ?, EspecifiqueFracturas = ?, HaSidoIntervenido = ?, EspecifiqueIntervencion = ?, HaSidoHospitalizado = ?, EspecifiqueHospitalizacion = ?, EsExAdicto = ?, EstaBajoTratamiento = ?, EspecifiqueTratamiento = ?, NombreRepresentante = ?, NombreTutor = ?, OcupacionTutor = ?, InstitucionMedica = ?, FechaActualizacion = NOW()
						WHERE idExpediente = ?";

		try
		{
			BaseDatos::conectar();
			$valores = $expediente->getEstadoCivil()->getId()."::".
						$expediente->getReligion()->getId()."::".
						$expediente->getEscolaridad()->getId()."::".
						$expediente->getNombre()."::".
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
						$expediente->getNombreRepresentante()."::".
						$expediente->getNombreTutor()."::".
						$expediente->getOcupacionTutor()."::".
						$expediente->getInstitucionMedica()."::".
						$expediente->getId();

			$tiposDatos = "iiissssssssssiisssisisississiiissssiiisisisiisssssi";

			BaseDatos::insertar($this->query, $tiposDatos, $valores);

			//asignar id a expediente
			BaseDatos::desconectar();
			//guardar en tabla auxilia
			$this->editarDatosOtorrino($expediente);
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
	private function editarDatosOtorrino(ExpedienteOtorrino $expediente)
	{
		$this->query = "UPDATE expediente_otorrino
						SET FechaActualizacion = NOW()
						WHERE idExpediente = ?";

		try
		{
			BaseDatos::conectar();
			$valores = $expediente->getId();
			$tiposDatos = "i";
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

	//editar padecimientos
	private function editarPadecimientos(ExpedienteOtorrino $expediente)
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