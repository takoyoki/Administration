<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Enums\ServiceOrders;




class ServiceOrder extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'repair_number',
        'scheduled_date',
        'status',
        'customer_name',
        'phone_number',
        'address',
        'memo',
        'amount',
        'worker_id',
    ];
    
    protected $casts = [
        'status' => \App\Enums\ServiceOrderStatus::class,
    ];
    
     // 他のモデルとの関連を定義
    public function worker()
    {
        return $this->belongsTo(Worker::class, 'worker_id');
    }

    // 作業員に割り当てられた修理伝票の情報を取得するメソッド
    public static function getAssignedRepairTicketsForWorker($workerId)
    {
        return static::where('worker_id', $workerId)
            ->orderBy('scheduled_date', 'ASC')
            ->paginate(5);
            
    }
    
}
