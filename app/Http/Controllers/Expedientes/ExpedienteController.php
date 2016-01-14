<?php
namespace Siacme\Http\Controllers\Expedientes;

use Illuminate\Http\Request;
use Siacme\Dominio\Expedientes\Expediente;
use Siacme\Dominio\Pacientes\FotografiaPaciente;
use Siacme\Dominio\Pacientes\Paciente;
use Siacme\Http\Requests;
use Siacme\Http\Controllers\Controller;
use Siacme\Infraestructura\Expedientes\ExpedientesRepositorioInterface;
use Siacme\Infraestructura\Pacientes\MarcaPastaRepositorioInterface;
use Siacme\Infraestructura\Pacientes\PadecimientoRepositorioInterface;
use Siacme\Infraestructura\Pacientes\TrastornoRepositorioInterface;
use Siacme\Infraestructura\Usuarios\UsuariosRepositorioInterface;
use Siacme\Pacientes\PacientesRepositorioInterface;
use Siacme\Servicios\Expedientes\FabricaExpedientesVistas;
use Siacme\Servicios\Pacientes\PacientesFactory;
use Siacme\Servicios\Pacientes\PacientesRepositorioFactory;
use Siacme\Usuarios\Especialidad;
use View;

/**
 * @author Gerardo Adrián Gómez Ruiz
 * @version 1.0
 */

class ExpedienteController extends Controller
{
	public function __construct()
	{

	}

	/**
	 * @param                              $idPaciente
	 * @param                              $userMedico
	 * @param UsuariosRepositorioInterface $usuariosRepositorio
	 * @return mixed
	 */
	public function ver($idPaciente, $userMedico, UsuariosRepositorioInterface $usuariosRepositorio, ExpedientesRepositorioInterface $expedientesRepositorio)
	{
		$idPaciente           = (int)base64_decode($idPaciente);
		$userMedico           = base64_decode($userMedico);
		$medico               = $usuariosRepositorio->obtenerUsuarioPorUsername($userMedico);
		$pacientesRepositorio = PacientesRepositorioFactory::crear($medico);
		$paciente             = $pacientesRepositorio->obtenerPacientePorId($idPaciente);
		$expediente           = $expedientesRepositorio->obtenerExpedientePorPacienteMedico($paciente, $medico);
		return FabricaExpedientesVistas::construirVista($paciente, $medico, $expediente);

	}

	/**
	 * @param string                           $idPaciente
	 * @param string                           $userMedico
	 * @param PadecimientoRepositorioInterface $padecimientosRepositorio
	 * @param TrastornoRepositorioInterface    $trastornosRepositorio
	 * @param MarcaPastaRepositorioInterface   $pastasRepositorio
	 * @param UsuariosRepositorioInterface     $usuariosRepositorio
	 * @param ExpedientesRepositorioInterface  $expedientesRepositorio
	 * @return \Siacme\Servicios\Expedientes\ExpedienteOtorrino
	 * @throws \Exception
	 */
	public function index($idPaciente, $userMedico, PadecimientoRepositorioInterface $padecimientosRepositorio, TrastornoRepositorioInterface $trastornosRepositorio, MarcaPastaRepositorioInterface $pastasRepositorio, UsuariosRepositorioInterface $usuariosRepositorio, ExpedientesRepositorioInterface $expedientesRepositorio)
	{
		$idPaciente           = (int)base64_decode($idPaciente);
		$userMedico           = base64_decode($userMedico);
		$medico               = $usuariosRepositorio->obtenerUsuarioPorUsername($userMedico);
		$pacientesRepositorio = PacientesRepositorioFactory::crear($medico);
		$paciente             = $pacientesRepositorio->obtenerPacientePorId($idPaciente);
		$expediente           = $expedientesRepositorio->obtenerExpedientePorPacienteMedico($paciente, $medico);
		$listaPadecimientos   = $padecimientosRepositorio->obtenerPadecimientos();
		$listaTrastornos      = $trastornosRepositorio->obtenerTrastornos();
		$listaMarcas          = $pastasRepositorio->obtenerMarcaPastas();

		return FabricaExpedientesVistas::construirVista($paciente, $medico, $expediente, $listaPadecimientos, $listaTrastornos, $listaMarcas);
	}

	/**
	 * @param Request $request
	 * @param UsuariosRepositorioInterface $usuariosRepositorio
	 * @param ExpedientesRepositorioInterface $expedientesRepositorio
	 * @return \Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response
	 */
	public function agregarEditarExpediente(Request $request, UsuariosRepositorioInterface $usuariosRepositorio, ExpedientesRepositorioInterface $expedientesRepositorio)
	{
		$idPaciente           = (int)base64_decode($request->get('idPaciente'));
		$userMedico           = base64_decode($request->get('userMedico'));
		$medico               = $usuariosRepositorio->obtenerUsuarioPorUsername($userMedico);
		$pacientesRepositorio = PacientesRepositorioFactory::crear($medico);
		$paciente             = $pacientesRepositorio->obtenerPacientePorId($idPaciente);
		$expediente           = $expedientesRepositorio->obtenerExpedientePorPacienteMedico($paciente, $medico);

		// alimentar de Http Post
		PacientesFactory::alimentarDeHttp($request, $paciente, $medico);

		// persistir
		if(!($pacientesRepositorio->persistir($paciente))) {
			return response(0);
		}

		// generar expediente
        if(is_null($expediente)) {
			$expediente = new Expediente();
			$expediente->setMedico($medico);
			$expediente->setPaciente($paciente);
			$expediente->setPrimeraVez(true);
			$expedientesRepositorio->persistir($expediente);
		}

		// éxito
		return response(1);
	}

