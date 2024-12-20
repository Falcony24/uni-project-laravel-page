<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder {
    public function run(){
        \App\Models\Category::factory(12)->create();
        \App\Models\SubCategory::factory(6)->create();
        \App\Models\Brand::factory(6)->create();
        \App\Models\Product::factory(50)->create();
    }
}
