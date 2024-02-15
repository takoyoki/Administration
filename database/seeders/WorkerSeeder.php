<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use DateTime;

class WorkerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         DB::table('workers')->insert([
             'name' => '大谷 翔',
             'created_at' => new DateTime(),
             'updated_at' => new DateTime(),
        //
        ]);
    }
}
