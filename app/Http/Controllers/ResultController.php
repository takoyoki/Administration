<?php

namespace App\Http\Controllers;

use App\Models\Result; // 使用するモデルをインポートする
use App\Models\Worker; // 使用するモデルをインポートする

class ResultController extends Controller
{
    public function show($id)
    {
        $result = Result::findOrFail($id); // ID に対応する検索結果を取得
        $workers = Worker::all(); // 作業員データを取得

        return view('result.show', compact('result', 'workers')); // 検索結果と作業員データを表示するビューにデータを渡す
    }
}