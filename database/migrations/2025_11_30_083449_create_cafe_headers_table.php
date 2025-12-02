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
        Schema::create('cafe_headers', function (Blueprint $table) {
            $table->id();
            $table->string('cafe_name');
            $table->string('cafe_tagline')->nullable();
            $table->string('coffee_emoji')->default('☕');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cafe_headers');
    }
};
