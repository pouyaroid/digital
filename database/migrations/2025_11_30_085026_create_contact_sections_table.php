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
        Schema::create('contact_sections', function (Blueprint $table) {
            $table->id();

            // اطلاعات تماس
            $table->string('address')->nullable();
            $table->string('phone')->nullable();
            $table->string('working_hours')->nullable();

            // شبکه‌های اجتماعی
            $table->string('instagram_url')->nullable();
            $table->string('instagram_label')->nullable()->default('اینستاگرام');

            $table->string('telegram_url')->nullable();
            $table->string('telegram_label')->nullable()->default('تلگرام');

            $table->timestamps();
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contact_sections');
    }
};
