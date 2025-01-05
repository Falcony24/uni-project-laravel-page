<?php

namespace Database\Factories;

use App\Models\Addresses;
use Illuminate\Database\Eloquent\Factories\Factory;

class BrandFactory extends Factory {
    protected $model = Addresses::class;
    public function definition(): array{
        return [
            'name' => $this->faker->name(),
        ];
    }
}
