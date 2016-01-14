<?php
namespace Siacme\Expedientes;

use DB;
use Siacme\Pacientes\Paciente;

/**
 * @author Gerardo Adrián Gómez Ruiz
 * @version 1.0
 */
abstract class ExpedientesRepositorioMySQL
{
	public abstract function buscarExpedientesPorNombre($nombreBusqueda = '');

	/**
	 * persistir expediente en la base de datos
	 * @param Expediente $expediente
	 */
	public function persistir(Expediente $expediente)
	{
		// guardar
		try {
			// var_dump($expediente->getId());exit;
			// insertar si no esta seteado el idExpediente
			if(is_null($expediente->getId())) {
				$idExpediente = DB::table('expediente')
					->insertGetId([
						// 1a pestaña
						'idEstadoCivil'               => 1,
						'idReligion'                  => 1,
						'idEscolaridad'               => 1,
						'idInstitucionMedica'         => 1,
						'idPaciente'				  => $expediente->getPaciente()->getId(),
						'Nombre'                      => $expediente->getNombre(),
						'Paterno'                     => $expediente->getPaterno(),
						'Materno'                     => $expediente->getMaterno(),
						'Telefono'                    => $expediente->getTelefono(),
						'Celular'                     => $expediente->getCelular(),
						'Email'                       => $expediente->getEmail(),
						'Direccion'                   => $expediente->getDireccion(),
						'CP'                          => $expediente->getCP(),
						'Municipio'                   => $expediente->getMunicipio(),
						'FechaNacimiento'             => $expediente->getFechaNacimiento(),
						'Edad'                        => $expediente->getEdadAnios(),
						'LugarNacimiento'             => $expediente->getLugarNacimiento(),
						'NombrePediatra'              => $expediente->getNombrePediatra(),
						'NombreQuienRecomienda'       => $expediente->getNombreRecomienda(),
						'SeHaAutomedicado'            => $expediente->getSeHaAutomedicado(),
						'ConQue'                      => $expediente->getConQueSeHaAutomedicado(),
						'EsAlergico'                  => $expediente->getEsAlergico(),
						'ACual'                       => $expediente->getAQueMedicamentoEsAlergico(),
						//2a pestaña
						'EstaVivaMadre'               => $expediente->getViveMadre(),
						'CausaMuerteMadre'            => $expediente->getCausaMuerteMadre(),
						'EnfermedadesPadeceMadre'     => $expediente->getEnfermedadesMadre(),
						'EstaVivoPadre'               => $expediente->getVivePadre(),
						'CausaMuertePadre'            => $expediente->getCausaMuertePadre(),
						'EnfermedadesPadecePadre'     => $expediente->getEnfermedadesPadre(),
						'NumHermanos'                 => $expediente->getNumHermanos(),
						'NumHermanosVivos'            => $expediente->getNumHermanosVivos(),
						'NumHermanosFinados'          => $expediente->getNumHermanosFinados(),
						'EnfermedadesPadecenHermanos' => $expediente->getEnfermedadesHermanos(),
						'EnfermedadesAbuelosPaternos' => $expediente->getEnfermedadesAbuelosPaternos(),
						'EnfermedadesAbuelosMaternos' => $expediente->getEnfermedadesAbuelosMaternos(),
						// 3a pestaña
						'SeLeHacenMoretones'		  => $expediente->getSeLeHacenMoretones(),
						'HaRequeridoTransfusion'	  => $expediente->getHaRequeridoTransfusion(),
						'HaTenidoFracturas'			  => $expediente->getHaTenidoFracturas(),
						'EspecifiqueFracturas'		  => $expediente->getEspecifiqueFracturas(),
						'HaSidoIntervenido'			  => $expediente->getHaSidoIntervenido(),
						'EspecifiqueIntervencion'	  => $expediente->getEspecifiqueIntervencion(),
						'HaSidoHospitalizado'		  => $expediente->getHaSidoHospitalizado(),
						'EspecifiqueHospitalizacion'  => $expediente->getEspecifiqueHospitalizacion(),
						'EsExFumador'				  => $expediente->getExFumador(),
						'EsExAlcoholico'			  => $expediente->getExAlcoholico(),
						'EsExAdicto'				  => $expediente->getExAdicto(),
						'EstaBajoTratamiento'		  => $expediente->getEstaBajoTratamiento(),
						'EspecifiqueTratamiento'	  => $expediente->getEspecifiqueTratamiento(),
						'FechaCreacion'               => \Carbon\Carbon::now(),
						'FechaActualizacion'          => \Carbon\Carbon::now()
					]);

				// obtener el Id
				$expediente->setId($idExpediente);
				$expediente->setExiste(false);

			} else {
				// editar
				DB::table('expediente')
					->where('idExpediente', '=', $expediente->getId())
					->update([
						// 1a pestaña
						'idEstadoCivil'               => 1,
						'idReligion'                  => 1,
						'idEscolaridad'               => 1,
						'idInstitucionMedica'         => 1,
						'idPaciente'				  => $expediente->getPaciente()->getId(),
						'Nombre'                      => $expediente->getNombre(),
						'Paterno'                     => $expediente->getPaterno(),
						'Materno'                     => $expediente->getMaterno(),
						'Telefono'                    => $expediente->getTelefono(),
						'Celular'                     => $expediente->getCelular(),
						'Email'                       => $expediente->getEmail(),
						'Direccion'                   => $expediente->getDireccion(),
						'CP'                          => $expediente->getCP(),
						'Municipio'                   => $expediente->getMunicipio(),
						'FechaNacimiento'             => $expediente->getFechaNacimiento(),
						'Edad'                        => $expediente->getEdadAnios(),
						'LugarNacimiento'             => $expediente->getLugarNacimiento(),
						'NombrePediatra'              => $expediente->getNombrePediatra(),
						'NombreQuienRecomienda'       => $expediente->getNombreRecomienda(),
						'SeHaAutomedicado'            => $expediente->getSeHaAutomedicado(),
						'ConQue'                      => $expediente->getConQueSeHaAutomedicado(),
						'EsAlergico'                  => $expediente->getEsAlergico(),
						'ACual'                       => $expediente->getAQueMedicamentoEsAlergico(),
						//2a pestaña
						'EstaVivaMadre'               => $expediente->getViveMadre(),
						'CausaMuerteMadre'            => $expediente->getCausaMuerteMadre(),
						'EnfermedadesPadeceMadre'     => $expediente->getEnfermedadesMadre(),
						'EstaVivoPadre'               => $expediente->getVivePadre(),
						'CausaMuertePadre'            => $expediente->getCausaMuertePadre(),
						'EnfermedadesPadecePadre'     => $expediente->getEnfermedadesPadre(),
						'NumHermanos'                 => $expediente->getNumHermanos(),
						'NumHermanosVivos'            => $expediente->getNumHermanosVivos(),
						'NumHermanosFinados'          => $expediente->getNumHermanosFinados(),
						'EnfermedadesPadecenHermanos' => $expediente->getEnfermedadesHermanos(),
						'EnfermedadesAbuelosPaternos' => $expediente->getEnfermedadesAbuelosPaternos(),
						'EnfermedadesAbuelosMaternos' => $expediente->getEnfermedadesAbuelosMaternos(),
						// 3a pestaña
						'SeLeHacenMoretones'		  => $expediente->getSeLeHacenMoretones(),
						'HaRequeridoTransfusion'	  => $expediente->getHaRequeridoTransfusion(),
						'HaTenidoFracturas'			  => $expediente->getHaTenidoFracturas(),
						'EspecifiqueFracturas'		  => $expediente->getEspecifiqueFracturas(),
						'HaSidoIntervenido'			  => $expediente->getHaSidoIntervenido(),
						'EspecifiqueIntervencion'	  => $expediente->getEspecifiqueIntervencion(),
						'HaSidoHospitalizado'		  => $expediente->getHaSidoHospitalizado(),
						'EspecifiqueHospitalizacion'  => $expediente->getEspecifiqueHospitalizacion(),
						'EsExFumador'				  => $expediente->getExFumador(),
						'EsExAlcoholico'			  => $expediente->getExAlcoholico(),
						'EsExAdicto'				  => $expediente->getExAdicto(),
						'EstaBajoTratamiento'		  => $expediente->getEstaBajoTratamiento(),
						'EspecifiqueTratamiento'	  => $expediente->getEspecifiqueTratamiento(),
						'Firma'						  => $expediente->getFirma(),
						'FechaCreacion'               => \Carbon\Carbon::now(),
						'FechaActualizacion'          => \Carbon\Carbon::now()
					]);

				// eliminar padecimientos
				DB::table('expediente_padecimiento')
					->where('idExpediente', '=', $expediente->getId())
					->delete();
			}

			// guardar padecimientos
			if(!is_null($expediente->getListaPadecimientos())) {

				foreach ($expediente->getListaPadecimientos() as $padecimiento) {
					DB::table('expediente_padecimiento')
						->insert([
							'idExpediente'   => $expediente->getId(),
							'idPadecimiento' => $padecimiento->getId()
						]);
				}
			}

			return true;

		} catch(Exception $e) {
			echo $e->getMessage();
			return false;
		}
	}

