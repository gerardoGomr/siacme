<?php
require_once 'Usuario.php';
require_once 'AsistenteBD.php';

class Asistente extends Usuario
{
	//lista doctores;
	private $listaDoctores = array();

	//Override
	public function existeUsuario()
	{
		//verificar la existencia del usuario en la base de datos	
		$usuarioBD = new AsistenteBD();
		//print_r($this->usuarioBD);exit();
		if($usuarioBD->encontrarPorUsername($this))
		{
			//usuario existe en la base de datos
			return true;
		}
		return false;
	}

	public function cerrarSesion()
	{
		//cerrar sesion del usuario
		$_SESSION["objAsistente"] = null;
		unset($_SESSION["objAsistente"]);
	}

	public function verMedicosAsiste()
	{
		$usuarioBD = new AsistenteBD();
		return $usuarioBD->verMedicosAsiste($this);
	}
}