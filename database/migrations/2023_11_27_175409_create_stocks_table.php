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
            $table->id();
            $table->unsignedBigInteger('item_id');
            $table->unsignedBigInteger('subcategory_id')->nullable();
            $table->unsignedBigInteger('variation_id')->nullable();
            $table->decimal('measure', 8, 3)->nullable();
            $table->integer('tot_no_of_items')->nullable();
            $table->decimal('pur_value', 8, 2);
            $table->decimal('gst');
            $table->decimal('mrp', 8, 2);
            $table->decimal('sale_price', 8, 2);
            $table->decimal('tot_points', 8, 2);
            $table->string('prod_cat')->nullable(); // This field can be removed if you have 'subcategory_id'
            $table->string('type')->nullable(); // This field can be removed if you have 'variation_id'
            $table->string('pur_bill_pic')->nullable();
            $table->string('pur_bill_no')->nullable();
            $table->date('pur_date')->nullable();
            $table->string('merchant')->nullable();
            $table->string('qrcode')->nullable();
            $table->string('barcode')->nullable();
            $table->string('batch_no')->nullable();
            $table->date('mfg_date')->nullable();
            $table->date('exp_date')->nullable();
            $table->string('status')->nullable();
            $table->string('remarks')->nullable();
            $table->unsignedBigInteger('user_id');
            $table->timestamps();
        
            $table->foreign('item_id')->references('id')->on('items')->onDelete('cascade');
            $table->foreign('subcategory_id')->references('id')->on('product_subcategories')->onDelete('set null');
            $table->foreign('variation_id')->references('id')->on('product_variations')->onDelete('set null');
            $table->foreign('user_id')->references('id')->on('users');
        
            // Add any other fields as needed
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
