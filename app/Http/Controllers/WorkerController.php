<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\ServiceOrder;
use Dompdf\Dompdf;
use Dompdf\Options;
use PDF;

class WorkerController extends Controller
{
    public function index()
    {
        $repairTickets = ServiceOrder::getAssignedRepairTicketsForWorker(auth()->user()->worker_id);
        
        return view('worker.dashboard', compact('repairTickets'));
    }

    public function showByStatus($status)
    {
        // 指定されたステータスに関連する修理伝票を取得
        $tickets = ServiceOrder::where('status', $status)
                            ->where('worker_id', auth()->user()->worker_id)
                            ->paginate(5);
        
        // 対応するビューを返す
        return view('worker.status', compact('tickets', 'status'));
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
        
        // PDFビューのコンテンツをレンダリング
        $pdfContent = view('pdf.result_details', compact('result'))->render();

        // HTMLコンテンツをDompdfにロード
        $pdf = PDF::loadHTML($pdfContent);

        // PDFを出力
        return $pdf->stream("result_details.pdf");
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
       return redirect()->route('worker_result_show', ['id' => $id]);
    }


}