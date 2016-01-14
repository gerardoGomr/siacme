<?php
namespace Siacme\Expedientes;

use DB;
use Siacme\Pacientes\Paciente;

/**
 * @author Gerardo Adrián Gómez Ruiz
 * @version 1.0
 */
class ExpedientesOdontopediatriaRepositorioMySQL extends ExpedientesRepositorioMySQL
{
	/**
	 * buscar expedientes coincidentes
	 * @param  string $nombreBusqueda el nombre
	 * @return lista Expedientes
	 */
	public function buscarExpedientesPorNombre($nombreBusqueda = '')
	{
		$listaExpedientes = null;
		try {
			$expedienteBD = DB::table('expediente')
								->select('idExpediente', 'Nombre', 'Paterno', 'Materno', 'Telefono', 'Celular', 'Email', 'Direccion')
								->whereNotNull('idExpediente');

			// quitar espacis en blanco
			$nombreBusqueda = str_replace(' ', '', $nombreBusqueda);

			//verificar cuales son los parametros enviados
			if(strlen($nombreBusqueda)) {
				$expedienteBD->where(DB::raw("REPLACE(CONCAT(Nombre, Paterno, Materno), ' ', '')"), 'LIKE', "%$nombreBusqueda%");
			}

			// var_dump($expedienteBD->get());exit;
			$expedientes      = $expedienteBD->get();
			$totalExpedientes = count($expedientes);

			if($totalExpedientes > 0)
			{
				$listaExpedientes = array();

				foreach ($expedientes as $expedientes) {

					$expediente = new ExpedienteOdontopediatria();
					$expediente->setId($expedientes->idExpediente);
					$expediente->setNombre($expedientes->Nombre);
					$expediente->setPaterno($expedientes->Paterno);
					$expediente->setMaterno($expedientes->Materno);
					$expediente->setTelefono($expedientes->Telefono);
					$expediente->setCelular($expedientes->Celular);
					$expediente->setEmail($expedientes->Email);
					$expediente->setDireccion($expedientes->Direccion);

					$listaExpedientes[] = $expediente;

				}

				return $listaExpedientes;
			}

			return $listaExpedientes;

		} catch(Exception $e) {
			mail("gerardo.gomr@gmail.com", "Error en el sistema SIACME", "Error: ".$e->getMessage());
			echo "Error: ".$e->getMessage();
		}
	}

