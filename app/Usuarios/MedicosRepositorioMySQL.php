<?php
namespace Siacme\Usuarios;

use DB;

/**
 * @author Gerardo Adrián Gómez Ruiz
 * obtener y guardar usuarios de tipo medico en el repositorio MySQL
 */
class MedicosRepositorioMySQL implements UsuariosRepositorioInterface
{
	public function obtenerUsuarioPorUsername($username)
	{
		try {
			$usuario   = new Medico($username);

			$usuarioBD = DB::table('usuario')
							->join('usuario_tipo', 'usuario.idUsuarioTipo', '=', 'usuario_tipo.idUsuarioTipo')
							->join('especialidad', 'usuario.idEspecialidad', '=', 'especialidad.idEspecialidad')
							->select('usuario.Username', 'usuario.Nombre', 'usuario.Paterno', 'usuario.Materno', 'usuario.Passwd', 'usuario.Activo', 'usuario_tipo.idUsuarioTipo', 'usuario_tipo.UsuarioTipo', 'especialidad.idEspecialidad', 'especialidad.Especialidad')
							->where('Username', $username)
							->first();

			if($usuarioBD === null) {
				$usuario->setRegistrado(false);
				return $usuario;
			}

			// construir objetos
			$especialidad = new Especialidad();
			$usuarioTipo  = new UsuarioTipo($usuarioBD->idUsuarioTipo);

			$especialidad->setId($usuarioBD->idEspecialidad);
			$especialidad->setEspecialidad($usuarioBD->Especialidad);

			$usuarioTipo->setUsuarioTipo($usuarioBD->UsuarioTipo);

			// attributes
			$usuario->setPasswd($usuarioBD->Passwd);
			$usuario->setActivo($usuarioBD->Activo);
			$usuario->setNombre($usuarioBD->Nombre);
			$usuario->setPaterno($usuarioBD->Paterno);
			$usuario->setMaterno($usuarioBD->Materno);
			// injected
			$usuario->setUsuarioTipo($usuarioTipo);
			$usuario->setEspecialidad($especialidad);

			return $usuario;

		} catch (Exception $e) {
			echo $e->getMessage();
			return null;
		}
	}
}