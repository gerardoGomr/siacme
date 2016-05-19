<?php
namespace Siacme\Infraestructura\Usuarios;

use DB;
use Siacme\Dominio\Usuarios\Usuario;
use Siacme\Dominio\Usuarios\Medico;
use Siacme\Dominio\Usuarios\Especialidad;
use Siacme\Dominio\Usuarios\UsuarioTipo;

/**
 * Class UsuariosRepositorioMySQL
 * @package Siacme\Infraestructura\Usuarios
 * @author  Gerardo Adrián Gómez Ruiz
 */
class UsuariosRepositorioLaravelMySQL implements UsuariosRepositorioInterface
{
	/**
	 * obtener un usuario por username
	 * @param string $username
	 * @return null|Usuario
	 */
	public function obtenerUsuarioPorUsername($username)
	{
		try {
			$usuarioBD = DB::table('usuario')
				->join('usuario_tipo', 'usuario.idUsuarioTipo', '=', 'usuario_tipo.idUsuarioTipo')
				->join('especialidad', 'usuario.idEspecialidad', '=', 'especialidad.idEspecialidad')
				->where('Username', $username)
				->first();

			if(count($usuarioBD) === 0) {
				return null;
			}

			if($usuarioBD->idEspecialidad === 1) {
				$usuario = new Usuario($username);
			} else {
				$usuario = new Medico($username);
				$usuario->setEspecialidad(new Especialidad($usuarioBD->idEspecialidad, $usuarioBD->Especialidad));
			}

			// construir objetos
			$usuarioTipo = new UsuarioTipo($usuarioBD->idUsuarioTipo, $usuarioBD->UsuarioTipo);
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

	public function obtenerUsuarios($datos = '')
	{
		$usuarios = [];
		try {
			$usuarioBD = DB::table('usuario')
				->join('usuario_tipo', 'usuario.idUsuarioTipo', '=', 'usuario_tipo.idUsuarioTipo')
				->join('especialidad', 'usuario.idEspecialidad', '=', 'especialidad.idEspecialidad')
				->where('Username', 'LIKE', "%$datos%")
				->orWhere(DB::raw("REPLACE(CONCAT(Nombre, Paterno, Materno), ' ', '')"), 'LIKE', "%$datos%")
				->orWhere(DB::raw("REPLACE(CONCAT(Paterno, Materno, Nombre), ' ', '')"), 'LIKE', "%$datos%")
				->get();

			if(count($usuarioBD) === 0) {
				return null;
			}

			foreach ($usuarioBD as $usuarioBD) {
				if($usuarioBD->idEspecialidad === 1) {
					$usuario = new Usuario($usuarioBD->Username);
				} else {
					$usuario = new Medico($usuarioBD->Username);
					$usuario->setEspecialidad(new Especialidad($usuarioBD->idEspecialidad, $usuarioBD->Especialidad));
				}

				// construir objetos
				$usuarioTipo = new UsuarioTipo($usuarioBD->idUsuarioTipo, $usuarioBD->UsuarioTipo);
				$usuario->setPasswd($usuarioBD->Passwd);
				$usuario->setActivo($usuarioBD->Activo);
				$usuario->setNombre($usuarioBD->Nombre);
				$usuario->setPaterno($usuarioBD->Paterno);
				$usuario->setMaterno($usuarioBD->Materno);
				$usuario->setRegistrado(true);
				// injected
				$usuario->setUsuarioTipo($usuarioTipo);

				$usuarios[] = $usuario;
			}

			return $usuarios;

		} catch (Exception $e) {
			echo $e->getMessage();
			return null;
		}
	}
}