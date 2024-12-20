<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void{
        if (Schema::hasTable('brands')) { return; }
        Schema::create('brands', function (Blueprint $table) {
            $table->id();
            $table->string('name', 255)->unique();
        });
    }

    public function down(): void{
        Schema::dropIfExists('brands');
    }
};
