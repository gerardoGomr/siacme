<?php
namespace Siacme\Pacientes;

/**
 * @author Gerardo Adrián Gómez Ruiz
 */
interface PacientesRepositorioInterface
{
	/**
	 * obtener una lista de pacientes
	 * @param  string $nombres
	 * @return array
	 */
	public function obtenerPacientesPorNombre($nombres);

	/**
	 * guardar paciente
	 * @param  Paciente $paciente
	 * @return bool
	 */
	public function persistir(Paciente $paciente);
}