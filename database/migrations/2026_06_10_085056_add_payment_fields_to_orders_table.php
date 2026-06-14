<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('orders', function (Blueprint $table) {

            $table->enum('payment_status', [
                'unpaid',
                'paid',
                'failed',
                'refunded'
            ])->default('unpaid')->after('status');

            $table->enum('payment_method', [
                'online',
                'cash'
            ])->default('online')->after('payment_status');

        });
    }

    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn(['payment_status', 'payment_method']);
        });
    }
};