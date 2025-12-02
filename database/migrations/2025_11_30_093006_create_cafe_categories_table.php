<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('cafe_categories', function (Blueprint $table) {
            $table->id();
            $table->string('name');        // عنوان دسته
            $table->string('icon')->nullable(); // آیکن اختیاری
            $table->integer('order')->default(0); // ترتیب دسته‌ها
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cafe_categories');
    }
};
