<?php
namespace Siacme\Servicios\Consultas;

use Siacme\Dominio\Expedientes\Expediente;
use Siacme\Servicios\DibujadorInterface;
use View;

/**
* @author Gerardo Adrián Gómez Ruiz
*/
class FabricaConsultasViews
{
	/**
	 * @param Expediente $expediente
	 * @param DibujadorInterface|null $dibujadorOdontograma
	 * @param null $listaComportamientosFrankl
	 * @param null $listaPadecimientos
	 * @param null $listaRecetas
	 * @param null $listaMedicos
	 * @param null $listaMorfologiasCraneofacial
	 * @param null $listaMorfologiasFacial
	 * @param null $listaConvexividades
	 * @param null $listaAtms
	 * @param null $listaCostoConsultas
	 * @return ExpedienteOtorrino
	 * @throws \Exception
	 */
	public static function construirVista(Expediente $expediente, DibujadorInterface $dibujadorOdontograma = null, $listaComportamientosFrankl = null, $listaPadecimientos = null, $listaRecetas = null, $listaMedicos = null, $listaMorfologiasCraneofacial = null, $listaMorfologiasFacial = null, $listaConvexividades = null, $listaAtms = null, $listaCostosConsultas = null)
	{
		switch ($expediente->getMedico()->getUsername()) {
			case 'johanna.vazquez':
				// odontopediatría
				return View::make('consultas.consultas_odontopediatria_capturar', compact('expediente', 'dibujadorOdontograma', 'listaComportamientosFrankl', 'listaPadecimientos', 'listaRecetas', 'listaMedicos', 'listaMorfologiasCraneofacial', 'listaMorfologiasFacial', 'listaConvexividades', 'listaAtms', 'listaCostosConsultas'));
				break;

			case 1:
				return new ExpedienteOtorrino();
				break;

			default:
				throw new \Exception('Intentando crear una vista inexistente');
				break;
		}
	}
}