<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\ServiceOrder;
use Dompdf\Dompdf;
use Dompdf\Options;

class WorkerController extends Controller
{
    public function index()
{
   $repairTickets = ServiceOrder::getAssignedRepairTicketsForWorker(auth()->user()->worker_id);
    

    return view('worker.dashboard', compact('repairTickets'));
}

public function resultShow($id)
    {
        $result = ServiceOrder::findOrFail($id);
        
        

        // 修理伝票の詳細を表示するビューを返す
        return view('worker.result-show', compact('result'));
    }
    
     public function generatePdf($id)
{
    $result = ServiceOrder::findOrFail($id); // 修理伝票を取得
    
    // PDF用のオプションを設定
    $options = new Options();
    $options->set('isHtml5ParserEnabled', true);
    $options->set('defaultFont', 'Noto Sans Japanese'); // Noto Sans Japanese フォントを使用する

    // Dompdf オブジェクトを作成
    $dompdf = new Dompdf($options);

    // PDFビューのコンテンツをレンダリング
    $pdfContent = view('pdf.result_details', compact('result'))->render();

    // HTMLコンテンツをDompdfにロード
    $dompdf->loadHtml($pdfContent);

    // PDFをレンダリング
    $dompdf->render();

    // PDFを出力
    return $dompdf->stream("result_details.pdf");
}
    
     public function update(Request $request, $id)
    {
        // 更新するサービス注文を取得
        $serviceOrder = ServiceOrder::findOrFail($id);

        // フォームから送信されたデータを取得
        $data = $request->only(['repair_number', 'scheduled_date', 'status', 'customer_name', 'phone_number', 'address', 'memo', 'amount']);

        // サービス注文を更新
        $serviceOrder->update($data);

        // 更新後のページにリダイレクト
       return redirect()->route('worker.result-show', ['id' => $id]);
    }


}