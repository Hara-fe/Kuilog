<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Shop;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Image>
 */
class ImageFactory extends Factory
{
    public function definition(): array
    {
        return [
            'shop_id' => Shop::inRandomOrder()->first(), // 適切に調整
            'filename' => 'https://placehold.jp/150x150.png', // 画像ファイル名だけ
            'title' => $this->faker->sentence(3),
        ];
    }
}
