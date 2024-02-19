<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\User;

class WorkerController extends Controller
{
    
     public function index()
    {
        return view('worker.dashboard');
    }
    
    public function search(Request $request)
    {
        $query = $request->input('query');
        // 検索ロジックを実装
        $results = User::where('name', 'like', '%' . $query . '%')->get();
        
        return view('search_results', compact('results'));
    }
}