	/**
	 * cargar los datos del expediente proporcionado
	 * @param  Expediente $expediente
	 * @return bool
	 */
	public function obtenerExpedientePorExpediente(Expediente $expediente)
	{
		try {

			$expedienteBD =	DB::table('expediente')
					->join('paciente', 'paciente.idPaciente', '=', 'expediente.idPaciente')
					->join('estado_civil', 'estado_civil.idEstadoCivil', '=', 'expediente.idEstadoCivil')
					->join('religion', 'religion.idReligion', '=', 'expediente.idReligion')
					->join('escolaridad', 'escolaridad.idEscolaridad', '=', 'expediente.idEscolaridad')
					->join('institucion_medica', 'institucion_medica.idInstitucionMedica', '=', 'expediente.idInstitucionMedica')

					->where('expediente.idExpediente', $expediente->getId())
					->first();

			$totalExpedientes = count($expedienteBD);

			$expediente->setExiste(false);

			if($totalExpedientes > 0) {
				// obtener padecimientos
				$padecimientos = DB::table('expediente')
					->join('expediente_padecimiento', 'expediente_padecimiento.idExpediente', '=', 'expediente.idExpediente')
					->join('padecimiento', 'expediente_padecimiento.idPadecimiento', '=', 'padecimiento.idPadecimiento')
					->where('expediente_padecimiento.idExpediente', $expediente->getId())
					->get();

				$totalPadecimientos = count($padecimientos);
				$listaPadecimientos = array();

				if($totalPadecimientos > 0) {

					foreach ($padecimientos as $padecimientos) {
						$padecimiento = new Padecimiento();

						$padecimiento->setId($padecimientos->idPadecimiento);
						$padecimiento->setPadecimiento($padecimientos->Padecimiento);

						$listaPadecimientos[] = $padecimiento;
					}

					$expediente->setListaPadecimientos($listaPadecimientos);
				}


				// llenar todos los campos del expediente
				$paciente = new Paciente();
				$paciente->setId($expedienteBD->idPaciente);
				$paciente->setNombre($expedienteBD->Nombre);
				$paciente->setPaterno($expedienteBD->Paterno);
				$paciente->setMaterno($expedienteBD->Materno);
				$paciente->setTelefono($expedienteBD->Telefono);
				$paciente->setCelular($expedienteBD->Celular);
				$paciente->setEmail($expedienteBD->Email);

				$estadoCivil = new EstadoCivil();
				$estadoCivil->setId($expedienteBD->idEstadoCivil);
				$estadoCivil->setEstadoCivil($expedienteBD->EstadoCivil);

				$religion = new Religion();
				$religion->setId($expedienteBD->idReligion);
				$religion->setReligion($expedienteBD->Religion);

				$escolaridad = new Escolaridad();
				$escolaridad->setId($expedienteBD->idEscolaridad);
				$escolaridad->setEscolaridad($expedienteBD->Escolaridad);

				$institucion = new InstitucionMedica();
				$institucion->setId($expedienteBD->idInstitucionMedica);
				$institucion->setInstitucionMedica($expedienteBD->InstitucionMedica);

				$expediente->setPaciente($paciente);
				$expediente->setEstadoCivil($estadoCivil);
				$expediente->setReligion($religion);
				$expediente->setEscolaridad($escolaridad);
				$expediente->setInstitucionMedica($institucion);

				$expediente->setDireccion($expedienteBD->Direccion);
				$expediente->setCP($expedienteBD->CP);
				$expediente->setMunicipio($expedienteBD->Municipio);
				$expediente->setFechaNacimiento($expedienteBD->FechaNacimiento);
				$expediente->setEdadAnios($expedienteBD->Edad);
				$expediente->setLugarNacimiento($expedienteBD->LugarNacimiento);
				$expediente->setNombrePediatra($expedienteBD->NombrePediatra);
				$expediente->setNombreRecomienda($expedienteBD->NombreQuienRecomienda);
				$expediente->setSeHaAutomedicado($expedienteBD->SeHaAutomedicado);
				$expediente->setConQueSeHaAutomedicado($expedienteBD->ConQue);
				$expediente->setEsAlergico($expedienteBD->EsAlergico);
				$expediente->setAQueMedicamentoEsAlergico($expedienteBD->ACual);
				$expediente->setViveMadre($expedienteBD->EstaVivaMadre);
				$expediente->setCausaMuerteMadre($expedienteBD->CausaMuerteMadre);
				$expediente->setEnfermedadesMadre($expedienteBD->EnfermedadesPadeceMadre);
				$expediente->setVivePadre($expedienteBD->EstaVivoPadre);
				$expediente->setCausaMuertePadre($expedienteBD->CausaMuertePadre);
				$expediente->setEnfermedadesPadre($expedienteBD->EnfermedadesPadecePadre);
				$expediente->setNumHermanos($expedienteBD->NumHermanos);
				$expediente->setNumHermanosVivos($expedienteBD->NumHermanosVivos);
				$expediente->setNumHermanosFinados($expedienteBD->NumHermanosFinados);
				$expediente->setCausaMuerteHermanos($expedienteBD->CausaMuerteHermanos);
				$expediente->setEnfermedadesHermanos($expedienteBD->EnfermedadesPadecenHermanos);
				$expediente->setEnfermedadesAbuelosPaternos($expedienteBD->EnfermedadesAbuelosPaternos);
				$expediente->setEnfermedadesAbuelosMaternos($expedienteBD->EnfermedadesAbuelosMaternos);
				$expediente->setFirma($expedienteBD->Firma);
				$expediente->setSeLeHacenMoretones($expedienteBD->SeLeHacenMoretones);
				$expediente->setHaRequeridoTransfusion($expedienteBD->HaRequeridoTransfusion);
				$expediente->setHaTenidoFracturas($expedienteBD->HaTenidoFracturas);
				$expediente->setEspecifiqueFracturas($expedienteBD->EspecifiqueFracturas);
				$expediente->setHaSidoIntervenido($expedienteBD->HaSidoIntervenido);
				$expediente->setEspecifiqueIntervencion($expedienteBD->EspecifiqueIntervencion);
				$expediente->setHaSidoHospitalizado($expedienteBD->HaSidoHospitalizado);
				$expediente->setEspecifiqueHospitalizacion($expedienteBD->EspecifiqueHospitalizacion);
				$expediente->setExFumador($expedienteBD->EsExFumador);
				$expediente->setExAlcoholico($expedienteBD->EsExAlcoholico);
				$expediente->setExAdicto($expedienteBD->EsExAdicto);
				$expediente->setEstaBajoTratamiento($expedienteBD->EstaBajoTratamiento);
				$expediente->setNombreRepresentante($expedienteBD->NombreRepresentante);
				$expediente->setNombreTutor($expedienteBD->NombreTutor);
				$expediente->setOcupacionTutor($expedienteBD->OcupacionTutor);
				$expediente->setMotivoConsulta($expedienteBD->MotivoConsulta);
				$expediente->setHistoriaEnfermedad($expedienteBD->HistoriaEnfermedad);
				$expediente->setPadecimientoActual($expedienteBD->PadecimientoActual);
				$expediente->setInterrogatorioPorAparatos($expedienteBD->InterrogatorioPorAparatos);

				$expediente->setExiste(true);
			}

			return true;

		} catch(\Exception $e) {

			return false;
		}
	}
}