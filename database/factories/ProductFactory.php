<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Product>
 */
class ProductFactory extends Factory
{
  protected $model = Product::class;

  public function definition(): array
  {
    return [
      'user_id' => User::factory(),
      'code' => generateProductCode(),
      'name' => $this->faker->words(3, true),
      'description' => $this->faker->sentence(),
      'price' => $this->faker->randomFloat(2, 5, 200),
      'status' => 'pending',
    ];
  }
}

