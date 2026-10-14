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
        Schema::create('orders', function (Blueprint $table) {
            $table->id("order-id");
            $table->timestamps();
            $table->string('products-bought');
            $table->string('products-count');
            $table->string('customer-name');
            $table->string('customer-email');
            $table->string('customer-phone');
            $table->string('customer-location');
            $table->string('payment-mode');
            $table->integer('payment-amount');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
