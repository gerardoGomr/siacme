<?php
namespace Siacme\Http\Controllers\Consultas;

use Illuminate\Http\Request;

use Siacme\Dominio\Consultas\DientePlan;
use Siacme\Dominio\Consultas\PlanTratamiento;
use Siacme\Dominio\Consultas\Receta;
use Siacme\Http\Requests;
use Siacme\Http\Controllers\Controller;
use Siacme\Infraestructura\Citas\CitasRepositorioInterface;
use Siacme\Infraestructura\Consultas\DienteTratamientosRepositorioInterface;
use Siacme\Infraestructura\Consultas\MedicosReferenciaRepositorioInterface;
use Siacme\Infraestructura\Consultas\OtrosTratamientosRepositorioInterface;
use Siacme\Infraestructura\Consultas\RecetasRepositorioInterface;
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
     * @param RecetasRepositorioInterface $recetasRepositorio
     * @param MedicosReferenciaRepositorioInterface $medicosRepositorio
     * @return \Siacme\Servicios\Consultas\ExpedienteOtorrino
     * @throws \Exception
     */
    public function capturar($idPaciente, $userMedico, ComportamientosFranklRepositorioInterface $comportamientosRepositorio, PadecimientosDentalesRepositorioInterface $padecimientosRepositorio, Request $request, RecetasRepositorioInterface $recetasRepositorio, MedicosReferenciaRepositorioInterface $medicosRepositorio)
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
        $listaRecetas         = $recetasRepositorio->obtenerRecetas();
        $listaMedicos         = $medicosRepositorio->obtenerMedicosReferencia();

        // guardar el odontograma creado en la sesión activa para procesamiento
        $request->session()->put('odontograma', $odontograma);

        // generar vista
        return FabricaConsultasViews::construirVista($expediente, $dibujadorOdontograma, $listaComportamientos, $listaPadecimientos, $listaRecetas, $listaMedicos);
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
     * @param OtrosTratamientosRepositorioInterface $otrosTratamientosRepositorio
     * @return View
     */
    public function verPlan(Request $request, DienteTratamientosRepositorioInterface $dienteTratamientosRepositorio, OtrosTratamientosRepositorioInterface $otrosTratamientosRepositorio)
    {
        $odontograma = $request->session()->get('odontograma');
        if(is_null($request->session()->get('plan'))) {
            $odontograma->borrarDientesTratamientos();

            // obtener primeros dos otros tratamientos para el plan
            $otroTratamiento1 = $otrosTratamientosRepositorio->obtenerOtroTratamientoPorId(1);
            $otroTratamiento2 = $otrosTratamientosRepositorio->obtenerOtroTratamientoPorId(2);

            // obtener plan
            $plan = new PlanTratamiento();
            $plan->agregarOtroTratamiento($otroTratamiento1->getId(), $otroTratamiento1);
            $plan->agregarOtroTratamiento($otroTratamiento2->getId(), $otroTratamiento2);

            $plan->generarDeOdontograma($odontograma);
        } else {
            $plan = $request->session()->get('plan');
        }

        $listaDienteTratamientos = $dienteTratamientosRepositorio->obtenerDienteTratamientos();
        $listaOtrosTratamientos  = $otrosTratamientosRepositorio->obtenerOtrosTratamientos();
        $dibujadorPlan           = new DibujadorPlanTratamiento($plan, $listaDienteTratamientos);

        $request->session()->put('plan', $plan);
        return View::make('consultas.consultas_plan_tratamiento', compact('dibujadorPlan', 'listaOtrosTratamientos'));
    }

    /**
     * agregar nuevo tratamiento al plan actual
     * @param Request $request
     * @param DienteTratamientosRepositorioInterface $dienteTratamientosRepositorio
     * @return string
     */
    public function agregarTratamiento(Request $request, DienteTratamientosRepositorioInterface $dienteTratamientosRepositorio)
    {
        $numeroDiente   = (int)$request->get('numeroDiente');
        $idTratamiento  = (int)$request->get('idTratamiento');
        $numeroElemento = (int)$request->get('numeroElemento');

        $dienteTratamiento = $dienteTratamientosRepositorio->obtenerDienteTratamientoPorId($idTratamiento);
        $plan              = $request->session()->get('plan');

        $plan->diente($numeroDiente)->agregarTratamiento($numeroElemento, new DientePlan($dienteTratamiento));

        $listaDienteTratamientos = $dienteTratamientosRepositorio->obtenerDienteTratamientos();
        $dibujadorPlan           = new DibujadorPlanTratamiento($plan, $listaDienteTratamientos);

        $request->session()->put('plan', $plan);

        return $dibujadorPlan->dibujar();
    }

    /**
     * agregar nuevo "otro tratamiento"
     * @param Request $request
     * @param DienteTratamientosRepositorioInterface $dienteTratamientosRepositorio
     * @param OtrosTratamientosRepositorioInterface $otrosTratamientosRepositorio
     * @return string
     */
    public function agregarOtroTratamiento(Request $request, DienteTratamientosRepositorioInterface $dienteTratamientosRepositorio, OtrosTratamientosRepositorioInterface $otrosTratamientosRepositorio)
    {
        $idOtroTratamiento = (int)$request->get('idOtroTratamiento');
        $plan              = $request->session()->get('plan');
        $otroTratamiento   = $otrosTratamientosRepositorio->obtenerOtroTratamientoPorId($idOtroTratamiento);

        $plan->agregarOtroTratamiento($otroTratamiento->getId(), $otroTratamiento);

        $listaDienteTratamientos = $dienteTratamientosRepositorio->obtenerDienteTratamientos();
        $dibujadorPlan           = new DibujadorPlanTratamiento($plan, $listaDienteTratamientos);

        $request->session()->put('plan', $plan);

        return $dibujadorPlan->dibujar();
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response
     */
    public function agregarReceta(Request $request)
    {
        $idReceta = $request->get('receta');
        $receta   = base64_decode($request->get('txtReceta'));

        $receta = new Receta($idReceta, $receta);

        $request->session()->put('receta', $receta);

        return response(1);
    }
}