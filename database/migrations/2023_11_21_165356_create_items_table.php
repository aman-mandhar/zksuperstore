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
            $table->string('prod_cat'); // Product category
            $table->string('prod_pic')->nullable(); // Product picture (assuming you'd store the file path here)
            $table->timestamps();
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
