<?php
namespace Siacme\Http\Controllers\Usuarios;

use Illuminate\Http\Request;
use Siacme\Http\Controllers\Controller;
use Siacme\Infraestructura\Usuarios\UsuariosRepositorioInterface;

/**
 * Class UsuariosController
 * @package Siacme\Http\Controllers\Usuarios
 * @author Gerardo Adrián Gómez Ruiz
 */
class UsuariosController extends Controller
{
    /**
     * mostrar pagina login
     * @return View
     */
    public function index()
    {
        return view('usuarios.usuarios');
    }

    /**
     * @param  Request $request
     * @param  UsuariosRepositorioInterface $usuariosRepositorio
     * @return response()
     */
    public function buscar(Request $request, UsuariosRepositorioInterface $usuariosRepositorio)
    {
        $nombre   = $request->get('nombre');
        $usuarios = $usuariosRepositorio->obtenerUsuarios($nombre);

        $respuesta = [
            'contenido' => base64_encode(view('usuarios.usuarios_busqueda_resultados', compact('usuarios'))->render()),
            'resultado' => 'OK'
        ];

        return response()->json($respuesta);
    }
}
