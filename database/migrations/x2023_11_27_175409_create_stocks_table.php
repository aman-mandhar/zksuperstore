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
                $table->string('prod_pic');
                $table->string('name');
                $table->string('description')->nullable(); // Product Descrition
                $table->string('type')->default('packet');
                $table->string('prod_cat'); // Product category
                $table->decimal('measure', 10, 2)->nullable();
                $table->integer('tot_no_of_items')->nullable();
                $table->decimal('pur_value', 10, 2);
                $table->decimal('cgst', 10, 2)->nullable();
                $table->decimal('sgst', 10, 2)->nullable();
                $table->decimal('mrp', 10, 2);
                $table->decimal('sale_price', 10, 2);
                $table->string('gst')->nullable()->default('0'); //GST % applicable at item
                $table->integer('tot_points');
                $table->string('pur_bill_no')->nullable();
                $table->string('merchant')->nullable();                
                $table->unsignedBigInteger('user_id');
                $table->string('qrcode')->nullable();
                $table->timestamps();
    
                // Foreign key constraints
                $table->foreign('item_id')->references('id')->on('items');
                $table->foreign('user_id')->references('id')->on('users');
            }
    );
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stocks');
    }
};
