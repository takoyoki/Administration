<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Faker\Factory as Faker;

class AdminSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        $email = $faker->unique()->safeEmail;

        // 既存のメールアドレスをチェックし、重複する場合は新しいメールアドレスを生成する
        while (DB::table('users')->where('email', $email)->exists()) {
            $email = $faker->unique()->safeEmail;
        }

        DB::table('users')->insert([
            'name' => 'Admin User',
            'email' => $email,
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'remember_token' => Str::random(10),
            'role' => 0,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}