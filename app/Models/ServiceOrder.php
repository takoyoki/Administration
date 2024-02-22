<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Enums\ServiceOrders;

class ServiceOrder extends Model
{
    use HasFactory;
    
    protected $casts = [
        'status' => \App\Enums\ServiceOrderStatus::class,
    ];
}
