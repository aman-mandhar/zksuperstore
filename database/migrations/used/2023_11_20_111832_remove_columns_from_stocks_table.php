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
        Schema::table('stocks', function (Blueprint $table) {
        $table->dropColumn('sub_wh_id');
        $table->dropColumn('store_id');
        $table->dropColumn('customer_id');
        $table->dropColumn('ref_id');
        $table->dropColumn('order_id');
        $table->dropColumn('order_date');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('stocks', function (Blueprint $table) {
        $table->string('sub_wh_id')->nullable();
        $table->string('store_id')->nullable();
        $table->string('customer_id')->nullable();
        $table->string('ref_id')->nullable();
        $table->string('order_id')->nullable();
        $table->timestamp('order_date')->nullable();
        });
    }
};
