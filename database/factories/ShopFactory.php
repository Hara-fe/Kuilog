<?php

namespace Database\Factories;

use App\Models\Category; // 追加
use App\Models\Area;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Carbon\Carbon;

class ShopFactory extends Factory
{
    public function definition(): array
    {
        return [
            'owner_id' => User::factory(),
            'name' => $this->faker->company(),
            'information' => $this->faker->realText(100),
            'created_at' => $this->faker->dateTimeBetween('-5 years', now(), 'Asia/Tokyo'),
            'updated_at' => $this->faker->dateTimeBetween('-5 years', now(), 'Asia/Tokyo'),
            'category_id' => Category::inRandomOrder()->first()?->id ?? 1, // ここが修正ポイント
            'area_id' => Area::inRandomOrder()->first()?->id ?? 1,
            'local' => $this->faker->streetAddress(),
            'on_off' => $this->faker->boolean(),
            'filename' => 'https://placehold.jp/150x150.png'

        ];
    }
}
