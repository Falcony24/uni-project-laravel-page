<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory {
    protected $model = Product::class;
    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'description' => $this->faker->text(),
            'price' => $this->faker->numberBetween(10, 1000),
            'sub_category_id' => $this->faker->numberBetween(1, 4),
            'brand_id' => $this->faker->numberBetween(1, 4),
        ];
    }
}
