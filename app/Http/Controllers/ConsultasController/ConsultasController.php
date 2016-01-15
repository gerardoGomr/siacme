<?php
namespace Siacme\Http\Controllers\ConsultasController;

use Illuminate\Http\Request;

use Siacme\Http\Requests;
use Siacme\Http\Controllers\Controller;
use Siacme\Citas\Cita;
use Siacme\Citas\CitasRepositorioInterface;
use Siacme\Expedientes\FabricaExpedientesRepositorio;
use Siacme\Pacientes\PacientesRepositorioInterface;
use Siacme\Usuarios\EspecialidadesRepositorioInterface;
use Siacme\Consultas\FabricaConsultasViews;
use Siacme\Expedientes\DibujadorOdontogramas;
use Siacme\Expedientes\Odontograma;
use Siacme\Expedientes\DienteEstatusRepositorioInterface;
use View;

class ConsultasController extends Controller
{
    /**
     * repositorio de citas
     * @var CitasRepositorioInterface
     */
    protected $citasRepositorio;

    /**
     * constructor
     * @param CitasRepositorioInterface $citasRepositorio
     */
    public function __construct(CitasRepositorioInterface $citasRepositorio)
    {
        $this->citasRepositorio = $citasRepositorio;
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
     * ver el detalle de la cita
     * @param  Request $request
     * @return View
     */
    public function citaDetalle(Request $request)
    {
        $idCita = base64_decode($request->get('idCita'));

        $cita = new Cita();
        $cita->setId($idCita);

        $this->citasRepositorio->cargarDatos($cita);
        $expedientesRepositorio = FabricaExpedientesRepositorio::construirRepositorio($cita->getMedico()->getEspecialidad());

        $expediente = $expedientesRepositorio->obtenerExpedientePorPaciente($cita->getPaciente());
        // var_dump($expediente);exit;
        return View::make('consultas.consultas_citas_detalle', compact('cita', 'expediente'));
    }

    /**
     * generar vista de captura de consultas de acuerdo a la especialidad
     * @param  int                                $idEspecialidad
     * @param  int                                $idPaciente
     * @param  Request                            $request
     * @param  PacientesRepositorioInterface      $pacientesRepositorio
     * @param  EspecialidadesRepositorioInterface $especialidadesRepositorio
     * @return View
     */
    public function capturar($idEspecialidad, $idPaciente, Request $request, PacientesRepositorioInterface $pacientesRepositorio, EspecialidadesRepositorioInterface $especialidadesRepositorio)
    {
        $idEspecialidad         = base64_decode($idEspecialidad);
        $idPaciente             = base64_decode($idPaciente);

        // obtener la especialidad, expediente y paciente
        $paciente               = $pacientesRepositorio->obtenerPacientePorId($idPaciente);
        $especialidad           = $especialidadesRepositorio->obtenerEspecialidadPorId($idEspecialidad);

        $expedientesRepositorio = FabricaExpedientesRepositorio::construirRepositorio($especialidad);
        $expediente             = $expedientesRepositorio->obtenerExpedientePorPaciente($paciente);

        $odontograma            = new Odontograma();
        $dibujadorOdontograma   = new DibujadorOdontogramas($odontograma);

        // guardar el odontograma creado en la sesión activa para procesamiento
        $request->session()->put('odontograma', $odontograma);

        // generar vista
        return FabricaConsultasViews::construirVista($especialidad, $expediente, $dibujadorOdontograma);
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