	/**
	* guardar o editar el expediente
	* dependiendo si es un paciente nuevo o subsecuente
	* su idExpediente
	* @param Expediente $expediente
	* @return bool
	*/
	public function persistir(Expediente $expediente)
	{
		// llamar codigo padre
		parent::persistir($expediente);

		// guardar en tabla principal
		try {
			if($expediente->existe() === false) {
				DB::table('expediente_odontopediatria')
					->insert([
						'idExpediente'               => $expediente->getId(),
						'idMarcaPasta'               => $expediente->getMarcaPasta()->getId(),
						'idComportamientoInicial'    => 1,
						'idComportamientoFrankl'     => 1,
						'idTrastornoLenguaje'        => 1,
						'idMorfologiaCraneofacial'   => 1,
						'idMorfologiaFacial'         => 1,
						'idConvexividadFacial'       => 1,
						'idATM'                      => 1,
						'NombrePadre'                => $expediente->getNombrePadre(),
						'NombreMadre'                => $expediente->getNombreMadre(),
						'OcupacionPadre'             => $expediente->getOcupacionPadre(),
						'OcupacionMadre'             => $expediente->getOcupacionMadre(),
						'NombreEdadesHermanos'       => $expediente->getNombreEdadesHermanos(),
						'HaPresentadoDolorBoca'      => $expediente->getHaPresentadoDolorBoca(),
						'PresentaMalOlorBoca'        => $expediente->getPresentaMalOlorBoca(),
						'HaNotadoSangradoEncias'     => $expediente->getHaNotadoSangradoEncias(),
						'SienteDienteFlojo'          => $expediente->getSienteDienteFlojo(),
						'idTrastornoLenguaje'        => $expediente->getTrastornoLenguaje()->getId(),
						'PrimeraVisitaDentista'      => $expediente->getPrimeraVisitaDentista(),
						'FechaUltimoExamenBucal'     => $expediente->getFechaUltimoExamenBucal(),
						'MotivoVisitaDentista'       => $expediente->getMotivoVisitaDentista(),
						'LeHanColocadoAnestesico'    => $expediente->getLeHanColocadoAnestesico(),
						'TuvoMalaReaccionAnestesico' => $expediente->getTuvoMalaReaccionAnestesico(),
						'ReaccionAnestesico'         => $expediente->getReaccionAnestesico(),
						'TraumatismoBucal'           => $expediente->getTraumatismoBucal(),
						'TipoCepilloAdulto'			 => $expediente->getTipoCepilloAdulto(),
						'EdadErupcionoPrimerDiente'  => $expediente->getEdadErupcionoPrimerDiente(),
						'VecesCepillaDiente'		 => $expediente->getVecesCepillaDiente(),
						'AlguienAyudaACepillarse'	 => $expediente->getAlguienAyudaACepillarse(),
						'VecesComeDia'				 => $expediente->getVecesComeDia(),
						'HiloDental'				 => $expediente->getHiloDental(),
						'EnjuagueBucal'				 => $expediente->getEnjuagueBucal(),
						'LimpiadorLingual'			 => $expediente->getLimpiadorLingual(),
						'TabletasReveladoras'		 => $expediente->getTabletasReveladoras(),
						'OtroAuxiliar'				 => $expediente->getOtroAuxiliar(),
						'EspecifiqueAuxiliar' 		 => $expediente->getEspecifiqueAuxiliar(),
						'SuccionDigital'			 => $expediente->getSuccionDigital(),
						'SuccionLingual'			 => $expediente->getSuccionLingual(),
						'Biberon'					 => $expediente->getBiberon(),
						'Bruxismo'					 => $expediente->getBruxismo(),
						'SuccionLabial'				 => $expediente->getSuccionLabial(),
						'RespiracionBucal'			 => $expediente->getRespiracionBucal(),
						'Onicofagia'				 => $expediente->getOnicofagia(),
						'Chupon'					 => $expediente->getChupon(),
						'OtroHabito'				 => $expediente->getOtroHabito(),
						'DescripcionHabito' 		 => $expediente->getDescripcionHabito(),
						'FechaCreacion'              => \Carbon\Carbon::now(),
						'FechaActualizacion'         => \Carbon\Carbon::now()
					]);

				} else {
					DB::table('expediente_odontopediatria')
					->where('idExpediente', '=', $expediente->getId())
					->update([
						'idExpediente'               => $expediente->getId(),
						'idMarcaPasta'               => $expediente->getMarcaPasta()->getId(),
						'idComportamientoInicial'    => 1,
						'idComportamientoFrankl'     => 1,
						'idTrastornoLenguaje'        => 1,
						'idMorfologiaCraneofacial'   => 1,
						'idMorfologiaFacial'         => 1,
						'idConvexividadFacial'       => 1,
						'idATM'                      => 1,
						'NombrePadre'                => $expediente->getNombrePadre(),
						'NombreMadre'                => $expediente->getNombreMadre(),
						'OcupacionPadre'             => $expediente->getOcupacionPadre(),
						'OcupacionMadre'             => $expediente->getOcupacionMadre(),
						'NombreEdadesHermanos'       => $expediente->getNombreEdadesHermanos(),
						'HaPresentadoDolorBoca'      => $expediente->getHaPresentadoDolorBoca(),
						'PresentaMalOlorBoca'        => $expediente->getPresentaMalOlorBoca(),
						'HaNotadoSangradoEncias'     => $expediente->getHaNotadoSangradoEncias(),
						'SienteDienteFlojo'          => $expediente->getSienteDienteFlojo(),
						'idTrastornoLenguaje'        => $expediente->getTrastornoLenguaje()->getId(),
						'PrimeraVisitaDentista'      => $expediente->getPrimeraVisitaDentista(),
						'FechaUltimoExamenBucal'     => $expediente->getFechaUltimoExamenBucal(),
						'MotivoVisitaDentista'       => $expediente->getMotivoVisitaDentista(),
						'LeHanColocadoAnestesico'    => $expediente->getLeHanColocadoAnestesico(),
						'TuvoMalaReaccionAnestesico' => $expediente->getTuvoMalaReaccionAnestesico(),
						'ReaccionAnestesico'         => $expediente->getReaccionAnestesico(),
						'TraumatismoBucal'           => $expediente->getTraumatismoBucal(),
						'TipoCepilloAdulto'			 => $expediente->getTipoCepilloAdulto(),
						'EdadErupcionoPrimerDiente'  => $expediente->getEdadErupcionoPrimerDiente(),
						'VecesCepillaDiente'		 => $expediente->getVecesCepillaDiente(),
						'AlguienAyudaACepillarse'	 => $expediente->getAlguienAyudaACepillarse(),
						'VecesComeDia'				 => $expediente->getVecesComeDia(),
						'HiloDental'				 => $expediente->getHiloDental(),
						'EnjuagueBucal'				 => $expediente->getEnjuagueBucal(),
						'LimpiadorLingual'			 => $expediente->getLimpiadorLingual(),
						'TabletasReveladoras'		 => $expediente->getTabletasReveladoras(),
						'OtroAuxiliar'				 => $expediente->getOtroAuxiliar(),
						'EspecifiqueAuxiliar' 		 => $expediente->getEspecifiqueAuxiliar(),
						'SuccionDigital'			 => $expediente->getSuccionDigital(),
						'SuccionLingual'			 => $expediente->getSuccionLingual(),
						'Biberon'					 => $expediente->getBiberon(),
						'Bruxismo'					 => $expediente->getBruxismo(),
						'SuccionLabial'				 => $expediente->getSuccionLabial(),
						'RespiracionBucal'			 => $expediente->getRespiracionBucal(),
						'Onicofagia'				 => $expediente->getOnicofagia(),
						'Chupon'					 => $expediente->getChupon(),
						'OtroHabito'				 => $expediente->getOtroHabito(),
						'DescripcionHabito' 		 => $expediente->getDescripcionHabito(),
						'FechaCreacion'              => \Carbon\Carbon::now(),
						'FechaActualizacion'         => \Carbon\Carbon::now()
					]);
				}

				return true;

			} catch(Exception $e) {
				echo $e->getMessage();
				return false;
			}
		// }
	}

