<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        if (Schema::hasTable('shipments')) { return; }
        Schema::create('shipments', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignId('address_id')->constrained('addresses');
        });
    }

    public function down(): void {
        Schema::dropIfExists('shipments');
    }
};
