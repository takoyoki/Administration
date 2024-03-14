<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Worker extends Model
{
    
    use HasFactory;

    protected static function boot()
    {
        parent::boot();

        // Workerが削除される前に、関連するサービス注文のworker_idをNULLに更新します
        static::deleting(function ($worker) {
            $worker->serviceOrders()->update(['worker_id' => null]);
        });
    }

    // WorkerとServiceOrderの関連を定義します
    public function serviceOrders()
    {
        return $this->hasMany(ServiceOrder::class);
    }
    

    // 従業員とユーザーのリレーションを定義する
    public function user()
    {
        return $this->belongsTo(User::class, 'worker_id');
    }
    
    
    protected $fillable = [
        'id',
        'name',
        'email',
        
    ];
}
