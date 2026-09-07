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
        Schema::create('product', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string("product-name", 60);
            $table->string("product-description", 60);
            $table->string("product-category", 60);
            $table->string("product-brand", 60)->nullable(true);
            $table->string("product-cupon", 60)->nullable(true);
            $table->string("product-tags", 60)->nullable(true);
            $table->string("product-color", 60);
            $table->integer("product-price");
            $table->integer("product-count");
            $table->integer("product-discount")->nullable(true);
            $table->integer("product-size")->nullable(true);
            $table->integer("product-rating");
            $table->string("product-image", 60);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product');
    }
};
