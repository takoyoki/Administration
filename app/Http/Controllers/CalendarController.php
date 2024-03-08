<?php

namespace App\Http\Controllers;

use App\Models\ServiceOrder;
use Illuminate\Http\Request;



class CalendarController extends Controller
{
    public function index(Request $request)
    {
        
  
        
        
        // リクエストから日付を取得します。
        $scheduled_date = $request->input('date');
        
        // クエリビルダーを使用して、日付が一致する修理伝票を検索します。
        $serviceOrders = ServiceOrder::whereDate('scheduled_date', $scheduled_date)->paginate(10);

        return view('admin.calendar', compact('serviceOrders', 'scheduled_date', ));
    }
}