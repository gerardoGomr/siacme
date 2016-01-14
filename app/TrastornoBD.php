<?php
require_once "TrastornoLenguaje.php";

class TrastornoBD
{
	private $query;

	//ver marcas de pastas
	public function verTrastornos()
	{
		$this->query = "SELECT idTrastornoLenguaje, TrastornoLenguaje
						FROM trastorno_lenguaje
						ORDER BY TrastornoLenguaje";
						
		$listaTrastornos = array();
		try
		{
			BaseDatos::conectar();
			$reader = BaseDatos::leer($this->query);
			
			if($reader != null)
			{
				//hay resultados
				do
				{
					$trastorno = new TrastornoLenguaje();
					$trastorno->setId($reader["idTrastornoLenguaje"]);
					$trastorno->setTrastornoLenguaje($reader["TrastornoLenguaje"]);

					$listaTrastornos[] = $trastorno;

				}while($reader = BaseDatos::siguienteRegistro());
				BaseDatos::liberarResultado();
				BaseDatos::desconectar();

				return $listaTrastornos;
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