<?php
namespace Siacme\Http\Controllers;

use Illuminate\Http\Request;
use Siacme\Http\Requests;
use Siacme\Http\Controllers\Controller;
use Siacme\Citas\Cita;
use Siacme\Citas\CitaBD;
use Siacme\Expedientes\Expediente;
use Siacme\Expedientes\ExpedienteOdontopediatria;
use Siacme\Expedientes\ExpedienteRepositorioBD;
use Siacme\Expedientes\ExpedienteOdontopediatriaBD;
use Siacme\Padecimientos\PadecimientoOdontopediatriaRepositorio;
use Siacme\Expedientes\FabricaExpediente;
use Siacme\Trastornos\TrastornoBD;
use Siacme\Pastas\MarcaPastaRepositorioBD;
use Validator;

/**
 * @author Gerardo Adrián Gómez Ruiz
 * @version 1.0
 */

class ExpedienteController extends Controller
{

	function __construct()
	{
		# code...
	}

	public function agregaEditaExpedienteOdontopediatria(Request $request, $id)
	{

	}

	// guardar editar expediente
	public function guardarExpediente(Expediente $expediente, ExpedientesRepositorioInterface $expedienteRepositorio)
	{
		if(!$expedienteRepositorio->persistir($expediente)) {
			return false;
		}

		if(!$expedienteRepositorio->persisteDetalle($expediente)) {
			return false;
		}

		return true;
	}
}