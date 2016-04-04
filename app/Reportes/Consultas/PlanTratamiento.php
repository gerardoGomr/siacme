<?php
namespace Siacme\Reportes;

class PlanTratamiento extends ReporteJohannaPdf
{
    private $expediente;


    public function __construct($expediente)
    {
        $this->expediente = $expediente;
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
        $this->SetFont('courier', 'B', 12);
        $this->SetFillColor(178, 178, 178);
        $this->Cell(0, 10, 'Plan de tratamiento', 'L', 0, 1, 1);
        $this->Ln(5);
        $this->Cell(0, 5, 'Legal o familiar del niño (a): '. $this->expediente->getPaciente()->getNombreCompleto(), 'L', 0, 1);
        $this->Ln(5);
        $this->MultiCell(0, 5, utf8_decode('DECLARO: Que la E. OP Johanna Joselyn Vázquez Hernández me ha explicado que necesito los siguientes tratamientos especificados en la historia clínica y su respectivo costo'), 'L', 0, 1, 1);
        $this->Ln(5);


    }
}