<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;  // ランダム文字列用
use Illuminate\Support\Facades\Hash; // パスワードハッシュ用

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            // 'email_verified_at' => now(), // 必要なら
            'password' => Hash::make('password'), // パスワードのハッシュ
            // 'remember_token' => Str::random(10),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
