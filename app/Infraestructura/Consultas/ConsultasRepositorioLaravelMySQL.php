<?php
namespace Siacme\Infraestructura\Consultas;

use Siacme\Dominio\Consultas\Consulta;
use DB;

/**
 * Class ConsultasRepositorioInterface
 * @package Siacme\Infraestructura\Consultas
 * @author  Gerardo Adrián Gómez Ruiz
 */
class ConsultasRepositorioLaravelMySQL implements ConsultasRepositorioInterface
{
    /**
     * @param Consulta $consulta
     * @return void
     */
    public function persistir(Consulta $consulta)
    {
        try {
            if ($consulta->nuevaOSubsecuente() === 'Nueva') {
                $idConsulta = DB::table('consulta')
                    ->insertGetId([
                        'Fecha'              => 'NOW()',
                        'PadecimientoActual' => $consulta->getPadecimientoActual(),
                        'Interrogatorio'     => $consulta->getInterrogatorioAparatosSistemas(),
                        'Nota'               => $consulta->getNotaMedica(),
                        'Peso'               => $consulta->getExploracionFisica()->getPeso(),
                        'Talla'              => $consulta->getExploracionFisica()->getTalla(),
                        'Pulso'              => $consulta->getExploracionFisica()->getPulso(),
                        'Temperatura'        => $consulta->getExploracionFisica()->getTemperatura(),
                        'TensionArterial'    => $consulta->getExploracionFisica()->getTensionArterial(),
                        'FechaModificacion'  => 'NOW()'
                    ]);

                // persistir la receta si tiene
                if ($consulta->tieneReceta()) {
                    $operacion = DB::table('consulta')
                        ->where('idReceta', $consulta->getReceta()->getId())
                        ->update([
                            'idReceta' => $consulta->getReceta()->getId()
                        ]);
                }
            } elseif ($consulta->nuevaOSubsecuente() === 'Existente'){

            }

        } catch(\PDOException $e) {
            echo $e->getMessage();
        }
    }
}