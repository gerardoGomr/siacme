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
        $this->SetFont('helvetica', 'B', 12);
        $this->SetTextColor(60, 60, 60);
        $this->Cell(0, 10, 'REPORTE DE PACIENTES CITADOS DEL DÍA ' . $this->fecha, 0, true);
        $this->SetTextColor(0);
        $this->Ln(5);
        $this->SetFont('helvetica', '', 12);
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
            <table border="1" style="margin: 5px;"  cellpadding="5">
                <thead>
                    <tr bgcolor="#24C5AD" style="color:#ffffff" align="center">
                        <th><strong>Horario</strong></th>
                        <th><strong>Paciente</strong></th>
                        <th><strong>Edad</strong></th>
                    </tr>
                </thead>
                <tbody>';

        foreach ($this->listaCitas as $cita) {
            $this->html .= '
                <tr>
                    <td>' . $cita->getHora() . '</td>
                    <td>' . $cita->getPaciente()->getNombreCompleto() . '</td>
                    <td>' . $cita->getPaciente()->getEdadAnios() . ' años</td>
                </tr>';
        }

        $this->html .= '</tbody></table>';
    }
}