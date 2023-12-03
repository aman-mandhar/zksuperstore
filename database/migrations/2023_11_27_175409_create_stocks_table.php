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
            $table->foreignId('item_id')->constrained(); // Assuming you have an 'items' table
            $table->string('prod_pic');
            $table->string('name');
            $table->text('description');
            $table->string('type');
            $table->string('prod_cat');
            $table->string('measure')->nullable();
            $table->integer('tot_no_of_items')->nullable();
            $table->decimal('pur_value', 10, 2);
            $table->decimal('gst_paid', 8, 2)->nullable()->default('0.00');
            $table->decimal('mrp', 10, 2);
            $table->decimal('sale_price', 10, 2);
            $table->string('gst');
            $table->decimal('tot_points', 10, 2);
            $table->string('pur_bill_no');
            $table->string('merchant');
            $table->foreignId('user_id')->constrained(); // Assuming you have a 'users' table
            $table->string('qrcode')->nullable();
            $table->timestamps();

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
