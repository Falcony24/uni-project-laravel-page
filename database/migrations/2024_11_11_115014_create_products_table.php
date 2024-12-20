<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        if (Schema::hasTable('products')) { return; }
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->boolean('stock');
            $table->double('price');
            $table->longText('description');
            $table->foreignId('sub_category_id')->constrained('sub_categories');
            $table->foreignId('brand_id')->constrained('brands');
        });
    }

    public function down(): void {
        Schema::dropIfExists('products');
    }
};
