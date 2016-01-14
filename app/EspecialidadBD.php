<?php
require_once "Especialidad.php";

class EspecialidadBD
{
	private $query;

	//cargar datos de una especialidad
	public function cargarDatos(Especialidad $especialidad)
	{
		$this->query = "SELECT idEspecialidad, Especialidad 
						FROM especialidad 
						WHERE idEspecialidad = ?";//echo $this->query;exit;
		try
		{
			BaseDatos::conectar();
			$valores = $especialidad->getId();
			$tiposDatos = "i";

			$reader = BaseDatos::leer($this->query, $tiposDatos, $valores);
			
			if($reader != null)
			{
				//hay resultados
				$especialidad->setEspecialidad($reader["Especialidad"]);
				
				BaseDatos::liberarResultado();
				BaseDatos::desconectar();
				return true;
			}
			BaseDatos::liberarResultado();
			BaseDatos::desconectar();
			return false;
		}
		catch(Exception $e)
		{
			mail("gerardo.gomr@gmail.com", "Error en el sistema SIACM", "Error: ".$e->getMessage());
			return false;
		}
	}
}