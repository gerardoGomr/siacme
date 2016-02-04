<?php
namespace Siacme\Http\Controllers\Consultas;

use Illuminate\Http\Request;

use Siacme\Dominio\Consultas\DientePlan;
use Siacme\Dominio\Consultas\PlanTratamiento;
use Siacme\Dominio\Pacientes\DientePadecimiento;
use Siacme\Http\Requests;
use Siacme\Http\Controllers\Controller;
use Siacme\Infraestructura\Citas\CitasRepositorioInterface;
use Siacme\Infraestructura\Consultas\DienteTratamientosRepositorioInterface;
use Siacme\Infraestructura\Expedientes\ExpedientesRepositorioInterface;
use Siacme\Infraestructura\Pacientes\ComportamientosFranklRepositorioInterface;
use Siacme\Infraestructura\Pacientes\PadecimientosDentalesRepositorioInterface;
use Siacme\Servicios\Consultas\DibujadorPlanTratamiento;
use Siacme\Servicios\Consultas\FabricaConsultasViews;
use Siacme\Servicios\Pacientes\DibujadorOdontogramas;
use Siacme\Dominio\Pacientes\Odontograma;
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
     * @param PadecimientosDentalesRepositorioInterface $padecimientosRepositorio
     * @param Request $request
     * @return \Siacme\Servicios\Consultas\ExpedienteOtorrino
     * @throws \Exception
     */
    public function capturar($idPaciente, $userMedico, ComportamientosFranklRepositorioInterface $comportamientosRepositorio, PadecimientosDentalesRepositorioInterface $padecimientosRepositorio, Request $request)
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
        $request->session()->put('odontograma', $odontograma);

        // generar vista
        return FabricaConsultasViews::construirVista($expediente, $dibujadorOdontograma, $listaComportamientos, $listaPadecimientos);
    }

    /**
     * asignar padecimientos al diente seleccionado y repintar odontograma
     * @param Request $request
     * @param PadecimientosDentalesRepositorioInterface $padecimientosRepositorio
     * @return View
     */
    public function agregaDientePadecimiento(Request $request, PadecimientosDentalesRepositorioInterface $padecimientosRepositorio)
    {
        $numeroDiente = (int)$request->get('diente');
        $odontograma  = $request->session()->get('odontograma');

        $odontograma->diente($numeroDiente)->removerPadecimientos();

        // recorrer los estatus enviados
        foreach ($request->get('padecimientos') as $padecimientos) {
            // alimentar la lista de estatus
            $padecimiento = $padecimientosRepositorio->obtenerPadecimientoPorId($padecimientos);
            $odontograma->diente($numeroDiente)->agregarPadecimiento($padecimiento);
        }

        // guardar odontograma actual en sesión nuevamente
        $odontograma->setRevisado(true);
        $request->session()->put('odontograma', $odontograma);

        return $this->dibujar($request);
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

        return response($dibujadorOdontograma->dibujar());
    }

    /**
     * generar vista para el plan de tratamiento
     * @param Request $request
     * @param DienteTratamientosRepositorioInterface $dienteTratamientosRepositorio
     * @return View
     */
    public function verPlan(Request $request, DienteTratamientosRepositorioInterface $dienteTratamientosRepositorio)
    {
        $odontograma = $request->session()->get('odontograma');
        $odontograma->borrarDientesTratamientos();
        // obtener plan
        if(!is_null($request->session()->get('plan'))) {
            $plan = new PlanTratamiento();
            $request->session()->forget('plan');
        }

        $plan->generarDeOdontograma($odontograma);
        $listaDienteTratamientos = $dienteTratamientosRepositorio->obtenerDienteTratamientos();
        $dibujadorPlan           = new DibujadorPlanTratamiento($plan, $listaDienteTratamientos);

        $request->session()->put('plan', $plan);
        return View::make('consultas.consultas_plan_tratamiento', compact('dibujadorPlan'));
    }

    public function agregarTratamiento(Request $request, DienteTratamientosRepositorioInterface $dienteTratamientosRepositorio)
    {
        $numeroDiente  = (int) $request->get('numeroDiente');
        $idTratamiento = (int) $request->get('idTratamiento');

        $dienteTratamiento = $dienteTratamientosRepositorio->obtenerDienteTratamientoPorId($idTratamiento);
        $plan              = $request->session()->get('plan');

        $plan->diente($numeroDiente)->agregarTratamiento(new DientePlan($dienteTratamiento));

        $listaDienteTratamientos = $dienteTratamientosRepositorio->obtenerDienteTratamientos();
        $dibujadorPlan           = new DibujadorPlanTratamiento($plan, $listaDienteTratamientos);

        $request->session()->put('plan', $plan);

        return $dibujadorPlan->dibujar();
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