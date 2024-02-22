<?php

namespace Database\Seeders;

use App\Enums\ServiceOrderStatus;
use Illuminate\Database\Seeder;
use App\Models\ServiceOrder;


class ServiceOrderSeeder extends Seeder
{
    public function run()
    {
        // 50件のサービスオーダーを作成し、データベースに保存する
        foreach (range(1, 50) as $index) {
            ServiceOrder::factory()->create([
                // ランダムなステータスをセット
                'status' => ServiceOrderStatus::getRandomValue(),
            ]);
        }
    }
}