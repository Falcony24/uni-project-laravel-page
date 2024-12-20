<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        if (Schema::hasTable('addresses')) { return; }
        Schema::create('addresses', function (Blueprint $table) {
            $table->id();
            $table->string('name', 255);
            $table->string('surname', 255);
            $table->string('city', 255);
            $table->string('postal_code', 255);
            $table->string('street', 255);
            $table->string('number', 255);
            $table->string('phone_number', 255);
            $table->foreignId('user_id')->constrained('users');
        });
    }

    public function down(): void {
        Schema::dropIfExists('addresses');
    }
};
