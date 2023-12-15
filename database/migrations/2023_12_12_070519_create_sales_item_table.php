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
        Schema::create('sales_item', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('sales_id');
            $table->unsignedBigInteger('stock_id');
            $table->unsignedBigInteger('store_id')->nullable();
            $table->unsignedBigInteger('subwarehouse_id')->nullable();
            $table->unsignedBigInteger('warehouse_id')->nullable();
            $table->unsignedBigInteger('customer_id');
            $table->unsignedBigInteger('employee_id')->nullable();
            $table->unsignedBigInteger('ref_id');
            $table->decimal('measure', 8, 3)->nullable();
            $table->integer('tot_no_of_items')->nullable();
            $table->decimal('sale_price', 8, 2);
            $table->decimal('total_price', 8, 2);
            $table->decimal('points_ref', 8, 2)->nullable();
            $table->decimal('points_customer', 8, 2)->nullable();
            $table->decimal('points_store', 8, 2)->nullable();
            $table->decimal('discount', 8, 2);
            $table->decimal('gst', 8, 2);
            $table->decimal('grand_total', 8, 2);
            $table->string('remarks')->nullable();
            $table->string('status')->default('pending');
            $table->timestamps();

            $table->foreign('sales_id')->references('id')->on('sales')->onDelete('cascade');
            $table->foreign('stock_id')->references('id')->on('stocks')->onDelete('cascade');
            $table->foreign('store_id')->references('id')->on('stores')->onDelete('cascade');
            $table->foreign('subwarehouse_id')->references('id')->on('subwarehouses')->onDelete('cascade');
            $table->foreign('warehouse_id')->references('id')->on('warehouses')->onDelete('cascade');
            $table->foreign('customer_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('employee_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('ref_id')->references('id')->on('users')->onDelete('cascade');
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sales_item');
    }
};
