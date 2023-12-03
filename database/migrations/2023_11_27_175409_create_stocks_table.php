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
            $table->text('description');
            $table->string('type');
            $table->string('prod_cat');
            $table->decimal('measure')->nullable();
            $table->integer('tot_no_of_items')->nullable();
            $table->decimal('pur_value');
            $table->decimal('gst');
            $table->decimal('mrp');
            $table->decimal('sale_price');
            $table->decimal('tot_points');
            $table->string('pur_bill_no')->nullable();
            $table->unsignedBigInteger('merchant');
            $table->unsignedBigInteger('user_id');
            $table->string('qrcode')->nullable();
            $table->timestamps();

            $table->foreign('item_id')->references('id')->on('items')->onDelete('cascade');
            $table->foreign('merchant')->references('id')->on('users');
            $table->foreign('user_id')->references('id')->on('users');

            // Add any other fields as needed
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
