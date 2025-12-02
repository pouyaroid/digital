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
        Schema::create('cafe_items', function (Blueprint $table) {
            $table->id();

            // دسته‌بندی
            $table->foreignId('category_id')->constrained('cafe_categories')->onDelete('cascade');

            // اطلاعات اصلی
            $table->string('name');
            $table->text('description')->nullable();

            // قیمت‌ها
            $table->integer('price')->default(0);
            $table->integer('discount_price')->nullable(); // قیمت تخفیف‌دار

            // ویژگی‌های اضافه
            $table->string('image')->nullable(); // مسیر عکس
            $table->string('tags')->nullable(); // مثل: ویژه، جدید، پرفروش
            $table->integer('calories')->nullable(); // کالری
            $table->integer('order')->default(0); // اولویت نمایش

            // وضعیت
            $table->boolean('is_available')->default(true);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cafe_items');
    }
};
