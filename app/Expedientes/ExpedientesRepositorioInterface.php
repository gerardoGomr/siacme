<?php
namespace Siacme\Expedientes;

interface ExpedientesRepositorioInterface
{
	/**
	* guardar o editar el expediente
	* dependiendo si existe o no
	* su idExpediente
	* @param Expediente $expediente
	* @return bool
	*/
	public function persistir(Expediente $expediente);
}