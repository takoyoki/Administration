<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use DateTime;

class ServiceOrderSeeder extends Seeder
{
    public function run()
    {
        DB::table('serviceorders')->insert([
            'repair_number' => '100',
            'scheduled_date' => '2024-03-01',
            'memo' => '朝お客様にTEL',
            'amount' => '5000',
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
        //
        ]);
    }
}
