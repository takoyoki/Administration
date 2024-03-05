<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Dompdf\Dompdf;
use Dompdf\Options;


class PdfController extends Controller
{
    public function generatePdf($result)
    {
        dd($result);
        
        $options = new Options();
        $options->set('defaultFont', 'Arial');

        $dompdf = new Dompdf($options);

        $pdfContent = view('pdf.result_details', compact('result'))->render();

        $dompdf->loadHtml($pdfContent);

        // PDFをレンダリング
        $dompdf->render();

        // PDFを出力
        return $dompdf->stream("result_details.pdf");
    }
}

