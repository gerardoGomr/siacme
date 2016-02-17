<?php
namespace Siacme\Infraestructura\Consultas;

use DB;
use Illuminate\Support\Collection;
use Siacme\Dominio\Interconsultas\MedicoReferencia;
use Siacme\Dominio\Usuarios\Especialidad;

/**
 * Class MedicosReferenciaRepositorioInterface
 * @package Siacme\Infraestructura\Consultas
 * @author  Gerardo Adrián Gómez Ruiz
 */
class MedicosReferenciaRepositorioLaravelMySQL implements MedicosReferenciaRepositorioInterface
{
    /**
     * obtener una lista de médicos a los que se les hace referencia
     * @return Collection
     */
    public function obtenerMedicosReferencia()
    {
        try {
            $medicos = DB::table('medico_referencia')
                ->join('especialidad', 'especialidad.idEspecialidad', '=', 'medico_referencia.idEspecialidad')
                ->orderBy('medico_referencia.Nombre')
                ->orderBy('medico_referencia.Paterno')
                ->get();

            $totalMedicos = count($medicos);

            if ($totalMedicos > 0) {
                $listaMedicos = new Collection();

                foreach ($medicos as $medicos) {
                    $medicoReferencia = new MedicoReferencia($medicos->idMedicoReferencia, $medicos->Direccion, new Especialidad($medicos->idEspecialidad, $medicos->Especialidad));
                    $medicoReferencia->setNombre($medicos->Nombre);
                    $medicoReferencia->setPaterno($medicos->Paterno);
                    $medicoReferencia->setMaterno($medicos->Materno);
                    $listaMedicos->push($medicoReferencia);
                }

                return $listaMedicos;
            }

            return null;

        } catch(\PDOException $e) {
            echo $e->getMessage();
            return null;
        }
    }
}