<?php
namespace Siacme\Infraestructura\Consultas;

use DB;
use Illuminate\Support\Collection;
use Siacme\Dominio\Consultas\Receta;

/**
 * Class RecetasRepositorioLaravelMySQL
 * @package Siacme\Infraestructura\Consultas
 * @author  Gerardo Adrián Gómez Ruiz
 */
class RecetasRepositorioLaravelMySQL implements RecetasRepositorioInterface
{
    /**
     * @return Collection
     */
    public function obtenerRecetas()
    {
        try {

            $recetas = DB::table('receta')
                ->orderBy('Nombre')
                ->get();

            $totalRecetas = count($recetas);

            if ($totalRecetas > 0) {
                $listaRecetas = new Collection();
                foreach ($recetas as $recetas) {
                    $receta = new Receta($recetas->idReceta, $recetas->Receta, $recetas->Nombre);

                    $listaRecetas->push($receta);
                }

                return $listaRecetas;
            }

            return null;

        } catch (\PDOException $e) {
            echo $e->getMessage();
            return null;
        }
    }
}