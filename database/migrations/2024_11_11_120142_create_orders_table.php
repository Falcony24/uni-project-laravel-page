<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        if (Schema::hasTable('orders')) { return; }
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->double('total_price');
            $table->foreignId('user_id')->constrained('users');
            $table->foreignId('shipment_id')->constrained('shipments');
            $table->foreignId('payment_id')->constrained('payments');
        });
    }

    public function down(): void {
        Schema::dropIfExists('orders');
    }
};
