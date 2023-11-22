<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStoresTable extends Migration
{
    public function up()
    {
        Schema::create('stores', function (Blueprint $table) {
            $table->id(); // Auto-increment ID
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->string('store_add'); // Store Address
            $table->string('city');
            $table->string('manager');  // Manager's Name            
			$table->string('mobile_no', 10); // Mobile Number
            $table->timestamps(); // Adds created_at and updated_at

            // If manager_user_id is a foreign key referencing users table:
            
        });
    }

    public function down()
    {
        Schema::dropIfExists('stores');
    }
}
?>