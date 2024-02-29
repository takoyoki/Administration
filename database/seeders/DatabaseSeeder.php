<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\Worker;

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
        // \App\Models\User::factory(10)->create();

        \App\Models\User::factory()->create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
            'role' => 0,
            'email_verified_at' => now(),
            'remember_token' => Str::random(10),
        ]);
        
        \App\Models\User::factory()->create([
            'name' => 'Worker User',
            'email' => 'worker@example.com',
            'password' => '1234yyyOOO',
            'role' => 1,
            'email_verified_at' => now(),
            'remember_token' => Str::random(10),
        ]);
        
        
    }
    
    
}
