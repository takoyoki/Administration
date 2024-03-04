<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\ServiceOrder;

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