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
        Schema::create('items', function (Blueprint $table) {
            $table->id(); // Auto-increment ID
            $table->string('name'); // Product name
            $table->float('gst')->default(0); // GST % applicable at item
            $table->string('description')->nullable(); // Product Description
            $table->string('type')->default('packet');
            $table->unsignedBigInteger('prod_cat'); // Reference to product_categories table
            $table->unsignedBigInteger('subcategory_id')->nullable(); // Reference to product_subcategories table
            $table->unsignedBigInteger('variation_id')->nullable(); // Reference to product_variations table
            $table->string('prod_pic')->nullable(); // Product picture (assuming you'd store the file path here)
            $table->timestamps();
        
            $table->foreign('subcategory_id')->references('id')->on('product_subcategories')->onDelete('set null');
            $table->foreign('variation_id')->references('id')->on('product_variations')->onDelete('set null');
            $table->foreign('prod_cat')->references('id')->on('product_categories')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('items');
    }
};
