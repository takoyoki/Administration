<?php

namespace Database\Factories;

use App\Enums\ServiceOrderStatus;
use App\Models\ServiceOrder;
use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Generator as Faker;

class ServiceOrderFactory extends Factory
{
    protected $model = ServiceOrder::class;

    public function definition()
    {
        $faker = \Faker\Factory::create('ja_JP');

        // 最大のrepair_numberを取得し、それに1を加える
        $maxRepairNumber = ServiceOrder::max('repair_number') ?? 999; // nullの場合は999を使用
        $repairNumber = $maxRepairNumber + 1;

        return [
            'repair_number' => $repairNumber,
            'scheduled_date' => $faker->dateTimeBetween('now', '+1 month'),
            'status' => ServiceOrderStatus::getRandomValue(),
            'customer_name' => $faker->name(),
            'phone_number' => $faker->phoneNumber(),
            'address' => $faker->address(),
            'memo' => $faker->sentence(),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}