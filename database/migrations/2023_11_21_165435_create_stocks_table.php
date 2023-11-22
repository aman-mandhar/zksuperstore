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
        Schema::create('stocks', function (Blueprint $table) {
            $table->id(); // Auto-increment ID
            $table->string('name'); // Item Name - user will select it from list followed by items table
            $table->unsignedBigInteger('item_id'); // Item_id - will be hidden field at form & autofill as per Item name
            $table->foreign('item_id')->references('id')->on('items');
            $table->decimal('measure', 8, 3)->nullable(); // Measurement unit in kilograms and grams for loose items 
            $table->string('qrcode')->nullable(); // QR Code, assuming it could be optional
            $table->decimal('pur_value', 8, 2)->nullable(); // Purchase value
            $table->integer('tot_no_of_items')->nullable(); // Total Number of items
            $table->decimal('mrp', 8, 2)->nullable(); // Maximum retail price
            $table->string('pur_bill_no')->default('Open Market')->nullable(); // Purchase bill number
            $table->string('merchant')->nullable(); // Other wise auto fill by merchant_id by form
            $table->decimal('sale_price', 8, 2)->nullable(); // Sale price
            $table->decimal('tot_points', 8, 2)->nullable(); // Total Points
            $table->string('wh_id'); // Current logged in user Id at the time of create item 
            $table->timestamps(); // Adds created_at and updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stocks');
    }
};
