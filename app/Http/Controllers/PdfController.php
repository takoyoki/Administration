<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Dompdf\Dompdf;
use Dompdf\Options;
use App\Models\ServiceOrder;
use PDF;


class PdfController extends Controller
{
     public function generatePdf($id)
    {
        $result = ServiceOrder::findOrFail($id); // 修理伝票を取得
        
        // PDFビューのコンテンツをレンダリング
        $pdfContent = view('pdf.result_details', compact('result'))->render();

        // HTMLコンテンツをDompdfにロード
        $pdf = PDF::loadHTML($pdfContent);

        // PDFを出力
        return $pdf->stream("result_details.pdf");
    }

}

