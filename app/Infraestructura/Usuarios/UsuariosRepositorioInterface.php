<?php
namespace Siacme\Infraestructura\Usuarios;

/**
 * Interface UsuariosRepositorioInterface
 * @package Siacme\Infraestructura\Usuarios
 * @author  Gerardo Adrián Gómez Ruiz
 */
interface UsuariosRepositorioInterface
{
	/**
	 * obtener un usuario
	 * @param  string $username
	 * @return Usuario $usuario
	 */
	public function obtenerUsuarioPorUsername($username);
}