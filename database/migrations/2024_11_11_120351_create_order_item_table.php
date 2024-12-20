<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        if (Schema::hasTable('order_item')) { return; }
        Schema::create('order_item', function (Blueprint $table) {
            $table->id();
            $table->integer('quantity');
            $table->double('price');
            $table->foreignId('product_id')->constrained('products');
            $table->foreignId('order_id')->constrained('orders');
        });
    }

    public function down(): void {
        Schema::dropIfExists('order_item');
    }
};
