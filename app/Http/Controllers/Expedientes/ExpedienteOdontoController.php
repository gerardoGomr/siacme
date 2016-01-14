<?php
namespace Siacme\Http\Controllers;

use Illuminate\Http\Request;
use Siacme\Http\Requests;
use Siacme\Http\Controllers\Controller;
use Siacme\Citas\Cita;
use Siacme\Citas\CitaBD;
use Siacme\Expedientes\Expediente;
use Siacme\Expedientes\FabricaExpediente;
use Siacme\Expedientes\FabricaExpedientesRepositorio;
use Siacme\Trastornos\TrastornoBD;
use Siacme\Pastas\MarcaPastaRepositorioBD;

/**
 * @author Gerardo Adrián Gómez Ruiz
 * @version 1.0
 */

class ExpedienteController extends Controller
{

	public function agregaEditaExpediente(Request $request, $idCita)
	{
		$idCita = (int)base64_decode($idCita);

		$cita   = new Cita();
		$citaBD = new CitaBD();

		$cita->setId($idCita);
		$citaBD->cargarDatos($cita);

		///////////////////////////////////////////////////////////////////
		// especifico para crear la vista de expedientes odontopediatría //
		///////////////////////////////////////////////////////////////////
		$padecimientosRepositorio = new PadecimientoOdontopediatriaRepositorioBD();
		$trastornosRepositorio    = new TrastornoRepositorioBD();

		$marcasRepositorio		  = new MarcaPastaRepositorioBD();
		$listaPadecimientos       = $padecimientosRepositorio->obtenerPadecimientos();
		$listaTrastornos		  = $trastornosRepositorio->obtenerTrastornos();
		$listaMarcas			  = $marcasRepositorio->obtenerMarcaPastas();
		// var_dump($listaMarcas);exit;

		if(is_null($cita->getExpediente()->getId())) {
			// regresar vista sin expediente
			return view('expedientes.expediente_odontopediatria', compact('cita', 'listaPadecimientos', 'listaTrastornos',  'listaMarcas'));
		}

		////////////////////////////////////////////////////////////////
		// termina específico crear vista expedientes odontopediatría //
		////////////////////////////////////////////////////////////////


		// logica para cargar expediente junto con datos de odontopediatria
		// implementar una fabrica para ver como se crea el objeto y la
		// manera en que se cargan sus datos usando el repositorio
	}
}