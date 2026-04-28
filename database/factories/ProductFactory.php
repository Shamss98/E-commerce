<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'slug' => $this->faker->slug(),
            'description' => $this->faker->paragraph(),
            'price' => $this->faker->numberBetween(100, 1000),
            'discount' => $this->faker->numberBetween(0, 500),
            'category_id' => $this->faker->numberBetween(1, 2),
            'status' => $this->faker->boolean(),
            'image' => 'images/products/herosection.jpg',
        ];
    }
}
