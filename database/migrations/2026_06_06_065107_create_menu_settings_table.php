<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('menu_settings', function (Blueprint $table) {
            $table->id();

            $table->boolean('ordering_enabled')->default(true);
            $table->boolean('show_prices')->default(true);
            $table->boolean('show_calories')->default(true);

            $table->string('theme_color')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('menu_settings');
    }
};