<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    public function definition()
    {
        return [
            'sku' => $this->faker->unique()->numerify('SKU-#####'),
            'slug' => $this->faker->slug,
            'price' => $this->faker->randomFloat(2, 10, 100),
            'meta_title' => $this->faker->sentence,
            'meta_description' => $this->faker->paragraph,
        ];
    }
}
