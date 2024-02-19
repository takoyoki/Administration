<?php

use App\Models\User;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        $query = $request->input('query');
        // 検索ロジックを実装
        $results = User::where('name', 'like', '%' . $query . '%')->get();
        
        return view('search_results', compact('results'));
    }
}