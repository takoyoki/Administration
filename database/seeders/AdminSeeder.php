<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Faker\Factory as Faker;
use App\Models\User;
use App\Models\Admin;

class AdminSeeder extends Seeder
{
    public function run()
    {
        
        // Admins テーブルにデータを追加
        $admin = Admin::create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
         ]);
         
         
       User::create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'), // 平文のパスワードをハッシュ化して設定
            'role' => 0, // 管理者の場合は 0 を設定
            'is_approved' => 1, // 承認済みの場合は 1 を設定
        ]);
    }
}