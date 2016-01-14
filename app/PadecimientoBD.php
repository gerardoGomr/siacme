<?php
require_once "Padecimiento.php";
require_once "Especialidad.php";

class PadecimientoBD
{
	private $query;

	//ver los padecimientos por especialidad
	public function verPadecimientos(Especialidad $especialidad)
	{
		$this->query = "SELECT idPadecimiento, Padecimiento 
						FROM padecimiento 
						WHERE idEspecialidad = ?";
						
		$listaPadecimientos = array();
		try
		{
			BaseDatos::conectar();
			$valores = $especialidad->getId();
			$tiposDatos = "i";

			$reader = BaseDatos::leer($this->query, $tiposDatos, $valores);
			
			if($reader != null)
			{
				//hay resultados
				do
				{
					$padecimiento = new Padecimiento();
					$padecimiento->setId($reader["idPadecimiento"]);
					$padecimiento->setPadecimiento($reader["Padecimiento"]);

					$listaPadecimientos[] = $padecimiento;

				}while($reader = BaseDatos::siguienteRegistro());
				BaseDatos::liberarResultado();
				BaseDatos::desconectar();

				return $listaPadecimientos;
			}
			BaseDatos::liberarResultado();
			BaseDatos::desconectar();
			return null;
		}
		catch(Exception $e)
		{
			mail("gerardo.gomr@gmail.com", "Error en el sistema SIACM", "Error: ".$e->getMessage());
			return null;
		}
	}
}