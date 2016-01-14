<?php
namespace Siacme\Padecimientos;

use DB;

/**
* @author Gerardo Adrián Gómez Ruiz
*/
class PadecimientoOdontopediatriaRepositorioBD implements PadecimientoRepositorioInterface
{

	public function __construct()
	{
		# code...
	}

	public function obtenerPadecimientos()
	{
		$listaPadecimientos = array();

		// devolver padecimientos que le competen a odonto
		try {
			$padecimientos = DB::table('padecimiento')
								  ->join('especialidad_padecimiento', 'especialidad_padecimiento.idPadecimiento', '=', 'padecimiento.idPadecimiento')
								  ->select('padecimiento.idPadecimiento', 'padecimiento.Padecimiento')
							      ->where('especialidad_padecimiento.idEspecialidad', 3)
							      ->get();

	        $totalPadecimientos = count($padecimientos);

	        if($totalPadecimientos === 0) {
	        	return null;
	        }

	        foreach ($padecimientos as $padecimientos) {

	        	$padecimiento = new Padecimiento();
	        	$padecimiento->setId($padecimientos->idPadecimiento);
	        	$padecimiento->setPadecimiento($padecimientos->Padecimiento);

	        	$listaPadecimientos[] = $padecimiento;
	        }

	        return $listaPadecimientos;
	    } catch(Exception $e) {
	    	return null;
	    }
	}
}