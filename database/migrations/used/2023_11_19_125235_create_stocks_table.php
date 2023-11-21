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
            $table->string('item_id'); // Item_id - will be hidden field at form & autofill as per Item name
            $table->decimal('measure', 8, 3)->nullable(); // Measurement unit in kilograms and grams for loose items 
            $table->string('qrcode')->nullable(); // QR Code, assuming it could be optional
            $table->decimal('pur_value', 8, 2); // Purchase value
            $table->integer('tot_no_of_items'); // Total Number of items
            $table->decimal('mrp', 8, 2); // Maximum retail price
            $table->decimal('gst', 8, 2)->nullable(); // GST Paid
            $table->decimal('cgst', 8, 2)->nullable(); // CGST Paid
            $table->decimal('transit_charges', 8, 2)->nullable(); // If there is any transport charges
            $table->decimal('tot_pur_value', 8, 2); // Total Purchase value
            $table->string('pur_bill_no'); // Purchase bill number
            $table->string('merchant')->nullable()->default('Open Market'); // Other wise auto fill by merchant_id by form
            $table->decimal('sale_price', 8, 2); // Sale price
            $table->decimal('tot_issued_points', 8, 2)->default('0.00'); // Total Points
            $table->string('wh_id'); // Current logged in user Id at the time of create item 
            $table->string('sub_wh_id')->nullable(); // Id of Sub-Warehouse
            $table->string('store_id')->nullable(); // Id of Store
            $table->string('customer_id')->nullable(); // Id of Customer 
            $table->string('ref_id')->nullable(); // Refferal Id for calculating commission
            $table->string('order_id')->nullable(); // Sale Order Id 
            $table->timestamp('order_date')->nullable(); // Sale order date and time
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
