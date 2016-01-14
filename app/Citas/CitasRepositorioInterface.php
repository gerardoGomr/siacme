<?php
namespace Siacme\Citas;

use Siacme\Expedientes\Expediente;

interface CitasRepositorioInterface
{
	/**
	 * persistir una cita en el almacenamiento
	 * @param  Cita   $cita
	 * @return bool
	 */
	public function persistir(Cita $cita);

	/**
	 * asignar un expediente a la cita
	 * @param  Expediente $expediente
	 * @return bool
	 */
	public function guardarExpediente(Cita $cita);

	/**
	 * obtener una lista de citas por médico
	 * @param string $username
	 * @return array
	 */
	public function obtenerCitasPorMedico($username);

	/**
	 * obtener una cita por Id
	 * @param  int $idCita
	 * @return Cita $cita
	 */
	public function cargarDatos(Cita $cita);

	public function actualizaEstatus(Cita $cita);
}