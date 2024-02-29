<?php

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\DB;


class WorkerFactory extends Factory
{
    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail,
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}