<?php
namespace Siacme\Http\Controllers\Consultas;

use Illuminate\Http\Request;

use Siacme\Http\Requests;
use Siacme\Http\Controllers\Controller;
use Siacme\Infraestructura\Citas\CitasRepositorioInterface;
use Siacme\Infraestructura\Expedientes\ExpedientesRepositorioInterface;
use Siacme\Infraestructura\Pacientes\ComportamientosFranklRepositorioInterface;
use Siacme\Infraestructura\Pacientes\PadecimientosDentalesRepositorioInterface;
use Siacme\Servicios\Consultas\FabricaConsultasViews;
use Siacme\Servicios\Pacientes\DibujadorOdontogramas;
use Siacme\Dominio\Pacientes\Odontograma;
use Siacme\Expedientes\DienteEstatusRepositorioInterface;
use Siacme\Infraestructura\Usuarios\UsuariosRepositorioInterface;
use Siacme\Servicios\Pacientes\PacientesRepositorioFactory;
use View;

class ConsultasController extends Controller
{
    /**
     * repositorio de citas
     * @var CitasRepositorioInterface
     */
    protected $citasRepositorio;

    /**
     * @var UsuariosRepositorioInterface
     */
    protected $usuariosRepositorio;

    /**
     * @var ExpedientesRepositorioInterface
     */
    protected $expedientesRepositorio;

    /**
     * ConsultasController constructor.
     * @param CitasRepositorioInterface $citasRepositorio
     * @param UsuariosRepositorioInterface $usuariosRepositorio
     * @param ExpedientesRepositorioInterface $expedientesRepositorio
     */
    public function __construct(CitasRepositorioInterface $citasRepositorio, UsuariosRepositorioInterface $usuariosRepositorio, ExpedientesRepositorioInterface $expedientesRepositorio)
    {
        $this->citasRepositorio       = $citasRepositorio;
        $this->usuariosRepositorio    = $usuariosRepositorio;
        $this->expedientesRepositorio = $expedientesRepositorio;
    }

    /**
     * obtener la lista de citas del medico seleccionado
     * por default las del día
     * @param string $username
     * @return Response
     */
    public function index($username)
    {
        $listaCitas = $this->citasRepositorio->obtenerCitasPorMedico($username, date('d/m/y'));

        return view('consultas.consultas', compact('listaCitas', 'username'));
    }

    /**
     * ver las citas del día especificado
     * @param  Request $request
     * @return View
     */
    public function verCitasDelDia(Request $request)
    {
        $txtFecha = $request->get('txtFecha');
        $username = $request->get('username');

        $listaCitas = $this->citasRepositorio->obtenerCitasPorMedico($username, $txtFecha);

        return View::make('consultas.consultas_lista_citas', compact('listaCitas'));
    }

    /**
     * @param \Illuminate\Http\Request                                            $request
     * @param \Siacme\Infraestructura\Expedientes\ExpedientesRepositorioInterface $expedientesRepositorio
     * @return mixed
     */
    public function citaDetalle(Request $request,ExpedientesRepositorioInterface $expedientesRepositorio)
    {
        $idCita     = base64_decode($request->get('idCita'));
        $cita       = $this->citasRepositorio->obtenerCitaPorId($idCita);
        $expediente = $expedientesRepositorio->obtenerExpedientePorPacienteMedico($cita->getPaciente(), $cita->getMedico());

        return View::make('consultas.consultas_citas_detalle', compact('cita', 'expediente'));
    }

    /**
     * @param $idPaciente
     * @param $userMedico
     * @param ComportamientosFranklRepositorioInterface $comportamientosRepositorio
     * @return View
     * @throws \Exception
     */
    public function capturar($idPaciente, $userMedico, ComportamientosFranklRepositorioInterface $comportamientosRepositorio, PadecimientosDentalesRepositorioInterface $padecimientosRepositorio)
    {
        $idPaciente = (int)base64_decode($idPaciente);
        $userMedico = base64_decode($userMedico);

        // obtener la especialidad, expediente y paciente
        $medico               = $this->usuariosRepositorio->obtenerUsuarioPorUsername($userMedico);
        $pacientesRepositorio = PacientesRepositorioFactory::crear($medico);
        $paciente             = $pacientesRepositorio->obtenerPacientePorId($idPaciente);
        $expediente           = $this->expedientesRepositorio->obtenerExpedientePorPacienteMedico($paciente, $medico);
        $odontograma          = new Odontograma();
        $dibujadorOdontograma = new DibujadorOdontogramas($odontograma);
        $listaComportamientos = $comportamientosRepositorio->obtenerComportamientos();
        $listaPadecimientos   = $padecimientosRepositorio->obtenerPadecimientos();

        // guardar el odontograma creado en la sesión activa para procesamiento
        //$request->session()->put('odontograma', $odontograma);

        // generar vista
        return FabricaConsultasViews::construirVista($expediente, $dibujadorOdontograma, $listaComportamientos, $listaPadecimientos);
    }

    /**
     * generar vista de selección de estatus dental
     * @param  int $numeroDiente
     * @return View
     */
    public function seleccionEstatus($numeroDiente, DienteEstatusRepositorioInterface $dienteEstatusRepositorio)
    {
        $listaDientesEstatus = $dienteEstatusRepositorio->obtenerEstatus();
        return View::make('consultas.consultas_odontograma_estatus_diente', compact('numeroDiente', 'listaDientesEstatus'));
    }

    /**
     * asignar los estatus seleccionados para el diente especificado
     * @param  Request $request
     * @return Response
     */
    public function asignarEstatusDental(Request $request, DienteEstatusRepositorioInterface $dienteEstatusRepositorio)
    {
        $numeroDiente = (int)base64_decode($request->get('diente'));
        $listaEstatus = array();

        // recorrer los estatus enviados
        foreach ($request->get('estatus') as $estatus) {
            // alimentar la lista de estatus
            $listaEstatus[] = $dienteEstatusRepositorio->obtenerEstatusPorId($estatus);
        }

        // recuperar odontograma actual
        $odontograma = $request->session()->get('odontograma');
        $odontograma->diente($numeroDiente)->setListaEstatus($listaEstatus);
        $request->session()->put('odontograma', $odontograma);
    }

    /**
     * volver a dibujar odontograma
     * @param  Request $request
     * @return View
     */
    public function dibujar(Request $request)
    {
        $odontograma          = $request->session()->get('odontograma');
        $dibujadorOdontograma = new DibujadorOdontogramas($odontograma);

        return View::make('consultas.consultas_odontopediatria_odontograma', compact('dibujadorOdontograma'));
    }

    /**
     * capturar receta
     * @return View
     */
    public function capturaReceta()
    {
        return View::make('consultas.consultas_receta_agregar');
    }
}