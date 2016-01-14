<?php
require_once "MarcaPasta.php";

class MarcaPastaBD
{
	private $query;

	//ver marcas de pastas
	public function verMarcas()
	{
		$this->query = "SELECT idMarcaPasta, MarcaPasta
						FROM marca_pasta
						ORDER BY MarcaPasta";
						
		$listaMarcas = array();
		try
		{
			BaseDatos::conectar();
			$reader = BaseDatos::leer($this->query);
			
			if($reader != null)
			{
				//hay resultados
				do
				{
					$marca = new MarcaPasta();
					$marca->setId($reader["idMarcaPasta"]);
					$marca->setMarcaPasta($reader["MarcaPasta"]);

					$listaMarcas[] = $marca;

				}while($reader = BaseDatos::siguienteRegistro());
				BaseDatos::liberarResultado();
				BaseDatos::desconectar();

				return $listaMarcas;
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