<?php
namespace Siacme\Expedientes;

use Illuminate\Http\Request;
use Siacme\Citas\Cita;

/**
* @author Gerardo Adrián Gómez Ruiz
* @version 1.0
* @date    11/08/2015
*/
class FabricaExpediente
{
	public static function construirExpedienteBasico($tipo = 1)
	{
		$expediente = null;
		switch ($tipo) {
			case 3:
				// odontopediatría
				$expediente 		   = new ExpedienteOdontopediatria();
				break;
			
			default: throw new \Exception('Tipo no soportado');
				break;
		}

		return $expediente;
	}

	public static function construirExpediente(Request $request, $tipo = 1)
	{
		////////////////
		// 1a pestaña //
		////////////////
		$txtNombre                      = $request->get('txtNombre');
		$txtPaterno                     = $request->get('txtPaterno');
		$txtMaterno                     = $request->get('txtMaterno');
		$txtFechaNac                    = $request->get('txtFechaNac');
		$txtEdad                        = $request->get('txtEdad');
		$txtLugarNac                    = $request->get('txtLugarNac');

		$txtPediatra                    = $request->get('txtPediatra');
		$txtRecomienda                  = $request->get('txtRecomienda');
		$txtMotivoConsulta              = $request->get('txtMotivoConsulta');
		$txtHistoriaEnfermedad          = $request->get('txtHistoriaEnfermedad');
		$txtDireccion                   = $request->get('txtDireccion');
		$txtCP                          = $request->get('txtCP');
		$txtMunicipio                   = $request->get('txtMunicipio');
		$txtTelefono                    = $request->get('txtTelefono');
		$txtCelular                     = $request->get('txtCelular');
		$txtEmail                       = $request->get('txtEmail');
		$haAutomedicado                 = $request->get('automedicado') === '2' ? 0 : 1;
		$txtConQueHaAutomedicado        = $request->get('txtConQueHaAutomedicado');
		$esAlergico                     = $request->get('alergico') === '2' ? 0 : 1;
		$aCualEsAlergico                = $request->get('txtACualEsAlergico');

		////////////////
		// 2a pestaña //
		////////////////
		$viveMadre                      = $request->get('viveMadre') === '2' ? 0 : 1;
		$txtCausaMuerteMadre            = $request->get('txtCausaMuerteMadre');
		$txtEnfermedadesMadre           = $request->get('txtEnfermedadesMadre');
		$vivePadre                      = $request->get('vivePadre') === '2' ? 0 : 1;
		$txtCausaMuertePadre            = $request->get('txtCausaMuertePadre');
		$txtEnfermedadesPadre           = $request->get('txtEnfermedadesPadre');
		$txtEnfermedadesAbuelosPaternos = $request->get('txtEnfermedadesAbuelosPaternos');
		$txtEnfermedadesAbuelosMaternos = $request->get('txtEnfermedadesAbuelosMaternos');
		$txtNumHermanos                 = $request->get('txtNumHermanos');
		$txtNumHermanosVivos            = $request->get('txtNumHermanosVivos');
		$txtNumHermanosFinados          = $request->get('txtNumHermanosFinados');

		$txtEnfermedadesHermanos        = $request->get('txtEnfermedadesHermanos');

		////////////////
		// 3a pestaña //
		////////////////
		$txtFractura                    = $request->get('txtFractura');
		$txtCirugia                     = $request->get('txtCirugia');
		$txtHospitalizado               = $request->get('txtHospitalizado');
		$txtTratamiento                 = $request->get('txtTratamiento');

		$listaPadecimientos 			= null;

		if(!is_null($request->get('padecimiento'))) {
			foreach ($request->get('padecimiento') as $padecimientos) {
				$listaPadecimientos[] = new Padecimiento($padecimientos);
			}
		}

		!is_null($request->get('moretones'))     ? $moretones     = 1 : $moretones     = 0;
		!is_null($request->get('transfusion'))   ? $transfusion   = 1 : $transfusion   = 0;
		!is_null($request->get('fracturas'))     ? $fracturas     = 1 : $fracturas     = 0;
		!is_null($request->get('cirugia'))       ? $cirugia       = 1 : $cirugia       = 0;
		!is_null($request->get('hospitalizado')) ? $hospitalizado = 1 : $hospitalizado = 0;
		!is_null($request->get('exFumador'))     ? $exFumador     = 1 : $exFumador     = 0;
		!is_null($request->get('exAlcoholico'))  ? $exAlcoholico  = 1 : $exAlcoholico  = 0;
		!is_null($request->get('exAdicto'))      ? $exAdicto      = 1 : $exAdicto      = 0;
		!is_null($request->get('tratamiento'))   ? $tratamiento   = 1 : $tratamiento   = 0;


		switch ($tipo) {
			case 3:
				/////////////////////
				// ODONTOPEDIATRIA //
				/////////////////////
				$expediente 		       = new ExpedienteOdontopediatria();

				$marca                     = new MarcaPasta();
				$trastorno 				   = new TrastornoLenguaje();
				///////////////
				//1a pestaña //
				///////////////
				$txtNombrePadre            = $request->get('txtNombrePadre');
				$txtNombreMadre            = $request->get('txtNombreMadre');
				$txtOcupacionPadre         = $request->get('txtOcupacionPadre');
				$txtOcupacionMadre         = $request->get('txtOcupacionMadre');
				$txtNombresEdades          = $request->get('txtNombresEdades');

				!is_null($request->get('trastorno')) ? $trastornoLenguaje = $request->get('trastorno') : $trastornoLenguaje = 1;

				!is_null($request->get('dolorBoca'))     ? $dolorBoca     = 1 : $dolorBoca     = 0;
				!is_null($request->get('sangradoEncias'))? $sangradoEncias= 1 : $sangradoEncias= 0;
				!is_null($request->get('malOlor'))       ? $malOlor       = 1 : $malOlor       = 0;
				!is_null($request->get('dienteFlojo'))   ? $dienteFlojo   = 1 : $dienteFlojo   = 0;

				$primeraVisita         	   = $request->get('primeraVisita') === '2' ? 0 : 1;
				$txtFechaUltimoExamen  	   = $request->get('txtFechaUltimoExamen');
				$txtMotivoUltimoExamen     = $request->get('txtMotivoUltimoExamen');
				$anestesico                = $request->get('anestesico') === '2' ? 0 : 1;
				$malaReaccion              = $request->get('malaReaccion') === '2' ? 0 : 1;
				$txtQueReaccion            = $request->get('txtQueReaccion');
				$txtTraumatismo            = $request->get('txtTraumatismo');

				////////////////
				// 7a pestaña //
				////////////////
				$tipoCepillo                = $request->get('tipoCepillo');
				$marcaPasta                 = $request->get('marcaPasta');
				$vecesCepilla			    = $request->get('txtVecesCepilla');
				$txtEdadErupcionDiente      = $request->get('txtEdadErupcionaPrimerDiente');
				$ayudaAlCepillarse          = $request->get('ayudaAlCepillarse') === '2' ? 1 : 0;
				$txtVecesComeDia            = $request->get('txtVecesCome');
				$txtEspecifiqueAuxiliar     = $request->get('txtEspecifiqueAuxiliar');

				!is_null($request->get('hiloDental'))          ? $hiloDental          = 1 : $hiloDental          = 0;
				!is_null($request->get('enjuagueBucal'))       ? $enjuagueBucal       = 1 : $enjuagueBucal       = 0;
				!is_null($request->get('limpiadorLingual'))    ? $limpiadorLingual    = 1 : $limpiadorLingual    = 0;
				!is_null($request->get('tabletasReveladoras')) ? $tabletasReveladoras = 1 : $tabletasReveladoras = 0;
				!is_null($request->get('otroAuxiliar'))        ? $otroAuxiliar        = 1 : $otroAuxiliar        = 0;

				////////////////
				// 8a pestaña //
				////////////////
				!is_null($request->get('succionDigital'))   ? $succionDigital   = 1 : $succionDigital   = 0;
				!is_null($request->get('succionLingual'))   ? $succionLingual   = 1 : $succionLingual   = 0;
				!is_null($request->get('biberon'))          ? $biberon          = 1 : $biberon          = 0;
				!is_null($request->get('bruxismo'))         ? $bruxismo         = 1 : $bruxismo         = 0;
				!is_null($request->get('succionLabial'))    ? $succionLabial    = 1 : $succionLabial    = 0;
				!is_null($request->get('respiracionBucal')) ? $respiracionBucal = 1 : $respiracionBucal = 0;
				!is_null($request->get('onicofagia'))       ? $onicofagia       = 1 : $onicofagia       = 0;
				!is_null($request->get('chupon'))           ? $chupon           = 1 : $chupon           = 0;
				!is_null($request->get('otroHabito'))       ? $otroHabito       = 1 : $otroHabito       = 0;

				$txtEspecifiqueHabito        = $request->get('txtEspecifiqueHabito');

				$expediente->setNombrePadre($txtNombrePadre);
				$expediente->setNombreMadre($txtNombreMadre);
				$expediente->setOcupacionPadre($txtOcupacionPadre);
				$expediente->setOcupacionMadre($txtOcupacionMadre);
				$expediente->setNombreEdadesHermanos($txtNombresEdades);

				////////////////
				// 3a pestaña //
				////////////////
				$expediente->setHaPresentadoDolorBoca($dolorBoca);
				$expediente->setHaNotadoSangradoEncias($sangradoEncias);
				$expediente->setPresentaMalOlorBoca($malOlor);
				$expediente->setSienteDienteFlojo($dienteFlojo);

				////////////////
				// 5a pestaña //
				////////////////
				$trastorno->setId($trastornoLenguaje);
				$expediente->setTrastornoLenguaje($trastorno);

				////////////////
				// 6a pestaña //
				////////////////
				$expediente->setPrimeraVisitaDentista($primeraVisita);
				$expediente->setFechaUltimoExamenBucal($txtFechaUltimoExamen);
				$expediente->setMotivoVisitaDentista($txtMotivoUltimoExamen);
				$expediente->setLeHanColocadoAnestesico($anestesico);
				$expediente->setTuvoMalaReaccionAnestesico($malaReaccion);
				$expediente->setReaccionAnestesico($malaReaccion);
				$expediente->setTraumatismoBucal($txtTraumatismo);

				////////////////
				// 7a pestaña //
				////////////////
				$expediente->setTipoCepilloAdulto($tipoCepillo);
				$marca->setId($marcaPasta);
				$expediente->setMarcaPasta($marca);
				$expediente->setVecesCepillaDiente($vecesCepilla);
				$expediente->setEdadErupcionoPrimerDiente($txtEdadErupcionDiente);
				$expediente->setAlguienAyudaACepillarse($ayudaAlCepillarse);
				$expediente->setVecesComeDia($txtVecesComeDia);
				$expediente->setHiloDental($hiloDental);
				$expediente->setEnjuagueBucal($enjuagueBucal);
				$expediente->setLimpiadorLingual($limpiadorLingual);
				$expediente->setTabletasReveladoras($tabletasReveladoras);
				$expediente->setOtroAuxiliar($otroAuxiliar);
				$expediente->setEspecifiqueAuxiliar($txtEspecifiqueAuxiliar);

				////////////////
				// 8a pestaña //
				////////////////
				$expediente->setSuccionDigital($succionDigital);
				$expediente->setSuccionLingual($succionLingual);
				$expediente->setBiberon($biberon);
				$expediente->setBruxismo($bruxismo);
				$expediente->setSuccionLabial($succionLabial);
				$expediente->setRespiracionBucal($respiracionBucal);
				$expediente->setOnicofagia($onicofagia);
				$expediente->setChupon($chupon);
				$expediente->setOtroHabito($otroHabito);
				$expediente->setDescripcionHabito($txtEspecifiqueHabito);
				break;

			case 'otorrinolaringologia':
				return new ExpedienteOtorrino();
				break;
			
			default:
				throw new \Exception("Especialidad no reconocida");
				break;
		}

		// datos básicos
		$expediente->setNombre($txtNombre);
		$expediente->setPaterno($txtPaterno);
		$expediente->setMaterno($txtMaterno);
		$expediente->setFechaNacimiento($txtFechaNac);
		$expediente->setEdadAnios($txtEdad);
		$expediente->setLugarNacimiento($txtLugarNac);
		$expediente->setNombrePediatra($txtPediatra);
		$expediente->setNombreRecomienda($txtRecomienda);
		$expediente->setMotivoConsulta($txtMotivoConsulta);
		$expediente->setHistoriaEnfermedad($txtHistoriaEnfermedad);
		$expediente->setDireccion($txtDireccion);
		$expediente->setCP($txtCP);
		$expediente->setMunicipio($txtMunicipio);
		$expediente->setTelefono($txtTelefono);
		$expediente->setCelular($txtCelular);
		$expediente->setEmail($txtEmail);
		$expediente->setSeHaAutomedicado($haAutomedicado);
		$expediente->setConQueSeHaAutomedicado($txtConQueHaAutomedicado);
		$expediente->setEsAlergico($esAlergico);
		$expediente->setAQueMedicamentoEsAlergico($aCualEsAlergico);

		$expediente->setViveMadre($viveMadre);
		$expediente->setCausaMuerteMadre($txtCausaMuerteMadre);
		$expediente->setEnfermedadesMadre($txtEnfermedadesMadre);
		$expediente->setVivePadre($vivePadre);
		$expediente->setCausaMuertePadre($txtCausaMuertePadre);
		$expediente->setEnfermedadesPadre($txtEnfermedadesPadre);
		$expediente->setNumHermanos($txtNumHermanos);
		$expediente->setNumHermanosVivos($txtNumHermanosVivos);
		$expediente->setNumHermanosFinados($txtNumHermanosFinados);

		$expediente->setEnfermedadesHermanos($txtEnfermedadesHermanos);
		$expediente->setEnfermedadesAbuelosPaternos($txtEnfermedadesAbuelosPaternos);
		$expediente->setEnfermedadesAbuelosMaternos($txtEnfermedadesAbuelosMaternos);

		$expediente->setSeLeHacenMoretones($moretones);
		$expediente->setHaRequeridoTransfusion($transfusion);
		$expediente->setHaTenidoFracturas($fracturas);
		$expediente->setHaSidoIntervenido($cirugia);
		$expediente->setHaSidoHospitalizado($hospitalizado);
		$expediente->setExFumador($exFumador);
		$expediente->setExAlcoholico($exAlcoholico);
		$expediente->setExAdicto($exAdicto);
		$expediente->setEstaBajoTratamiento($tratamiento);

		$expediente->setEspecifiqueFracturas($txtFractura);
		$expediente->setEspecifiqueIntervencion($txtCirugia);
		$expediente->setEspecifiqueHospitalizacion($txtHospitalizado);
		$expediente->setEspecifiqueTratamiento($txtTratamiento);
		$expediente->setListaPadecimientos($listaPadecimientos);

		return $expediente;
	}
}