	/**
	 * cargar los datos del expediente proporcionado
	 * @param  Expediente $expediente
	 * @return bool
	 */
	public function obtenerExpedientePorExpediente(Expediente $expediente)
	{
		// call parent's method
		parent::obtenerExpedientePorExpediente($expediente);

		try {

			$expedienteBD =	DB::table('expediente_odontopediatria')
					->join('marca_pasta', 'marca_pasta.idMarcaPasta', '=', 'expediente_odontopediatria.idMarcaPasta')
					->join('comportamiento_inicial', 'comportamiento_inicial.idComportamientoInicial', '=', 'expediente_odontopediatria.idComportamientoInicial')
					->join('comportamiento_frankl', 'comportamiento_frankl.idComportamientoFrankl', '=', 'expediente_odontopediatria.idComportamientoFrankl')
					->join('trastorno_lenguaje', 'trastorno_lenguaje.idTrastornoLenguaje', '=', 'expediente_odontopediatria.idTrastornoLenguaje')
					->join('morfologia_craneofacial', 'morfologia_craneofacial.idMorfologiaCraneofacial', '=', 'expediente_odontopediatria.idMorfologiaCraneofacial')
					->join('morfologia_facial', 'morfologia_facial.idMorfologiaFacial', '=', 'expediente_odontopediatria.idMorfologiaFacial')
					->join('convexividad_facial', 'convexividad_facial.idConvexividadFacial', '=', 'expediente_odontopediatria.idConvexividadFacial')
					->join('atm', 'atm.idATM', '=', 'expediente_odontopediatria.idATM')
					->where('expediente_odontopediatria.idExpediente', $expediente->getId())
					->first();

			$totalExpedientes = count($expedienteBD);

			if($totalExpedientes > 0) {
				// llenar todos los campos del expediente
				$marcaPasta = new MarcaPasta();
				$marcaPasta->setId($expedienteBD->idMarcaPasta);
				$marcaPasta->setMarcaPasta($expedienteBD->MarcaPasta);

				$comportamiento = new ComportamientoInicial();
				$comportamiento->setId($expedienteBD->idComportamientoInicial);
				$comportamiento->setComportamientoInicial($expedienteBD->ComportamientoInicial);

				$comportamientoFrankl = new ComportamientoFrankl();
				$comportamientoFrankl->setId($expedienteBD->idComportamientoFrankl);
				$comportamientoFrankl->setComportamientoFrankl($expedienteBD->ComportamientoFrankl);

				$trastorno = new TrastornoLenguaje();
				$trastorno->setId($expedienteBD->idTrastornoLenguaje);
				$trastorno->setTrastornoLenguaje($expedienteBD->TrastornoLenguaje);

				$morfologiaCraneofacial = new MorfologiaCraneofacial();
				$morfologiaCraneofacial->setId($expedienteBD->idMorfologiaCraneofacial);
				$morfologiaCraneofacial->setMorfologiaCraneofacial($expedienteBD->MorfologiaCraneofacial);

				$morfologiaFacial = new MorfologiaFacial();
				$morfologiaFacial->setId($expedienteBD->MorfologiaFacial);
				$morfologiaFacial->setMorfologiaFacial($expedienteBD->MorfologiaFacial);

				$convexividad = new ConvexividadFacial();
				$convexividad->setId($expedienteBD->idConvexividadFacial);
				$convexividad->setConvexividadFacial($expedienteBD->ConvexividadFacial);

				$atm = new ATM();
				$atm->setId($expedienteBD->idATM);
				$atm->setATM($expedienteBD->ATM);

				$expediente->setMarcaPasta($marcaPasta);
				$expediente->setComportamientoInicial($comportamiento);
				$expediente->setComportamientoFrankl($comportamientoFrankl);
				$expediente->setTrastornoLenguaje($trastorno);
				$expediente->setMorfologiaCraneofacial($morfologiaCraneofacial);
				$expediente->setMorfologiaFacial($morfologiaFacial);
				$expediente->setConvexividadFacial($convexividad);
				$expediente->setATM($atm);

				$expediente->setNombrePadre($expedienteBD->NombrePadre);
				$expediente->setNombreMadre($expedienteBD->NombreMadre);
				$expediente->setOcupacionPadre($expedienteBD->OcupacionPadre);
				$expediente->setOcupacionMadre($expedienteBD->OcupacionMadre);
				$expediente->setNombreEdadesHermanos($expedienteBD->NombreEdadesHermanos);
				$expediente->setHaPresentadoDolorBoca($expedienteBD->HaPresentadoDolorBoca);
				$expediente->setPresentaMalOlorBoca($expedienteBD->PresentaMalOlorBoca);
				$expediente->setHaNotadoSangradoEncias($expedienteBD->HaNotadoSangradoEncias);
				$expediente->setSienteDienteFlojo($expedienteBD->SienteDienteFlojo);
				$expediente->setPrimeraVisitaDentista($expedienteBD->PrimeraVisitaDentista);
				$expediente->setFechaUltimoExamenBucal($expedienteBD->FechaUltimoExamenBucal);
				$expediente->setMotivoVisitaDentista($expedienteBD->MotivoVisitaDentista);
				$expediente->setLeHanColocadoAnestesico($expedienteBD->LeHanColocadoAnestesico);
				$expediente->setTuvoMalaReaccionAnestesico($expedienteBD->TuvoMalaReaccionAnestesico);
				$expediente->setReaccionAnestesico($expedienteBD->ReaccionAnestesico);
				$expediente->setTraumatismoBucal($expedienteBD->TraumatismoBucal);
				$expediente->setTipoCepilloAdulto($expedienteBD->TipoCepilloAdulto);
				$expediente->setEdadErupcionoPrimerDiente($expedienteBD->EdadErupcionoPrimerDiente);
				$expediente->setVecesCepillaDiente($expedienteBD->VecesCepillaDiente);
				$expediente->setAlguienAyudaACepillarse($expedienteBD->AlguienAyudaACepillarse);
				$expediente->setVecesComeDia($expedienteBD->VecesComeDia);
				$expediente->setHiloDental($expedienteBD->HiloDental);
				$expediente->setEnjuagueBucal($expedienteBD->EnjuagueBucal);
				$expediente->setLimpiadorLingual($expedienteBD->LimpiadorLingual);
				$expediente->setTabletasReveladoras($expedienteBD->TabletasReveladoras);
				$expediente->setOtroAuxiliar($expedienteBD->OtroAuxiliar);
				$expediente->setEspecifiqueAuxiliar($expedienteBD->EspecifiqueAuxiliar);
				$expediente->setSuccionDigital($expedienteBD->SuccionDigital);
				$expediente->setSuccionLingual($expedienteBD->SuccionLingual);
				$expediente->setBiberon($expedienteBD->Biberon);
				$expediente->setBruxismo($expedienteBD->Bruxismo);
				$expediente->setSuccionLabial($expedienteBD->SuccionLabial);
				$expediente->setRespiracionBucal($expedienteBD->RespiracionBucal);
				$expediente->setOnicofagia($expedienteBD->Onicofagia);
				$expediente->setChupon($expedienteBD->Chupon);
				$expediente->setOtroHabito($expedienteBD->OtroHabito);
				$expediente->setDescripcionHabito($expedienteBD->DescripcionHabito);
			}

			return true;

		} catch(\Exception $e) {

			return false;
		}
	}

