<?php
namespace Siacme\Expedientes;

use DB;
use Siacme\Expedientes\ExpedientesRepositorioInterface;

/**
 * @author Gerardo Adrián Gómez Ruiz
 * @version 1.0
 */
abstract class ExpedientesRepositorioBD
{
	public abstract function buscarExpedientesPorNombre($nombreBusqueda = '');

	public function persistir(Expediente $expediente)
	{
		// insertar si no esta seteado el idExpediente
		if(!is_null($expediente->getId())) {
			// guardar
			try {

				$idExpediente = DB::table('expediente')
					->insertGetId([
						// 1a pestaña
						'idEstadoCivil'               => 1,
						'idReligion'                  => 1,
						'idEscolaridad'               => 1,
						'idInstitucionMedica'         => 1,
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

				// guardar detalle
				// $this->expedientesEspecialidadRepositorio->persistir($expediente);

				// guardar cita
				foreach ($expediente->getListaCitas() as $cita) {
					DB::table('cita_expediente')
						->insert([
							'idCita'             => $cita->getId(),
							'idExpediente'       => $expediente->getId(),
							'FechaCreacion'      => \Carbon\Carbon::now(),
							'FechaActualizacion' => \Carbon\Carbon::now()
						]);
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

				// if(!$this->expedienteRepositorioDetalle->persistir($expediente)) {
				// 	return false;
				// }

				return true;

			} catch(Exception $e) {
				echo $e->getMessage();
				return false;
			}
		}
	}
}