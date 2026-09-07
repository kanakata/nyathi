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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string("product_name", 60);
            $table->string("product_description", 150);
            $table->string("product_category", 60);
            $table->string("product_brand", 60)->nullable(true);
            $table->string("product_cupon", 60)->nullable(true);
            $table->string("product_tags", 60)->nullable(true);
            $table->string("product_color", 60);
            $table->integer("product_price");
            $table->integer("product_count");
            $table->integer("product_discount")->nullable(true);
            $table->string("product_sizes", 60)->nullable(true);
            $table->integer("product_rating");
            $table->string("product_image", 60);
            $table->string("product_images", 255);
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
