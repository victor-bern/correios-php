<?php


namespace Source\Classes;

use Dompdf\Dompdf;

class PDF
{
    /**
     * @var Dompdf
     */
    private $pdf;

    public function __construct()
    {
        $this->pdf = new DomPdf();
    }

    public function loadHTML(string $html): void
    {
        $this->pdf->loadHtml($html);
    }

    public function setPaper(string $size, string $orientation)
    {
        $this->pdf->setPaper($size, $orientation);
    }

    public function render()
    {
        $this->pdf->render();
    }

    public function stream(string $dir = null)
    {
        $this->pdf->stream($dir);
    }
}