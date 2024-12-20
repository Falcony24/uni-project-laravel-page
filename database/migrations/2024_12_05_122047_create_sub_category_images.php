<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void{
        if (Schema::hasTable('sub_categories_images')) {
            return;
        }
        Schema::create('sub_categories_images', function (Blueprint $table) {
            $table->id();
            $table->string('file_path');
            $table->string('file_name');
            $table->foreignId('sub_categories_id')->constrained('sub_categories');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('sub_categories_images');
    }
};
