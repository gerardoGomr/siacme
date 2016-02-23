<?php
namespace Siacme\Servicios\Pacientes;

use Siacme\Dominio\Pacientes\Paciente;
use Siacme\Http\Requests\Request;
use Siacme\Infraestructura\Pacientes\PacientesRepositorioInterface;

/**
 * Class PacientesComplementoServicio
 * @package Siacme\Servicios\Pacientes
 * @author  Gerardo Adrián Gómez Ruiz
 */
class PacientesComplementoServicio
{
    /**
     * @var PacientesRepositorioInterface
     */
    private $pacientesRepositorio;

    /**
     * PacientesComplementoServicio constructor.
     * @param PacientesRepositorioInterface $pacientesRepositorio
     */
    public function __construct(PacientesRepositorioInterface $pacientesRepositorio)
    {
        $this->pacientesRepositorio = $pacientesRepositorio;
    }

    /**
     * @param Request $request
     */
    public function crearDeHttp(Request $request, Paciente $paciente)
    {
        // obtener todos los elementos que posiblemente se hayan enviado en caso de que sea un paciente de primera vez
        $craneofacial               = $request->get('craneofacial');
        $facial                     = $request->get('facial');
        $convexividad               = $request->get('convexividad');
        $atmo                       = $request->get('atm');
        $labios                     = $request->get('txtLabios');
        $carrillos                  = $request->get('txtCarrillos');
        $frenillos                  = $request->get('txtFrenillos');
        $paladar                    = $request->get('txtPaladar');
        $lengua                     = $request->get('txtLengua');
        $pisoBoca                   = $request->get('txtPisoBoca');
        $parodonto                  = $request->get('txtParodonto');
        $uvula                      = $request->get('txtUvula');
        $ocofaringe                 = $request->get('txtOcofaringe');
        $arcoI                      = $request->get('arcoTipoI') === 'on' ? true : false;
        $arcoII                     = $request->get('arcoTipoII') === 'on' ? true : false;
        $mesialDerecho              = $request->get('mesialDer') === 'on' ? true : false;
        $mesialIzquierdo            = $request->get('mesialIzq') === 'on' ? true : false;
        $distalDerecho              = $request->get('distalDer') === 'on' ? true : false;
        $distalIzquierdo            = $request->get('distalIzq') === 'on' ? true : false;
        $rectoDerecho               = $request->get('rectoDer') === 'on' ? true : false;
        $rectoIzquierdo             = $request->get('rectoIzq') === 'on' ? true : false;
        $exageradoDerecho           = $request->get('exageradoDer') === 'on' ? true : false;
        $exageradoIzquierdo         = $request->get('exagerardoIzq') === 'on' ? true : false;
        $noDeterminadoDerecho       = $request->get('noDeterminadoDer') === 'on' ? true : false;
        $noDeterminadoIzquierdo     = $request->get('noDeterminadoIzq') === 'on' ? true : false;
        $caninaDerecho              = $request->get('caninaDer') === 'on' ? true : false;
        $caninaIzquierdo            = $request->get('caninaIzq') === 'on' ? true : false;
        $relacionMolarDerechoI      = $request->get('relacionMolarDerI') === 'on' ? true : false;
        $relacionMolarIzquierdoI    = $request->get('relacionMolarIzqI') === 'on' ? true : false;
        $relacionMolarDerechoII     = $request->get('relacionMolarDerII') === 'on' ? true : false;
        $relacionMolarIzquierdoII   = $request->get('relacionMolarIzqII') === 'on' ? true : false;
        $relacionMolarDerechoIII    = $request->get('relacionMolarDerIII') === 'on' ? true : false;
        $relacionMolarIzquierdoIII  = $request->get('relacionMolarIzqIII') === 'on' ? true : false;
        $relacionCaninaDerechoI     = $request->get('relacionCaninaDerI') === 'on' ? true : false;
        $relacionCaninaIzquierdoI   = $request->get('relacionCaninaIzqI') === 'on' ? true : false;
        $relacionCaninaDerechoII    = $request->get('relacionCaninaDerII') === 'on' ? true : false;
        $relacionCaninaIzquierdoII  = $request->get('relacionCaninaIzqII') === 'on' ? true : false;
        $relacionCaninaDerechoIII   = $request->get('relacionCaninaDerIII') === 'on' ? true : false;
        $relacionCaninaIzquierdoIII = $request->get('relacionCaninaIzqIII') === 'on' ? true : false;
        $mordidaBordeBorde          = $request->get('mordidaBordeBorde') === 'on' ? true : false;
        $sobremordidaVertical       = $request->get('sobremordidaVertical') === 'on' ? true : false;
        $sobremordidaHorizontal     = $request->get('sobremordidaHorizontal') === 'on' ? true : false;
        $mordidaAbiertaAnterior     = $request->get('mordidaAbiertaAnterior') === 'on' ? true : false;
        $mordidaCruzadaAnterior     = $request->get('mordidaCruzadaAnterior') === 'on' ? true : false;
        $mordidaCruzadaPosterior    = $request->get('mordidaCruzadaPosterior') === 'on' ? true : false;
        $lineaMediaDental           = $request->get('lineaMediaDental') === 'on' ? true : false;
        $lineaMediaEsqueletica      = $request->get('lineaMediaEsqueletica') === 'on' ? true : false;
        $alteracionTamanio          = $request->get('alteracionTamanio') === 'on' ? true : false;
        $alteracionForma            = $request->get('alteracionForma') === 'on' ? true : false;
        $alteracionNumero           = $request->get('alteracionNumero') === 'on' ? true : false;
        $alteracionEstructura       = $request->get('alteracionEstructura') === 'on' ? true : false;
        $alteracionTextura          = $request->get('alteracionTextura') === 'on' ? true : false;
        $alteracionColor            = $request->get('alteracionColor') === 'on' ? true : false;

        // setear a expediente johanna

        // persistir
    }
}