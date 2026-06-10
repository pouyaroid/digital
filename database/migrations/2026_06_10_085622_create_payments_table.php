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
        Schema::create('payments', function (Blueprint $table) {

            $table->id();
        
            $table->foreignId('order_id')->constrained()->cascadeOnDelete();
        
            $table->string('gateway')->nullable(); // zarinpal, payping
        
            $table->string('transaction_id')->nullable(); // authority
            $table->string('ref_id')->nullable(); // کد نهایی پرداخت
        
            $table->integer('amount');
        
            $table->enum('status', [
                'pending',
                'success',
                'failed'
            ])->default('pending');
        
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
