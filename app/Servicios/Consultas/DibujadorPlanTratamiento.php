<?php
namespace Siacme\Servicios\Consultas;

use Illuminate\Support\Collection;
use Siacme\Dominio\Consultas\PlanTratamiento;
use Siacme\Servicios\DibujadorInterface;

/**
 * Class DibujadorPlanTratamiento
 * @package Siacme\Servicios\Consultas
 * @author  Gerardo Adrián Gomez Ruiz
 */
class DibujadorPlanTratamiento implements DibujadorInterface
{
    /**
     * @var PlanTratamiento
     */
    protected $planTratamiento;

    /**
     * @var Collection
     */
    protected $listaDienteTratamientos;

    /**
     * DibujadorPlanTratamiento constructor.
     * @param PlanTratamiento $planTratamiento
     */
    public function __construct(PlanTratamiento $planTratamiento, Collection $listaDienteTratamientos)
    {
        $this->planTratamiento         = $planTratamiento;
        $this->listaDienteTratamientos = $listaDienteTratamientos;
    }

    /**
     * dibujar la representación del plan
     * @return string
     */
    public function dibujar()
    {
        // TODO: Implement dibujar() method.
        $html = '
            <table class="table table-bordered tablaPlan">
                <thead>
                    <tr>
                        <th>Diente</th>
                        <th>Padecimiento</th>
                        <th>Tratamiento 1</th>
                        <th>Tratamiento 2</th>
                        <th>Costo</th>
                    </tr>
                </thead>
                <tbody>';

        foreach ($this->planTratamiento->getListaDientes() as $diente) {
            $html .= '
                <tr>
                    <td class="diente">' . $diente->getNumero() . '</td>
                    <td>' . $this->dibujarPadecimientos($diente->getListaPadecimientos()) . '</td>
                    <td>' . $this->dibujarComboTratamientos($this->listaDienteTratamientos) .'</td>
                    <td>' . $this->dibujarComboTratamientos($this->listaDienteTratamientos) .'</td>
                    <td>' . $this->dibujarCostosTratamientos($diente->getListaTratamientos()) . '</td>
                </tr>
            ';
        }

        $html .= '</tbody></table>';

        return $html;
    }

    /**
     * dibujar padecimientos
     * @param Collection $listaPadecimientos
     * @return string
     */
    private function dibujarPadecimientos($listaPadecimientos)
    {
        $html     = '';
        $indice   = 1;
        $longitud = count($listaPadecimientos);
        foreach ($listaPadecimientos as $padecimiento) {
            if ($indice === $longitud) {
                $html .= $padecimiento->getNombre();
            } else {
                $html .= $padecimiento->getNombre() . '||';
            }

            $indice++;
        }

        return $html;
    }

    private function dibujarComboTratamientos($listaDienteTratamientos)
    {
        $html = '
            <select name="dienteTratamientos" class="tratamientos form-control">
                <option value="">Seleccione</option>
        ';

        foreach ($listaDienteTratamientos as $dienteTratamientos) {
            $html .= '<option value="' . $dienteTratamientos->getId() . '">' . $dienteTratamientos->getTratamiento() . '</option>';
        }

        $html .= '</select>';

        return $html;
    }

    private function dibujarCostosTratamientos($listaDienteTratamientos)
    {
        $total = count($listaDienteTratamientos);
        if ($total === 0 || is_null($listaDienteTratamientos)) {
            return '';
        }

        $html = '';
        $i = 1;
        foreach ($listaDienteTratamientos as $dienteTratamiento) {
            if ($i < $total) {
                $html .= '$' . (string) number_format($dienteTratamiento->getDienteTratamiento()->getCosto(), 2) . ' + ';
            } else {
                $html .= '$' . (string) number_format($dienteTratamiento->getDienteTratamiento()->getCosto(), 2);
            }

            $i++;
        }

        return $html;
    }
}