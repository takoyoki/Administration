<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\ServiceOrder;
use Carbon\Carbon;

use PDF;

class WorkerController extends Controller
{
    public function index()
    {
        
        $worker_id = auth()->user()->worker_id;
        
        $repairTickets = ServiceOrder::getAssignedRepairTicketsForWorker(auth()->user()->worker_id);
        $events = ServiceOrder::where('worker_id', $worker_id)->get();
        
        $startOfMonth = now()->startOfMonth()->setTimezone('JST')->format('Y-m-d H:i:s');
        $endOfMonth = now()->endOfMonth()->setTimezone('JST')->format('Y-m-d H:i:s');
        
       // サービスオーダーを取得するクエリ
     $eventCounts = ServiceOrder::where('scheduled_date', '>=', $startOfMonth)
    ->where('scheduled_date', '<=', $endOfMonth)
    ->where('status', '!=', '削除')
    ->where('worker_id', auth()->user()->worker_id) // 作業員のIDでフィルタリング
    ->paginate(10)
    ->groupBy(function($order) {
        return \Carbon\Carbon::parse($order->scheduled_date)->format('Y-m-d');
    })
    ->map(function($orders) {
        return count($orders);
    })
    ->toArray();
        
        
        
        return view('worker.dashboard', compact('repairTickets','events','eventCounts'));
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
        
         // 今日の日付を取得
    $today = now()->format('Y-m-d');

        
         // バリデーションルールを定義
    $validatedData = $request->validate([
        'scheduled_date' => 'required|date|after_or_equal:'.$today, // 今日以降の日付であることを検証
        'status' => 'required',
        'memo' => 'nullable|max:400',
        'amount' => 'required|numeric',
        
        ]);
        
        // 更新するサービス注文を取得
        $serviceOrder = ServiceOrder::findOrFail($id);

        // フォームから送信されたデータを取得
        $data = $request->only(['repair_number', 'scheduled_date', 'status', 'customer_name', 'phone_number', 'address', 'memo', 'amount']);

        // サービス注文を更新
        $serviceOrder->update($data);

        // 更新後のページにリダイレクト
       return redirect()->route('worker_result_show', ['id' => $id]);
    }
    
    public function edit($id)
{
    $user = User::findOrFail($id);
    return view('worker.edit', compact('user'));
}

 public function editUser(Request $request, $id)
    {
        $user = User::findOrFail($id);
        
        // バリデーションのルールを指定して、入力値を検証することができます
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
        ]);

        $user->update($validatedData);
        
        // 作業員の場合、workersテーブルも更新
    if ($user->role == 1) {
        $worker = Worker::findOrFail($user->worker_id);
        $worker->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);
    }

        return redirect()->route('worker.edit', ['id' => $user->id])->with('success', 'ユーザー情報を更新しました');
    }




}