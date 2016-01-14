<?php
namespace Siacme\Expedientes;

/**
 * @author Gerardo Adrián Gómez Ruiz
 * @version 1.0
 */
class ExpedienteOtorrino extends Expediente
{
	public function cargarDatos()
	{
		$expedienteBD = new ExpedienteOtorrinoBD();
		return $expedienteBD->cargarDatos($this);
	}

	public function guardarDatos()
	{
		$expedienteBD = new ExpedienteOtorrinoBD();
		return $expedienteBD->guardarDatos($this);
	}

	public function editarDatos()
	{
		$expedienteBD = new ExpedienteOtorrinoBD();
		return $expedienteBD->editarDatos($this);
	}
}