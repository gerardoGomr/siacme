<?php
require_once 'Medico.php';
require_once 'BaseDatos.php';
/**
 * 
 */
class AsistenteBD
{	
	//string
	private $query;
	
	//encontrar usuario por username y que sea de tipo Asistente
	public function encontrarPorUsername(Asistente $asistente)
	{
		$this->query = "SELECT * 
						FROM usuario 
						WHERE Username = ? AND idUsuarioTipo = 3";//echo $this->query;exit;
		try
		{
			BaseDatos::conectar();
			$valores = $asistente->getUsername();
			$tiposDatos = "s";

			$reader = BaseDatos::leer($this->query, $tiposDatos, $valores);
			
			if($reader != null)
			{
				//hay resultados
				$asistente->setNombre($reader["Nombre"]);
				$asistente->setPaterno($reader["Paterno"]);
				$asistente->setMaterno($reader["Materno"]);
				$asistente->setPassword($reader["Passwd"]);
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
	
	//devolver una lista de medicos o ninguno
	public function verMedicosAsiste(Asistente $asistente)	
	{
		$this->query = "SELECT usuario.Username , usuario.Nombre , usuario.Paterno , usuario.Materno
						FROM usuario_asistente INNER JOIN consultorio.usuario ON (usuario_asistente.UserMedico = usuario.Username)
						WHERE  usuario_asistente.UserAsistente = ?";//echo $this->query;exit;
		$listaMedicos = array();
		$valores = $asistente->getUsername();
		$tiposDatos = "s";

		try
		{
			BaseDatos::conectar();
			$reader = BaseDatos::leer($this->query, $tiposDatos, $valores);
			
			if($reader != null)
			{
				//hay resultados
				do
				{
					$medico = new Medico();
					$medico->setUsername($reader["Username"]);
					$medico->setNombre($reader["Nombre"]);
					$medico->setPaterno($reader["Paterno"]);
					$medico->setMaterno($reader["Materno"]);

					$listaMedicos[] = $medico;
				}while($reader = BaseDatos::siguienteRegistro());
				
				BaseDatos::liberarResultado();
				BaseDatos::desconectar();
				return $listaMedicos;
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