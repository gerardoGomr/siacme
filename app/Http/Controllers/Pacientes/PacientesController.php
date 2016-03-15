<?php
namespace Siacme\Http\Controllers\Pacientes;

use Illuminate\Http\Request;
use Siacme\Http\Requests;
use Siacme\Http\Controllers\Controller;
use Siacme\Infraestructura\Usuarios\UsuariosRepositorioInterface;
use Siacme\Servicios\Pacientes\PacientesRepositorioFactory;
use Siacme\Infraestructura\Expedientes\ExpedientesRepositorioInterface;

/**
 * @package Siacme\Http\Controllers\Pacientes;
 * @author Gerardo Adrián Gómez Ruiz
 */
class PacientesController extends Controller
{
    /**
     * @var UsuariosRepositorioInterface
     */
    private $usuariosRepositorio;

    /**
     * constructor
     * @param UsuariosRepositorioInterface
     */
    public function __construct(UsuariosRepositorioInterface $usuariosRepositorio)
    {
        $this->usuariosRepositorio = $usuariosRepositorio;
    }

    /**
     * Mostrar vista para busqueda de pacientes y ver detalles
     * @return View
     */
    public function index($userMedico, UsuariosRepositorioInterface $usuariosRepositorio)
    {
        // obtener el medico
        if(is_null($medico = $this->usuariosRepositorio->obtenerUsuarioPorUsername($userMedico))) {
            return view('error');
        }

        return view('pacientes.pacientes', compact('medico'));
    }

    /**
     * buscar un paciente
     * @param Request $request
     * @return View
     */
    public function buscar(Request $request)
    {
        $dato    = $request->get('txtPaciente');
        $usuario = $request->get('username');

        $medico               = $this->usuariosRepositorio->obtenerUsuarioPorUsername($usuario);
        $pacientesRepositorio = PacientesRepositorioFactory::crear($medico);

        $listaPacientes = $pacientesRepositorio->obtenerPacientesPorNombre($dato);

        return view('pacientes.pacientes_lista', compact('listaPacientes'))->render();
    }

    public function detalle(Request $request, ExpedientesRepositorioInterface $expedientesRepositorio)
    {
        $idPaciente = (int)base64_decode($request->get('idPaciente'));
        $username   = $request->get('username');

        $medico               = $this->usuariosRepositorio->obtenerUsuarioPorUsername($username);
        $pacientesRepositorio = PacientesRepositorioFactory::crear($medico);
        $paciente             = $pacientesRepositorio->obtenerPacientePorId($idPaciente);
        $expediente           = $expedientesRepositorio->obtenerExpedientePorPacienteMedico($paciente, $medico);
        return view('pacientes.pacientes_detalle', compact('expediente'));
    }
}
