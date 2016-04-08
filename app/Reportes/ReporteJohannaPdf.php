<?php
namespace Siacme\Reportes;

use \TCPDF;

/**
 * Class ReporteJohannaPdf
 * @package Siacme\Reportes
 * @author  Gerardo Adrián Gómez Ruiz
 */
abstract class ReporteJohannaPdf extends TCPDF
{
    /**
     * encabezado de reporte
     */
    public function Header() {
        // Set font
        $this->SetFont('helvetica', 'B', 18);
        $this->Cell(0, 10, 'Dra. Johanna Joselyn Vázquez Hernández', 0, true, 'R');
        $this->SetFont('helvetica', 'B', 16);
        $this->Cell(0, 10, 'Médica Diamante', 0, true, 'R');

        // imagen
        $this->Image(asset('public/img/boka2.jpg'), 10, 10, 30);
        $this->Image(asset('public/img/mascota.jpg'), 10, 25, 20);
        $this->Ln(25);
    }

    /**
     * pie de reporte, mostrar numero de hojas
     */
    public function Footer() {
        // Position at 15 mm from bottom
        $this->SetY(-15);
        // Set font
        $this->SetFont('helvetica', 'I', 8);
        // Page number
        $this->Cell(0, 10, 'Página '.$this->getAliasNumPage().'/'.$this->getAliasNbPages(), 0, false, 'C', 0, '', 0, false, 'T', 'M');
    }

    /**
     * generar el reporte
     * @return string
     */
    abstract public function generar();
}