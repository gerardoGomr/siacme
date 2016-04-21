<?php
namespace Siacme\Reportes\Consultas;

use Siacme\Reportes\ReporteJohannaPdf;
use Illuminate\Support\Collection;

class PlanTratamientoJohanna extends ReporteJohannaPdf
{
    private $expediente;
    private $plan;

    public function __construct($plan, $expediente)
    {
        $this->expediente = $expediente;
        $this->plan       = $plan;
        parent::__construct(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
    }

    /**
     * generar receta médica PDF
     */
    public function generar()
    {
        // TODO: Implement generar() method.
        $this->SetTitle('Plan de tratamiento');
        $this->AddPage();
        $this->Ln(30);
        $this->SetFont('helvetica', '', 12);
        $this->SetFillColor(178, 178, 178);
        $this->Cell(0, 10, 'Plan de tratamiento', 0, 1, '',1);
        $this->Ln(5);
        $this->Cell(0, 5, 'Legal o familiar del niño (a): '. $this->expediente->getPaciente()->getNombreCompleto(), 0, 1);
        $this->Ln(5);
        $this->MultiCell(0, 5, ('DECLARO: Que la E. OP Johanna Joselyn Vázquez Hernández me ha explicado que necesito los siguientes tratamientos especificados en la historia clínica y su respectivo costo'), 'L', 0, 1, 1);
        $this->Ln(5);
        $this->SetFont('helvetica', '', 8);
        $otrosTratamientos = '';
        foreach ($this->plan->getListaOtrosTratamientos() as $otroTratamiento) {
            $otrosTratamientos .= $otroTratamiento->getTratamiento() . ' ($' . (string)number_format($otroTratamiento->getCosto(), 2) . ') - ';
        }
        $html = '
            <p class="text-medium"><span class="strong">Costo total:</span> <span>$ '.(string) number_format($this->plan->costo(), 2).'</span></p>
            <p><span class="strong">Otros:</span> <em>' . $otrosTratamientos . '</em></p>
            <table border="1" cellpading="1" cellspacing="1">
                <thead>
                    <tr>
                        <th bgcolor="gray" color="white">Diente</th>
                        <th bgcolor="gray" color="white">Padecimiento</th>
                        <th bgcolor="gray" color="white">Tratamiento 1</th>
                        <th bgcolor="gray" color="white">Tratamiento 2</th>
                        <th bgcolor="gray" color="white">Costo</th>
                    </tr>
                </thead>
                <tbody>';

        foreach ($this->plan->getListaDientes() as $diente) {
            $dientePlan1 = $dientePlan2 = null;
            if (!is_null($diente->getListaTratamientos())) {
                $dientePlan1 = $diente->getListaTratamientos()->get('1')->getDienteTratamiento()->getTratamiento();
                $dientePlan2 = !is_null($diente->getListaTratamientos()->get('2')) ? $diente->getListaTratamientos()->get('2')->getDienteTratamiento()->getTratamiento() : '-';
            } else {
                $dientePlan1 = $dientePlan2 = '';
            }
            $html .= '
                <tr>
                    <td class="diente">' . $diente->getNumero() . '</td>
                    <td>' . $this->dibujarPadecimientos($diente->getListaPadecimientos()) . '</td>
                    <td>' . $dientePlan1 .'</td>
                    <td>' . $dientePlan2 .'</td>
                    <td>' . $this->dibujarCostosTratamientos($diente->getListaTratamientos()) . '</td>
                </tr>
            ';
        }

        $html .= '</tbody></table>';

        $this->writeHTML($html, true, false, false, false, '');

        $this->Output('Plan de tratamiento', 'I');
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

    /**
     * dibuja un combo de tratamientos
     * @param Collection $listaDienteTratamientos
     * @return string
     */
    private function dibujarComboTratamientos($elemento, Collection $listaDienteTratamientos = null)
    {
        $total = count($listaDienteTratamientos);
        if ($total === 0 || is_null($listaDienteTratamientos)) {
            return '';
        }

        $html = '';
        $i = 1;
        foreach ($listaDienteTratamientos as $dienteTratamiento) {
            if ($i < $total) {
                $html .= $dienteTratamiento->getDienteTratamiento()->getTratamiento(). ' - ';
            } else {
                $html .= $dienteTratamiento->getDienteTratamiento()->getTratamiento();
            }

            $i++;
        }

        return $html;
    }

    /**
     * presenta los costos de los tratamientos
     * @param Collection $listaDienteTratamientos
     * @return string
     */
    private function dibujarCostosTratamientos(Collection $listaDienteTratamientos = null)
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