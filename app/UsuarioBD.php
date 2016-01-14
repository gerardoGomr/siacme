<?php
namespace Siacme;

use DB;

class UsuarioBD
{
	public function cargarUsuarioPorUsername($username)
	{
		try {
			$usuarioBD = DB::table('usuario')
							->join('usuario_tipo', 'usuario.idUsuarioTipo', '=', 'usuario_tipo.idUsuarioTipo')
							->select('usuario.Username', 'usuario.Nombre', 'usuario.Paterno', 'usuario.Materno', 'usuario.Passwd', 'usuario.Activo', 'usuario_tipo.idUsuarioTipo', 'usuario_tipo.UsuarioTipo')
							->where('Username', $username)
							->first();

			if($usuarioBD === null) {
				return null;
			}

			// construir objetos
			$usuario     = new Usuario($username);
			$usuarioTipo = new UsuarioTipo($usuarioBD->idUsuarioTipo);

			$usuarioTipo->setUsuarioTipo($usuarioBD->UsuarioTipo);
			// attributes
			$usuario->setPasswd($usuarioBD->Passwd);
			$usuario->setActivo($usuarioBD->Activo);
			$usuario->setNombre($usuarioBD->Nombre);
			$usuario->setPaterno($usuarioBD->Paterno);
			$usuario->setMaterno($usuarioBD->Materno);
			// injected
			$usuario->setUsuarioTipo($usuarioTipo);

			return $usuario;

		} catch (Exception $e) {
			echo $e->getMessage();
			return null;
		}
	}

	public function encontrarPorUsername(Usuario $usuario)
	{
		//sanitizar los atributos del objeto
		foreach ($usuario as $indice => $valor)
		{
			//sanitizando
			$usuario[$indice] = $usuario->limpiarValores($valor);
		}
		//encontrar usuario por username
		$this->query = "SELECT * FROM usuario WHERE Username = '".$usuario->getUsername()."'";
		BaseDatos::conectar();
		$reader = BaseDatos::leer($this->query);

		if($reader != null)
		{
			$usuario->setNombre($reader["Nombre"]);
			$usuario->setPaterno($reader["Paterno"]);
			$usuario->setMaterno($reader["Materno"]);
			$usuario->setPassword($reader["Pass"]);

			BaseDatos::desconectar();
			return true;
		}
		BaseDatos::desconectar();
		return false;
	}

	public function verUsuarios()
	{
		//devolver una lista de usuarios
		$listaUsuarios = array();
		$this->query = "SELECT Username, Pass, Nombre, Paterno, Materno, FechaAlta, UltimaModificacion FROM usuario ORDER BY Nombre";
		BaseDatos::conectar();
		$reader = BaseDatos::leer($this->query);

		if($reader != null)
		{
			do
			{
				$usuario = new Usuario();
				$usuario->setUsername($reader["Username"]);
				$usuario->setNombre($reader["Nombre"]);
				$usuario->setPaterno($reader["Paterno"]);
				$usuario->setMaterno($reader["Materno"]);
				$usuario->setPassword($reader["Pass"]);
				$usuario->setFechaAlta($reader["FechaAlta"]);

				$listaUsuarios[] = $usuario;
			}while($reader = BaseDatos::Next());

			BaseDatos::desconectar();
			return $listaUsuarios;
		}
		BaseDatos::desconectar();
		return false;
	}

	public function guardar(Usuario $usuario)
	{
		//sanitizar los atributos del objeto
		foreach ($usuario as $indice => $valor)
		{
			//sanitizando
			$usuario[$indice] = $usuario->limpiarValores($valor);
		}
		//guardar en la base de datos
		$this->query = "INSERT INTO usuario (Username, Pass, Nombre, Paterno, Materno, FechaAlta, UltimaModificacion) VALUES ('".$usuario->getUsername()."', MD5('".$usuario->getPassword()."'), '".$usuario->getNombre()."', '".$usuario->getPaterno()."', '".$usuario->getMaterno()."', NOW(), NOW())";
		BaseDatos::conectar();
		BaseDatos::insertar($this->query);
		BaseDatos::desconectar();
	}

	public function buscarUsuario(Usuario $usuario)
	{
		$queryOpcional = "";

		if($usuario->getUsername() != null)
			$queryOpcional .= " AND Username LIKE '%".$usuario->getUsername()."%'";

		if($usuario->getNombre() != null)
			$queryOpcional .= " AND Nombre LIKE '%".$usuario->getNombre()."%'";

		if($usuario->getPaterno() != null)
			$queryOpcional .= " AND Paterno LIKE '%".$usuario->getPaterno()."%'";

		if($usuario->getMaterno() != null)
			$queryOpcional .= " AND Materno LIKE '%".$usuario->getMaterno()."%'";

		//devolver una lista de usuarios
		$listaUsuarios = array();
		$this->query = "SELECT Username, Pass, Nombre, Paterno, Materno, FechaAlta, UltimaModificacion FROM usuario WHERE Username IS NOT NULL ".$queryOpcional." ORDER BY Nombre";
		BaseDatos::conectar();
		$reader = BaseDatos::leer($this->query);

		if($reader != null)
		{
			do
			{
				$usuario = new Usuario();
				$usuario->setUsername($reader["Username"]);
				$usuario->setNombre($reader["Nombre"]);
				$usuario->setPaterno($reader["Paterno"]);
				$usuario->setMaterno($reader["Materno"]);
				$usuario->setPassword($reader["Pass"]);
				$usuario->setFechaAlta($reader["FechaAlta"]);

				$listaUsuarios[] = $usuario;
			}while($reader = BaseDatos::Next());

			BaseDatos::desconectar();
			return $listaUsuarios;
		}
		BaseDatos::desconectar();
		return false;
	}

	public function cargar(Usuario $usuario)
	{
		//sanitizar los atributos del objeto
		foreach ($usuario as $indice => $valor)
		{
			//sanitizando
			$usuario[$indice] = $usuario->limpiarValores($valor);
		}
		//guardar en la base de datos
		$this->query = "SELECT Username, Pass, Nombre, Paterno, Materno, FechaAlta, UltimaModificacion FROM usuario WHERE Username = '".$usuario->getUsername()."'";
		BaseDatos::conectar();
		$reader = BaseDatos::leer($this->query);
		if($reader != null)
		{
			$usuario->setPassword($reader["Pass"]);
			$usuario->setNombre($reader["Nombre"]);
			$usuario->setPaterno($reader["Paterno"]);
			$usuario->setMaterno($reader["Materno"]);
		}
		BaseDatos::desconectar();
	}

	public function editar(Usuario $usuario)
	{
		//sanitizar los atributos del objeto
		foreach ($usuario as $indice => $valor)
		{
			//sanitizando
			$usuario[$indice] = $usuario->limpiarValores($valor);
		}
		//guardar en la base de datos
		$this->query = "UPDATE usuario SET Nombre = '".$usuario->getNombre()."', Paterno = '".$usuario->getPaterno()."', Materno = '".$usuario->getMaterno()."', UltimaModificacion = NOW() WHERE Username = '".$usuario->getUsername()."'";
		BaseDatos::conectar();
		BaseDatos::insertar($this->query);
		BaseDatos::desconectar();
	}
}