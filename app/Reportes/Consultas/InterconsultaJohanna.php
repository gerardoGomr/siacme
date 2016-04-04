<?php
namespace Siacme\Reportes\Consultas;

use Siacme\Reportes\ReporteJohannaPdf;

class InterconsultaJohanna extends ReporteJohannaPdf
{
    private $interconsulta;
    private $expediente;

    public function __construct($interconsulta, $expediente)
    {
        $this->interconsulta = $interconsulta;
        $this->expediente    = $expediente;
        parent::__construct(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
    }

    public function generar()
    {
        // TODO: Implement generar() method.
        $this->SetTitle('Interconsulta');
        $this->AddPage();
        $this->Ln(30);
        $this->SetFont('helvetica', '', 12);
        $this->Cell(0, 10, $this->interconsulta->fechaInterconsulta(date('Y-m-d')), 0, 1, 'R');
        $this->Ln(5);
        $this->Cell(0, 5, $this->interconsulta->getMedico()->getNombreCompleto(), 0, 1);
        $this->Cell(0, 5, $this->interconsulta->getMedico()->getDireccion(), 0, 1);

        $this->Ln(5);

        $this->Cell(0, 5, $this->expediente->getPaciente()->getNombreCompleto(), 0, 1, 'R');
        $this->Cell(0, 5, $this->expediente->getPaciente()->getEdadAnios() . ' anios', 0, 1, 'R');

        $this->Ln(10);

        $this->MultiCell(0, 5, utf8_encode($this->interconsulta->getReferencia()), 0, 'J');

        $this->Ln(10);

        $this->SetFont('helvetica', 'B', 12);
        $this->Cell(0, 5, ('Dra. Johanna Joselyn Vázquez Hernández'), 0, 1, 'C');
        $this->Cell(0, 5, 'Odontopediatra', 0, 1, 'C');

        $this->Output('Interconsulta', 'I');
    }
}