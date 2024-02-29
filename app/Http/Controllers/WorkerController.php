<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\ServiceOrder;

class WorkerController extends Controller
{
    public function index()
    {
        return view('worker.dashboard');
    }

//     public function search(Request $request)
//     {
//         $query = $request->input('query');
        
//         // 検索ロジックを実
//          $results = ServiceOrder::where('repair_number', 'LIKE', "%{$query}%")
//                                 ->orWhere('customer_name', 'LIKE', "%{$query}%")
//                                 ->paginate(3);

        
//         return view('search_results', compact('results'));
//     }
}