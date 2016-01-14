<?php
require_once "Religion.php";

class ReligionBD
{
	private $query;

	//cargar datos de una especialidad
	public function verReligiones()
	{
		$this->query = "SELECT idReligion, Religion
						FROM religion 
						ORDER BY Religion";//echo $this->query;exit;
		$listaReligion = array();
		try
		{
			BaseDatos::conectar();
			$reader = BaseDatos::leer($this->query);
			
			if($reader != null)
			{
				//hay resultados
				do{
					$religion = new Religion();
					$religion->setId($reader["idReligion"]);
					$religion->setReligion($reader["Religion"]);

					$listaReligion[] = $religion;
				}while($reader = BaseDatos::siguienteRegistro());

				BaseDatos::liberarResultado();
				BaseDatos::desconectar();
				return $listaReligion;
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