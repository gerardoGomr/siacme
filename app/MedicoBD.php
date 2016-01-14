<?php
require_once 'Medico.php';
require_once 'BaseDatos.php';
/**
 * 
 */
class MedicoBD
{	
	//string
	private $query;
	
	public function encontrarPorUsername(Medico $medico)
	{
		$arregloValores = array();
		$arregloTiposDatos = array();
		//encontrar usuario por username y que sea de tipo Asistente
		$this->query = "SELECT * FROM usuario WHERE Username = ? AND idUsuarioTipo = 2";//echo $this->query;exit;
		BaseDatos::conectar();

		$valores = $medico->getUsername();
		$tiposDatos = "s";
		
		$reader = BaseDatos::leer($this->query, $tiposDatos, $valores);
		
		if($reader != null)
		{
			$medico->setNombre($reader["Nombre"]);
			$medico->setPaterno($reader["Paterno"]);
			$medico->setMaterno($reader["Materno"]);
			$medico->setPassword($reader["Passwd"]);
			
			BaseDatos::desconectar();
			return true;
		}
		BaseDatos::desconectar();
		return false;
	}	
	
	public function cargarDatos(Medico $medico)
	{
		$this->query = "SELECT Username, Nombre, Paterno, Materno 
						FROM usuario 
						WHERE Username = ?";//echo $this->query;exit;

		$valores = $medico->getUsername();
		$tiposDatos = "s";

		try
		{
			BaseDatos::conectar();
			$reader = BaseDatos::leer($this->query, $tiposDatos, $valores);
			
			if($reader != null)
			{
				//hay resultados
				$medico->setNombre($reader["Nombre"]);
				$medico->setPaterno($reader["Paterno"]);
				$medico->setMaterno($reader["Materno"]);
				
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
			return null;
		}
	}
}