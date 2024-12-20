<?php

namespace Database\Factories;

use App\Models\SubCategory;
use Illuminate\Database\Eloquent\Factories\Factory;

class SubCategoryFactory extends Factory{
    protected $model = SubCategory::class;
    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'category_id' => $this->faker->numberBetween(1, 10),
        ];
    }
}
