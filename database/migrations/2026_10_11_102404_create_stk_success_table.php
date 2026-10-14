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
        Schema::create('stk_success', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('merchant_request_id');
            $table->string('checkout_request_id');
            $table->string('result_code');
            $table->string('result_desc');
            $table->string('amount');
            $table->string('mpesa_receipt_number');
            $table->string('balance')->nullable();
            $table->string('transaction_date');
            $table->string('phone_number');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stk_success');
    }
};
