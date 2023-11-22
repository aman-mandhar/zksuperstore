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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('mobile_number')->unique(); // Using mobile number as unique identifier
            $table->string('ref_mobile_number')->default('0000000000'); // Using this mobile number for referral income.
            $table->tinyinteger('user_role')->default('0');  
            /**
            * USER ROLES
            * ----------
            * 0-Customer
            * 1-Admin
            * 2-Store
            * 3-Warehouse
            * 4-Sub-Warehouse
            * 5-Employee
            * 6-Merchant
            */
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('city');
            $table->string('gst_no')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
