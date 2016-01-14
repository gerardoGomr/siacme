<?php
require_once "Escolaridad.php";

class EscolaridadBD
{
	private $query;

	//cargar datos de una especialidad
	public function verEscolaridades()
	{
		$this->query = "SELECT idEscolaridad, Escolaridad
						FROM escolaridad 
						ORDER BY Escolaridad";//echo $this->query;exit;
		$listaEscolaridad = array();
		try
		{
			BaseDatos::conectar();
			$reader = BaseDatos::leer($this->query);
			
			if($reader != null)
			{
				//hay resultados
				do{
					$escolaridad = new Escolaridad();
					$escolaridad->setId($reader["idEscolaridad"]);
					$escolaridad->setEscolaridad($reader["Escolaridad"]);

					$listaEscolaridad[] = $escolaridad;
				}while($reader = BaseDatos::siguienteRegistro());

				BaseDatos::liberarResultado();
				BaseDatos::desconectar();
				return $listaEscolaridad;
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