// <?php

// // use App\Models\User;

// // class SearchController extends Controller
// // {
// //     public function search(Request $request)
// //     {
// //         $query = $request->input('query');
// //         // 検索ロジックを実装
// //         $results = User::where('name', 'like', '%' . $query . '%')->get();
        
// //         return view('search_results', compact('results'));
// //     }
// // }

// namespace App\Http\Controllers;

// use Illuminate\Http\Request;
// use App\Models\ServiceOrder;

// class SearchController extends Controller
// {
//     public function search(Request $request)
//     {
//         $query = $request->input('query');

//         $results = ServiceOrder::where('repair_number', 'LIKE', "%{$query}%")
//                                 ->orWhere('customer_name', 'LIKE', "%{$query}%")
//                                 ->get();

//         return view('search_results', compact('results'));
//     }
// }