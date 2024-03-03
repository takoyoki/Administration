<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Worker;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Database\Factories\UserFactory; // UserFactory をインポート

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
         $this->call(AdminSeeder::class);
         $this->call(WorkerSeeder::class);
         $this->call(ServiceOrderSeeder::class);
          
         // WorkerSeeder の実行後に User モデルのデータを生成し、worker_id カラムに関連付ける
         $workers = Worker::all();
         foreach ($workers as $worker) {
             UserFactory::new()->create([ // UserFactory を使用してユーザーを作成
                 'name' => $worker->name,
                 'email' => $worker->email,
                 'password' => Hash::make('password'),
                 'role' => 1,
                 'worker_id' => $worker->id,
                 'email_verified_at' => now(),
                 'remember_token' => Str::random(10),
             ]);
         }
    }
}