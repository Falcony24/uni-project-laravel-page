<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        if (Schema::hasTable('payments')) { return; }
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->string('method');
            $table->double('amount');
            $table->timestamps();
            $table->foreignId('user_id')->constrained('users');
        });
    }

    public function down(): void {
        Schema::dropIfExists('payments');
    }
};
