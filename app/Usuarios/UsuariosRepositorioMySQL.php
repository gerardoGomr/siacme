<?php
namespace Siacme\Usuarios;

use DB;

class UsuariosRepositorioMySQL implements UsuariosRepositorioInterface
{
	public function obtenerUsuarioPorUsername($username)
	{
		try {
			$usuario   = new Usuario($username);
			$usuarioBD = DB::table('usuario')
							->join('usuario_tipo', 'usuario.idUsuarioTipo', '=', 'usuario_tipo.idUsuarioTipo')
							->select('usuario.Username', 'usuario.Nombre', 'usuario.Paterno', 'usuario.Materno', 'usuario.Passwd', 'usuario.Activo', 'usuario_tipo.idUsuarioTipo', 'usuario_tipo.UsuarioTipo')
							->where('Username', $username)
							->first();

			if($usuarioBD === null) {
				$usuario->setRegistrado(false);

				return $usuario;
			}

			// construir objetos
			$usuarioTipo = new UsuarioTipo($usuarioBD->idUsuarioTipo);

			$usuarioTipo->setUsuarioTipo($usuarioBD->UsuarioTipo);
			// attributes
			$usuario->setPasswd($usuarioBD->Passwd);
			$usuario->setActivo($usuarioBD->Activo);
			$usuario->setNombre($usuarioBD->Nombre);
			$usuario->setPaterno($usuarioBD->Paterno);
			$usuario->setMaterno($usuarioBD->Materno);
			$usuario->setRegistrado(true);
			// injected
			$usuario->setUsuarioTipo($usuarioTipo);

			return $usuario;

		} catch (Exception $e) {
			echo $e->getMessage();
			return null;
		}
	}
}