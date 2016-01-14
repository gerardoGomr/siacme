<?php
namespace Siacme\Expedientes;

use DB;

/**
 * @author Gerardo Adrián Gómez Ruiz
 * @version 1.0
 */
class ExpedientesOdontopediatriaRepositorioBD extends ExpedientesRepositorioBD
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
	* dependiendo si existe o no
	* su idExpediente
	* @param Expediente $expediente
	* @return bool
	*/
	public function persistir(Expediente $expediente)
	{
		// call parent's function
		parent::persistir($expediente);

		// var_dump($modo);exit;
		if(!is_null($expediente->getId())) {
			// guardar en tabla principal
			try {
				DB::table('expediente_odontopediatria')
					->insert([
						'idExpediente'               => $expediente->getId(),
						'idMarcaPasta'               => $expediente->getOdontopediatria()->getMarcaPasta()->getId(),
						'idComportamientoInicial'    => 1,
						'idComportamientoFrankl'     => 1,
						'idTrastornoLenguaje'        => 1,
						'idMorfologiaCraneofacial'   => 1,
						'idMorfologiaFacial'         => 1,
						'idConvexividadFacial'       => 1,
						'idATM'                      => 1,
						'NombrePadre'                => $expediente->getOdontopediatria()->getNombrePadre(),
						'NombreMadre'                => $expediente->getOdontopediatria()->getNombreMadre(),
						'OcupacionPadre'             => $expediente->getOdontopediatria()->getOcupacionPadre(),
						'OcupacionMadre'             => $expediente->getOdontopediatria()->getOcupacionMadre(),
						'NombreEdadesHermanos'       => $expediente->getOdontopediatria()->getNombreEdadesHermanos(),
						'HaPresentadoDolorBoca'      => $expediente->getOdontopediatria()->getHaPresentadoDolorBoca(),
						'PresentaMalOlorBoca'        => $expediente->getOdontopediatria()->getPresentaMalOlorBoca(),
						'HaNotadoSangradoEncias'     => $expediente->getOdontopediatria()->getHaNotadoSangradoEncias(),
						'SienteDienteFlojo'          => $expediente->getOdontopediatria()->getSienteDienteFlojo(),
						'idTrastornoLenguaje'        => $expediente->getOdontopediatria()->getTrastornoLenguaje()->getId(),
						'PrimeraVisitaDentista'      => $expediente->getOdontopediatria()->getPrimeraVisitaDentista(),
						'FechaUltimoExamenBucal'     => $expediente->getOdontopediatria()->getFechaUltimoExamenBucal(),
						'MotivoVisitaDentista'       => $expediente->getOdontopediatria()->getMotivoVisitaDentista(),
						'LeHanColocadoAnestesico'    => $expediente->getOdontopediatria()->getLeHanColocadoAnestesico(),
						'TuvoMalaReaccionAnestesico' => $expediente->getOdontopediatria()->getTuvoMalaReaccionAnestesico(),
						'ReaccionAnestesico'         => $expediente->getOdontopediatria()->getReaccionAnestesico(),
						'TraumatismoBucal'           => $expediente->getOdontopediatria()->getTraumatismoBucal(),
						'TipoCepilloAdulto'			 => $expediente->getOdontopediatria()->getTipoCepilloAdulto(),
						'EdadErupcionoPrimerDiente'  => $expediente->getOdontopediatria()->getEdadErupcionoPrimerDiente(),
						'VecesCepillaDiente'		 => $expediente->getOdontopediatria()->getVecesCepillaDiente(),
						'AlguienAyudaACepillarse'	 => $expediente->getOdontopediatria()->getAlguienAyudaACepillarse(),
						'VecesComeDia'				 => $expediente->getOdontopediatria()->getVecesComeDia(),
						'HiloDental'				 => $expediente->getOdontopediatria()->getHiloDental(),
						'EnjuagueBucal'				 => $expediente->getOdontopediatria()->getEnjuagueBucal(),
						'LimpiadorLingual'			 => $expediente->getOdontopediatria()->getLimpiadorLingual(),
						'TabletasReveladoras'		 => $expediente->getOdontopediatria()->getTabletasReveladoras(),
						'OtroAuxiliar'				 => $expediente->getOdontopediatria()->getOtroAuxiliar(),
						'EspecifiqueAuxiliar' 		 => $expediente->getOdontopediatria()->getEspecifiqueAuxiliar(),
						'SuccionDigital'			 => $expediente->getOdontopediatria()->getSuccionDigital(),
						'SuccionLingual'			 => $expediente->getOdontopediatria()->getSuccionLingual(),
						'Biberon'					 => $expediente->getOdontopediatria()->getBiberon(),
						'Bruxismo'					 => $expediente->getOdontopediatria()->getBruxismo(),
						'SuccionLabial'				 => $expediente->getOdontopediatria()->getSuccionLabial(),
						'RespiracionBucal'			 => $expediente->getOdontopediatria()->getRespiracionBucal(),
						'Onicofagia'				 => $expediente->getOdontopediatria()->getOnicofagia(),
						'Chupon'					 => $expediente->getOdontopediatria()->getChupon(),
						'OtroHabito'				 => $expediente->getOdontopediatria()->getOtroHabito(),
						'DescripcionHabito' 		 => $expediente->getOdontopediatria()->getDescripcionHabito(),
						'FechaCreacion'              => \Carbon\Carbon::now(),
						'FechaActualizacion'         => \Carbon\Carbon::now()
					]);

				return true;

			} catch(Exception $e) {
				echo $e->getMessage();
				return false;
			}
		}
	}
}