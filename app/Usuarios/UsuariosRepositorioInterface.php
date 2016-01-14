<?php
namespace Siacme\Usuarios;

interface UsuariosRepositorioInterface
{
	/**
	 * obtener un usuario
	 * @param  string $username
	 * @return Usuario $usuario
	 */
	public function obtenerUsuarioPorUsername($username);
}