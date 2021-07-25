<?php

namespace App\Service;

use Mpdf\Mpdf;

class PdfRender
{
    public function generatePdf($html, $name){
        $mpdf = new Mpdf();
        $mpdf->SetDisplayMode('fullpage');
        $mpdf->WriteHTML($html);
        $mpdf->Output();
    }
}