<?php
namespace Siacme\Reportes\Consultas;

use Siacme\Reportes\ReporteJohannaPdf;

class RecetaJohanna extends ReporteJohannaPdf
{
    private $receta;
    private $expediente;

    public function __construct($receta, $expediente)
    {
        $this->receta     = $receta;
        $this->expediente = $expediente;
        parent::__construct(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
    }

    /**
     * generar receta médica PDF
     */
    public function generar()
    {
        // TODO: Implement generar() method.
        $this->SetTitle('Receta');
        $this->AddPage();
        $this->Ln(30);
        $this->SetFont('helvetica', '', 12);
        $this->Cell(0, 10, $this->receta->fechaReceta(date('Y-m-d')), 0, 1, 'R');
        $this->Ln(5);
        $this->Cell(0, 5, 'Nombre: '. $this->expediente->getPaciente()->getNombreCompleto(), 0, 1);
        $this->Cell(0, 5, 'Edad: '. $this->expediente->getPaciente()->getEdadAnios(), 0, 1);
        $this->Ln(5);
        $this->MultiCell(0, 5, utf8_encode($this->receta->getReceta()), 0, 'J');
        $this->Ln(5);

        $this->Output('Lista de Citas', 'I');
    }
}