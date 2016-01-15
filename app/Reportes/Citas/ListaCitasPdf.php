<?php
namespace Siacme\Reportes\Citas;

use Siacme\Reportes\ReporteJohannaPdf;

/**
 * Class ListaCitasPdf
 * @package Siacme\Reportes\Citas
 * @author  Gerardo Adrián Gómez Ruiz
 */
class ListaCitasPdf extends ReporteJohannaPdf
{
    /**
     * @var array
     */
    private $listaCitas;

    /**
     * @var string
     */
    private $fecha;

    /**
     * @var string
     */
    private $html;

    public function __construct($listaCitas, $fecha)
    {
        $this->listaCitas = $listaCitas;
        $this->fecha      = $fecha;
        parent::__construct(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
    }

    /**
     * generar el reporte
     * @return string
     */
    public function generar()
    {
        // TODO: Implement generar() method.
        $this->SetTitle('Lista de Citas');
        $this->AddPage();
        $this->Ln(30);
        $this->SetFont('courier', 'B', 12);
        $this->Cell(0, 10, 'Reporte de citados del día ' . $this->fecha, 0, true);
        $this->Ln(5);
        $this->generaTabla();
        $this->writeHTML($this->html, true, false, false);
        $this->Output('Lista de Citas', 'I');
    }

    /**
     * construye la tabla a desplegar
     * @return void
     */
    private function generaTabla()
    {
        $this->html = '
            <table border="1" style="margin: 5px;">
                <thead style="background: #cccccc">
                    <tr>
                        <th>Horario</th>
                        <th>Paciente</th>
                        <th>&nbsp;</th>
                    </tr>
                </thead>
                <tbody>';

        foreach ($this->listaCitas as $cita) {
            $this->html .= '
                <tr>
                    <td>' . $cita->getHora() . '</td>
                    <td>' . $cita->getPaciente()->getNombreCompleto() . '</td>
                    <td></td>
                </tr>';
        }

        $this->html .= '</tbody></table>';
    }
}