<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Shop>
 */
class ShopFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            //
            'owner_id'=>User::factory(),
            'name'=>$this->faker->company(),
            'information'=>$this->faker->realText(20),
            'created_at' => $this->faker->dateTimeBetween('-5 years',new Carbon(),'Asia/Tokyo'),
            'updated_at' => $this->faker->dateTimeBetween('-5 years', new Carbon(), 'Asia/Tokyo'),
            'category_id'=>Category::factory(),
            'area_id'=>Area::factory(),
            'local'=>$this->faker->streetAddress(),
            'on_off'=>$this->faker->boolean()
        ];
    }
}
