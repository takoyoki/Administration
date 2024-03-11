<?php

namespace App\Http\Controllers;

use App\Models\ServiceOrder;
use App\Models\Users;
use Illuminate\Http\Request;



class CalendarController extends Controller
{
    public function index(Request $request)
    {
        // ユーザーの役割を取得します。
        $role = auth()->user()->role;
  
        // リクエストから日付を取得します。
        $scheduled_date = $request->input('date');
        
        // ユーザーが作業員の場合はその作業員に割り当てられた伝票のみを取得します。
        if ($role == 1) {
            $worker_id = auth()->user()->worker_id;
            $serviceOrders = ServiceOrder::whereDate('scheduled_date', $scheduled_date)
                ->where('worker_id', $worker_id)
                ->paginate(10);
            $view = 'worker.calendar';
        } else { // ユーザーが管理者の場合はすべての伝票を取得します。
             $worker_id = null;
            $serviceOrders = ServiceOrder::whereDate('scheduled_date', $scheduled_date)->paginate(10);
            $view = 'admin.calendar';
        }

        return view($view, compact('serviceOrders', 'scheduled_date', 'worker_id'));
    }
}