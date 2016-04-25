<?php
namespace Siacme\Infraestructura\Expedientes;
use Siacme\Dominio\Consultas\PlanTratamiento;
use DB;

/**
 * Class PlanTratamientoRepositorioLaravelMySQL
 * @package Siacme\Infraestructura\Expedientes
 * @author Gerardo Adrián Gómez Ruiz
 */
class PlanTratamientoRepositorioLaravelMySQL implements PlanTratamientoRepositorioInterface
{
    /**
     * update a table plan
     * @param PlanTratamiento $plan
     * @return bool
     */
    public function actualizarAtencionTratamiento(PlanTratamiento $plan)
    {
        // TODO: Implement actualizarAtencionTratamiento() method.
        try {
            foreach ($plan->getListaDientes() as $diente) {
                if ($diente->tieneTratamientos()) {
                    foreach ($diente->getListaTratamientos() as $dientePlan) {
                        DB::table('diente_diente_tratamiento')
                            ->where('idPlanTratamiento', $plan->getId())
                            ->where('Numero', $diente->getNumero())
                            ->where('idDienteTratamiento', $dientePlan->getDienteTratamiento()->getId())
                            ->update([
                                'Atendido'          => 1,
                                'FechaModificacion' => date('Y-m-d H:m:i')
                            ]);
                    }
                }
            }

            if ($plan->atendido()) {
                $this->actualizarPlan($plan);
            }

            return true;
        } catch (\PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }

    public function actualizarPlan(PlanTratamiento $plan)
    {
        try {
            DB::table('plan_tratamiento')
                ->where('idPlanTratamiento', $plan->getId())
                ->update([
                    'Activo'            => 0,
                    'FechaModificacion' => date('Y-m-d H:m:i')
                ]);

            return true;
        } catch (\PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }
}