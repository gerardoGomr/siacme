<?php
namespace Siacme\Http\Controllers\Pacientes;

use Illuminate\Http\Request;
use Siacme\Dominio\Pacientes\Anexo;
use Siacme\Http\Requests;
use Siacme\Http\Controllers\Controller;
use Siacme\Infraestructura\Usuarios\UsuariosRepositorioInterface;
use Siacme\Servicios\Expedientes\AnexosUploader;
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
     * PacientesController constructor.
     * @param UsuariosRepositorioInterface $usuariosRepositorio
     */
    public function __construct(UsuariosRepositorioInterface $usuariosRepositorio)
    {
        $this->usuariosRepositorio = $usuariosRepositorio;
    }

    /**
     * Mostrar vista para busqueda de pacientes y ver detalles
     * @param $userMedico
     * @param UsuariosRepositorioInterface $usuariosRepositorio
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

    /**
     * ver el detalle de un paciente
     * @param Request $request
     * @param ExpedientesRepositorioInterface $expedientesRepositorio
     * @return \Illuminate\View\View
     */
    public function detalle(Request $request, ExpedientesRepositorioInterface $expedientesRepositorio)
    {
        $idPaciente = (int)base64_decode($request->get('idPaciente'));
        $username   = $request->get('username');

        $medico               = $this->usuariosRepositorio->obtenerUsuarioPorUsername($username);
        $pacientesRepositorio = PacientesRepositorioFactory::crear($medico);
        $paciente             = $pacientesRepositorio->obtenerPacientePorId($idPaciente);
        $expediente           = $expedientesRepositorio->obtenerExpedientePorPacienteMedico($paciente, $medico);

        $anexoUploader = new AnexosUploader($username, $idPaciente);
        $expediente->obtenerAnexos($anexoUploader->asignar());
        return view('pacientes.pacientes_detalle', compact('expediente', 'anexoUploader'));
    }

    /**
     * guardar un anexo del paciente
     * @param Request $request
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response
     */
    public function agregarAnexo(Request $request)
    {
        $anexo = new Anexo($request->get('nombreAnexo'));

        $anexoUploader = new AnexosUploader(base64_decode($request->get('userMedico')), base64_decode($request->get('idPaciente')));
        try {
            $anexoUploader->guardar($request->file('anexo')->getPathName(), $anexo);

            return response('1');
        } catch (\Exception $e) {
            echo $e->getMessage();
            return response('0');
        }
    }

    public function eliminarAnexo(Request $request)
    {
        $idPaciente = (int)base64_decode($request->get('idPaciente'));
        $userMedico = base64_decode($request->get('userMedico'));
        $anexo      = base64_decode($request->get('anexo'));

        $anexoUploader = new AnexosUploader($userMedico, $idPaciente);

        if(!$anexoUploader->eliminar(new Anexo($anexo))) {
            return response('0');
        }

        return response('1');
    }
}
