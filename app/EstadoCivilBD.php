<?php
require_once "EstadoCivil.php";

class EstadoCivilBD
{
	private $query;

	//cargar datos de una especialidad
	public function verEstados()
	{
		$this->query = "SELECT idEstadoCivil, EstadoCivil
						FROM estado_civil 
						ORDER BY EstadoCivil";//echo $this->query;exit;
		$listaEstados = array();
		try
		{
			BaseDatos::conectar();
			$reader = BaseDatos::leer($this->query);
			
			if($reader != null)
			{
				//hay resultados
				do{
					$estadoCivil = new EstadoCivil();
					$estadoCivil->setId($reader["idEstadoCivil"]);
					$estadoCivil->setEstadoCivil($reader["EstadoCivil"]);

					$listaEstados[] = $estadoCivil;
				}while($reader = BaseDatos::siguienteRegistro());

				BaseDatos::liberarResultado();
				BaseDatos::desconectar();
				return $listaEstados;
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