	/**
	 * firmar expediente y cambiar estatus a cita
	 * @param  int $idExpediente
	 * @return response
	 */
	public function firmar(Request $request)
	{
		// parámetros enviados
		$idCita       = base64_decode($request->get('idCita'));
		$idExpediente = base64_decode($request->get('idExpediente'));

		$cita = new Cita();
		$cita->setId($idCita);

		$this->citasRepositorio->cargarDatos($cita);

		// obtener expediente
		$expediente = FabricaExpediente::construirExpediente($cita->getMedico()->getEspecialidad());
		$expediente->setId($idExpediente);
		$expedienteRepositorio = FabricaExpedientesRepositorio::construirRepositorio($cita->getMedico()->getEspecialidad());
		$expedienteRepositorio->obtenerExpedientePorExpediente($expediente);

		$expediente->setFirma(rand());
		$expediente->necesitaFirma(false);

		if(!$expedienteRepositorio->persistir($expediente)) {
			return response(0);
		}

		// cambiar estatus a 3 = en espera
		$cita->setEstatus(new CitaEstatus(3));

		if(!$this->citasRepositorio->actualizaEstatus($cita)) {
			return response(0);
		}

		return response(1);
	}

	/**
	 * @param Request                      $request
	 * @param UsuariosRepositorioInterface $usuariosRepositorio
	 * @return \Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response
	 */
    public function subirFoto(Request $request, UsuariosRepositorioInterface $usuariosRepositorio)
    {
        // obtener la foto adjuntada
        if($_FILES['fotoAdjuntada']['error'] !== UPLOAD_ERR_OK) {
            return response(0);
        }

		$idPaciente           = (int)base64_decode($request->get('idPaciente'));
		$userMedico           = base64_decode($request->get('userMedico'));
		$medico               = $usuariosRepositorio->obtenerUsuarioPorUsername($userMedico);
		$pacientesRepositorio = PacientesRepositorioFactory::crear($medico);
		$paciente             = $pacientesRepositorio->obtenerPacientePorId($idPaciente);
        $fotografia 		  = new FotografiaPaciente($_FILES['fotoAdjuntada']['tmp_name']);

        if(!$fotografia->moverATemporal($request->session()->getId())) {
            return response(0);
        }

        $paciente->setFotografia($fotografia);

        return View::make('expedientes.paciente_foto', compact('paciente'));
    }

	/**
	 * @param Request                      $request
	 * @param UsuariosRepositorioInterface $usuariosRepositorio
	 * @return \Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response
	 */
    public function recortarFoto(Request $request, UsuariosRepositorioInterface $usuariosRepositorio)
    {
        // obtener parámetros
		$x                    = $request->get('x');
		$y                    = $request->get('y');
		$ancho                = $request->get('w');
		$alto                 = $request->get('h');
		$url                  = $request->get('urlFoto');
		$idPaciente           = (int)base64_decode($request->get('idPaciente'));
		$userMedico           = base64_decode($request->get('userMedico'));
		$medico               = $usuariosRepositorio->obtenerUsuarioPorUsername($userMedico);
		$pacientesRepositorio = PacientesRepositorioFactory::crear($medico);
		$paciente             = $pacientesRepositorio->obtenerPacientePorId($idPaciente);

        $fotografia = new FotografiaPaciente($url);

        if(!$fotografia->cambiarTamanio($x, $y, $ancho, $alto)) {
            return response(0);
        }

        $paciente->setFotografia($fotografia);

        return View::make('expedientes.paciente_foto', compact('paciente'));
    }

	/**
	 * @param                              $idPaciente
	 * @param                              $userMedico
	 * @param UsuariosRepositorioInterface $usuariosRepositorio
	 * @return mixed
	 */
	public function camara($idPaciente, $userMedico, UsuariosRepositorioInterface $usuariosRepositorio)
	{
		$idPaciente           = (int)base64_decode($idPaciente);
		$userMedico           = base64_decode($userMedico);
		$medico               = $usuariosRepositorio->obtenerUsuarioPorUsername($userMedico);
		$pacientesRepositorio = PacientesRepositorioFactory::crear($medico);
		$paciente             = $pacientesRepositorio->obtenerPacientePorId($idPaciente);
		return View::make('expedientes.expediente_paciente_camara', compact('paciente', 'medico'));
	}

	public function capturarFoto($idPaciente, $userMedico, Request $request, UsuariosRepositorioInterface $usuariosRepositorio)
	{
		// obtener la foto adjuntada
		if($_FILES['webcam']['error'] !== UPLOAD_ERR_OK) {
			return response(0);
		}

		$idPaciente           = (int)base64_decode($idPaciente);
		$userMedico           = base64_decode($userMedico);
		$medico               = $usuariosRepositorio->obtenerUsuarioPorUsername($userMedico);
		$pacientesRepositorio = PacientesRepositorioFactory::crear($medico);
		$paciente             = $pacientesRepositorio->obtenerPacientePorId($idPaciente);
		$fotografia 		  = new FotografiaPaciente($_FILES['webcam']['tmp_name']);

		if(!$fotografia->moverATemporal($request->session()->getId(), 300, 200)) {
			return response(0);
		}

		$paciente->setFotografia($fotografia);

		return View::make('expedientes.paciente_foto', compact('paciente'));
	}
}