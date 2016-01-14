<?php
namespace Siacme\Expedientes;

/**
 * @author Gerardo Adrián Gómez Ruiz
 */
interface DienteEstatusRepositorioInterface
{
	/**
	 * obtener una serie de estatus
	 * @return array
	 */
	public function obtenerEstatus();

	/**
	 * obtener un estatus por el id especificado
	 * @param  int $id
	 * @return DienteEstatus
	 */
	public function obtenerEstatusPorId($id);
}