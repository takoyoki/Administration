<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Worker;
use App\Models\ServiceOrder;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;


class AdminController extends Controller
{
    public function assignToWorker(Request $request, $id)
    {
        // フォームから選択された作業員IDを取得
        $workerId = $request->input('worker_id');

        // 修理伝票を取得
        $serviceOrder = ServiceOrder::findOrFail($id);
// dd($workerId,$serviceOrder);
        // 作業員IDを修理伝票に保存
        $serviceOrder->worker_id = $workerId;
        $serviceOrder->save();

        // 成功メッセージを表示し、前のページにリダイレクト
        return redirect()->back()->with('success', '作業員を割り当てました！');
    }
    

    public function index()
    {
        $workers = worker::all(); // 作業員のリストを取得
        $events = ServiceOrder::all();
        
        $completedOrders = ServiceOrder::where('status', '修理完了')->get();
        $quotationOrders = ServiceOrder::where('status', '見積待')->get();
        $observationOrders = ServiceOrder::where('status', '様子見')->get();
        $otherOrders = ServiceOrder::where('status', 'その他')->get();
        
    $startOfMonth = now()->startOfMonth()->setTimezone('JST')->format('Y-m-d H:i:s');
    $endOfMonth = now()->endOfMonth()->setTimezone('JST')->format('Y-m-d H:i:s');



// サービスオーダーを取得するクエリ
$eventCounts = ServiceOrder::where('scheduled_date', '>=', $startOfMonth)
    ->where('scheduled_date', '<=', $endOfMonth)
    ->where('status', '!=', '削除')
    ->get()
    ->groupBy(function($order) {
        return \Carbon\Carbon::parse($order->scheduled_date)->format('Y-m-d');
    })
    ->map(function($orders) {
        return count($orders);
    })
    ->toArray();


    
    
        return view('admin.dashboard', compact('workers','events', 'eventCounts','completedOrders', 'quotationOrders', 'observationOrders', 'otherOrders'));
        
    }
    
    public function showWorkerTickets(Request $request)
{
    // 選択された作業員のIDを取得
    $workerId = $request->input('worker_id');

    // 選択された作業員に関連する修理伝票を取得
    $worker = Worker::findOrFail($workerId);
    
   
    $tickets = ServiceOrder::where('worker_id', $worker->id)->paginate(5); // 修理伝票を取得する関連メソッド名に応じて変更する必要があるかもしれません

    return view('admin.worker_tickets', compact('worker', 'tickets'));
}
    

    public function search(Request $request)
    {
        $query=$request->query('query');
        
        // 検索ロジックを実装
        $results = ServiceOrder::where('repair_number', 'LIKE', "%{$query}%")
                           ->orWhere('scheduled_date', 'LIKE', "%{$query}%")
                           ->orWhere('status', 'LIKE', "%{$query}%")
                           ->orWhere('customer_name', 'LIKE', "%{$query}%")
                           ->orWhere('phone_number', 'LIKE', "%{$query}%")
                           ->orWhere('address', 'LIKE', "%{$query}%")
                           ->orWhere('memo', 'LIKE', "%{$query}%")
                           ->orWhere('amount', 'LIKE', "%{$query}%")
                           ->paginate(3);

        
        return view('result.search_results', compact('results'));
    }
    
    public function showOrdersByStatus($status)
    {
    // 指定されたステータスに基づいて修理伝票を取得
    $orders = ServiceOrder::where('status', $status)
                                 ->orderBy('scheduled_date', 'asc')
                                 ->paginate(5);

    return view('admin.orders', compact('orders', 'status'));
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
       return redirect()->route('result.show', ['id' => $id]);
    }
    
    
    public function approved()
    {
  
    // 未承認のユーザー一覧を取得
    $unapprovedUsers = User::where('is_approved', 0)->get();

    // 未承認ユーザー一覧ビューを返す
    return view('admin.approved', ['unapprovedUsers' => $unapprovedUsers]);
    
    }
    
   // ルートモデルバインディングを利用して、$id を $user として受け取る
public function approve(Request $request, $userId)
{
    $user = User::findOrFail($userId);
    
    // ユーザーを承認する処理
    $user->update(['is_approved' => 1]);
    
    

    // 承認後に未承認ユーザー一覧ページにリダイレクト
    return redirect()->route('admin.approved')->with('success', 'ユーザーが承認されました');
}

// reject メソッドも同様に修正する
public function reject(Request $request, $userId)
{
    
    $user = User::findOrFail($userId);
    // ユーザーを削除する処理
    $user->delete();

    // 拒否後の処理（例えばリダイレクトなど）をここに追加する
    return redirect()->route('admin.approved')->with('success', 'ユーザーが削除されました');
}
    
    
    
}