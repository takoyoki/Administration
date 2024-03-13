<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Worker extends Model
{
    
    

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
