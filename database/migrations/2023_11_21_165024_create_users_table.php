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
            $table->string('name')->default('Not Set');
            $table->string('mobile_number', 10)->unique();
            $table->string('ref_mobile_number', 10)->default('0000000000');
            $table->tinyInteger('user_role')->default(0);  
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
            * 7-Transporter
            * 8-Delivery Partner
            * 9-Business Promoter
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