	/**
	 * obtener los datos de un expediente en base al paciente
	 * @param  Paciente $paciente
	 * @return Expediente
	 */
	public function obtenerExpedientePorPaciente(Paciente $paciente)
	{
		try {

			$expedienteBD =	DB::table('expediente_odontopediatria')
					->join('expediente', 'expediente.idExpediente', '=', 'expediente_odontopediatria.idExpediente')
					->join('paciente', 'paciente.idPaciente', '=', 'expediente.idPaciente')
					->join('marca_pasta', 'marca_pasta.idMarcaPasta', '=', 'expediente_odontopediatria.idMarcaPasta')
					->join('comportamiento_inicial', 'comportamiento_inicial.idComportamientoInicial', '=', 'expediente_odontopediatria.idComportamientoInicial')
					->join('comportamiento_frankl', 'comportamiento_frankl.idComportamientoFrankl', '=', 'expediente_odontopediatria.idComportamientoFrankl')
					->join('trastorno_lenguaje', 'trastorno_lenguaje.idTrastornoLenguaje', '=', 'expediente_odontopediatria.idTrastornoLenguaje')
					->join('morfologia_craneofacial', 'morfologia_craneofacial.idMorfologiaCraneofacial', '=', 'expediente_odontopediatria.idMorfologiaCraneofacial')
					->join('morfologia_facial', 'morfologia_facial.idMorfologiaFacial', '=', 'expediente_odontopediatria.idMorfologiaFacial')
					->join('convexividad_facial', 'convexividad_facial.idConvexividadFacial', '=', 'expediente_odontopediatria.idConvexividadFacial')
					->join('atm', 'atm.idATM', '=', 'expediente_odontopediatria.idATM')
					->where('expediente.idPaciente', $paciente->getId())
					->first();

			$totalExpedientes = count($expedienteBD);

			if($totalExpedientes > 0) {
				$expediente = new ExpedienteOdontopediatria();
				$expediente->setPaciente($paciente);
				$expediente->setId($expedienteBD->idExpediente);
				$expediente->setExiste(false);

				// llenar todos los campos del expediente
				$marcaPasta = new MarcaPasta();
				$marcaPasta->setId($expedienteBD->idMarcaPasta);
				$marcaPasta->setMarcaPasta($expedienteBD->MarcaPasta);

				$comportamiento = new ComportamientoInicial();
				$comportamiento->setId($expedienteBD->idComportamientoInicial);
				$comportamiento->setComportamientoInicial($expedienteBD->ComportamientoInicial);

				$comportamientoFrankl = new ComportamientoFrankl();
				$comportamientoFrankl->setId($expedienteBD->idComportamientoFrankl);
				$comportamientoFrankl->setComportamientoFrankl($expedienteBD->ComportamientoFrankl);

				$trastorno = new TrastornoLenguaje();
				$trastorno->setId($expedienteBD->idTrastornoLenguaje);
				$trastorno->setTrastornoLenguaje($expedienteBD->TrastornoLenguaje);

				$morfologiaCraneofacial = new MorfologiaCraneofacial();
				$morfologiaCraneofacial->setId($expedienteBD->idMorfologiaCraneofacial);
				$morfologiaCraneofacial->setMorfologiaCraneofacial($expedienteBD->MorfologiaCraneofacial);

				$morfologiaFacial = new MorfologiaFacial();
				$morfologiaFacial->setId($expedienteBD->MorfologiaFacial);
				$morfologiaFacial->setMorfologiaFacial($expedienteBD->MorfologiaFacial);

				$convexividad = new ConvexividadFacial();
				$convexividad->setId($expedienteBD->idConvexividadFacial);
				$convexividad->setConvexividadFacial($expedienteBD->ConvexividadFacial);

				$atm = new ATM();
				$atm->setId($expedienteBD->idATM);
				$atm->setATM($expedienteBD->ATM);

				$expediente->setMarcaPasta($marcaPasta);
				$expediente->setComportamientoInicial($comportamiento);
				$expediente->setComportamientoFrankl($comportamientoFrankl);
				$expediente->setTrastornoLenguaje($trastorno);
				$expediente->setMorfologiaCraneofacial($morfologiaCraneofacial);
				$expediente->setMorfologiaFacial($morfologiaFacial);
				$expediente->setConvexividadFacial($convexividad);
				$expediente->setATM($atm);

				$expediente->setNombrePadre($expedienteBD->NombrePadre);
				$expediente->setNombreMadre($expedienteBD->NombreMadre);
				$expediente->setOcupacionPadre($expedienteBD->OcupacionPadre);
				$expediente->setOcupacionMadre($expedienteBD->OcupacionMadre);
				$expediente->setNombreEdadesHermanos($expedienteBD->NombreEdadesHermanos);
				$expediente->setHaPresentadoDolorBoca($expedienteBD->HaPresentadoDolorBoca);
				$expediente->setPresentaMalOlorBoca($expedienteBD->PresentaMalOlorBoca);
				$expediente->setHaNotadoSangradoEncias($expedienteBD->HaNotadoSangradoEncias);
				$expediente->setSienteDienteFlojo($expedienteBD->SienteDienteFlojo);
				$expediente->setPrimeraVisitaDentista($expedienteBD->PrimeraVisitaDentista);
				$expediente->setFechaUltimoExamenBucal($expedienteBD->FechaUltimoExamenBucal);
				$expediente->setMotivoVisitaDentista($expedienteBD->MotivoVisitaDentista);
				$expediente->setLeHanColocadoAnestesico($expedienteBD->LeHanColocadoAnestesico);
				$expediente->setTuvoMalaReaccionAnestesico($expedienteBD->TuvoMalaReaccionAnestesico);
				$expediente->setReaccionAnestesico($expedienteBD->ReaccionAnestesico);
				$expediente->setTraumatismoBucal($expedienteBD->TraumatismoBucal);
				$expediente->setTipoCepilloAdulto($expedienteBD->TipoCepilloAdulto);
				$expediente->setEdadErupcionoPrimerDiente($expedienteBD->EdadErupcionoPrimerDiente);
				$expediente->setVecesCepillaDiente($expedienteBD->VecesCepillaDiente);
				$expediente->setAlguienAyudaACepillarse($expedienteBD->AlguienAyudaACepillarse);
				$expediente->setVecesComeDia($expedienteBD->VecesComeDia);
				$expediente->setHiloDental($expedienteBD->HiloDental);
				$expediente->setEnjuagueBucal($expedienteBD->EnjuagueBucal);
				$expediente->setLimpiadorLingual($expedienteBD->LimpiadorLingual);
				$expediente->setTabletasReveladoras($expedienteBD->TabletasReveladoras);
				$expediente->setOtroAuxiliar($expedienteBD->OtroAuxiliar);
				$expediente->setEspecifiqueAuxiliar($expedienteBD->EspecifiqueAuxiliar);
				$expediente->setSuccionDigital($expedienteBD->SuccionDigital);
				$expediente->setSuccionLingual($expedienteBD->SuccionLingual);
				$expediente->setBiberon($expedienteBD->Biberon);
				$expediente->setBruxismo($expedienteBD->Bruxismo);
				$expediente->setSuccionLabial($expedienteBD->SuccionLabial);
				$expediente->setRespiracionBucal($expedienteBD->RespiracionBucal);
				$expediente->setOnicofagia($expedienteBD->Onicofagia);
				$expediente->setChupon($expedienteBD->Chupon);
				$expediente->setOtroHabito($expedienteBD->OtroHabito);
				$expediente->setDescripcionHabito($expedienteBD->DescripcionHabito);

				parent::obtenerExpedientePorExpediente($expediente);

				return $expediente;
			}

			return null;

		} catch(\Exception $e) {

			return null;
		}
	}
}