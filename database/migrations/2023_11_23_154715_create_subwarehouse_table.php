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
        Schema::create('subwarehouses', function (Blueprint $table) {
            $table->id(); // Auto-increment ID
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->string('add'); // Store Address
            $table->string('city');
            $table->string('manager');  // Manager's Name            
			$table->string('mobile_no', 10); // Mobile Number
            $table->timestamps(); // Adds created_at and updated_at

            // user_id is a foreign key referencing users table:
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subwarehouse');
    }
};
