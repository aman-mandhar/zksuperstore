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
        Schema::create('Itemin', function (Blueprint $table) {
            $table->id(); // Auto-increment ID
            $table->foreign('name')->references('name')->on('items');
            $table->string('measure'); // Measurement unit (e.g., kg, liter, etc.)
            $table->string('qrcode')->nullable(); // QR Code, assuming it could be optional
            $table->integer('no_of_items'); // Number of items
            $table->decimal('pur_value', 8, 2); // Purchase value
            $table->decimal('mrp', 8, 2); // Maximum retail price
            $table->decimal('sale_price', 8, 2); // Sale price
            $table->integer('pts'); // Points
            $table->string('Location'); // Location (Warehouse?), assuming it could be optional
            $table->string('pur_bill_no'); // Purchase bill number
            $table->string('merchant'); // Merchant name or ID
            $table->string('sys_id')->unique(); // System ID, assuming it's unique
            $table->timestamps(); // Adds created_at and updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('itemin');
    }
};
