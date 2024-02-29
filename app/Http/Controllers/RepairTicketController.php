<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RepairTicket; // RepairTicket モデルをインポート
use App\Models\Worker; // Worker モデルをインポート

class RepairTicketController extends Controller
{
    public function showRepairTicket($id)
    {
        // 修理伝票を取得
        $repairTicket = RepairTicket::findOrFail($id);

        // 作業員の一覧を取得
        $workers = Worker::all();

        // 修理伝票と作業員の一覧をビューに渡す
        return view('repair_ticket.show', compact('repairTicket', 'workers'));
    }
}