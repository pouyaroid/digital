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
        Schema::table('menu_settings', function (Blueprint $table) {
            $table->boolean('cash_payment_enabled')->default(true);
            $table->boolean('online_payment_enabled')->default(true);
        });
    }
    
    public function down(): void
    {
        Schema::table('menu_settings', function (Blueprint $table) {
            $table->dropColumn(['cash_payment_enabled', 'online_payment_enabled']);
        });
    }
};
