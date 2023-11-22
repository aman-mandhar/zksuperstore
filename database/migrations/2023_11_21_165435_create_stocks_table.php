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
            $table->string('name'); // Item Name - user will select it from the list followed by items table
            $table->unsignedBigInteger('item_id'); // Item_id - will be a hidden field in the form & autofill as per Item name
            $table->foreign('item_id')->references('id')->on('items');
            $table->decimal('measure', 8, 3)->default(0.0); // Measurement unit in kilograms and grams for loose items 
            $table->string('qrcode')->nullable(); // QR Code, assuming it could be optional
            $table->decimal('pur_value', 8, 2); // Purchase value
            $table->integer('tot_no_of_items')->default(0); // Total Number of items
            $table->decimal('mrp', 8, 2); // Maximum retail price
            $table->string('pur_bill_no'); // Purchase bill number (consider changing to a numeric type if it's numeric)
            $table->string('merchant'); // Otherwise auto-fill by merchant_id by the form
            $table->decimal('sale_price', 8, 2); // Sale price
            $table->decimal('tot_points', 8, 2); // Total Points
            $table->unsignedBigInteger('user_id'); // Current logged-in user ID at the time of creating the item 
            $table->foreign('user_id')->references('id')->on('users'); // Add this line for the user_id foreign key
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
