<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('product_categories', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            // Add any other relevant fields for your categories
            $table->timestamps();
        });

        Schema::create('product_subcategories', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('category_id');
            $table->string('name');
            // Add any other relevant fields for your subcategories
            $table->timestamps();

            $table->foreign('category_id')->references('id')->on('product_categories')->onDelete('cascade');
        });

        Schema::create('product_variations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('subcategory_id');
            $table->string('color')->nullable();
            $table->string('size')->nullable();
            // Add any other relevant fields for your variations
            $table->timestamps();

            $table->foreign('subcategory_id')->references('id')->on('product_subcategories')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('product_variations');
        Schema::dropIfExists('product_subcategories');
        Schema::dropIfExists('product_categories');
    }
};
