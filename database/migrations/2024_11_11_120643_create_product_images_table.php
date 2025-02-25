<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        if (Schema::hasTable('product_images')) { return; }
        Schema::create('product_images', function (Blueprint $table) {
            $table->id();
            $table->string('file_path');
            $table->string('file_name');
            $table->foreignId('product_id')->constrained('products');
        });
    }

    public function down(): void {
        Schema::dropIfExists('product_images');
    }
};
