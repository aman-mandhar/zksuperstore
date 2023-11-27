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
                $table->integer('items_required');
                $table->string('name');
                $table->decimal('measure', 10, 2)->nullable();
                $table->integer('tot_no_of_items')->nullable();
                $table->string('qrcode')->nullable();
                $table->decimal('pur_value', 10, 2);
                $table->decimal('cgst', 10, 2)->nullable();
                $table->decimal('sgst', 10, 2)->nullable();
                $table->decimal('mrp', 10, 2);
                $table->decimal('sale_price', 10, 2);
                $table->string('pur_bill_no')->nullable();
                $table->string('merchant')->nullable();
                $table->integer('tot_points');
                $table->unsignedBigInteger('user_id');
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
