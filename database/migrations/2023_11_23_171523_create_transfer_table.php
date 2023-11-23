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
        Schema::create('transfers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('item_id');
            $table->foreign('item_id')->references('id')->on('stocks');
            $table->integer('qty')->nullable();
            $table->decimal('weight', 8,3)->nullable();
            $table->unsignedBigInteger('subwarehouse_id')->nullable();
            $table->foreign('subwarehouse_id')->references('id')->on('subwarehouses');
            $table->unsignedBigInteger('retail_id')->nullable();
            $table->foreign('retail_id')->references('id')->on('stores');
            $table->unsignedBigInteger('customer_id')->nullable();
            $table->foreign('customer_id')->references('id')->on('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transfers');
    }
};
