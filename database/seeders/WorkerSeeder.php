<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class WorkerSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        // 10人の作業者を生成する
        for ($i = 0; $i < 10; $i++) {
            DB::table('workers')->insert([
                'name' => $faker->unique()->name,
                'email' => $faker->safeEmail,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}