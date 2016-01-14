<?php
namespace Siacme\Expedientes;

use Siacme\Expedientes\ExpedienteRepositorioInterface;

interface ExpedientesOdontopediatriaRepositorioInterface extends ExpedienteRepositorioInterface
{
	/**
	 * buscar expedientes dependiendo del nombre a buscar
	 * @param  string $nombreBusqueda
	 * @return array $listaExpedientes or null
	 */
	public function buscarExpedientesPorNombre($nombreBusqueda = '');
}