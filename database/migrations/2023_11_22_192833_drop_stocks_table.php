<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

class DropStocksTable extends Migration
{
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('stocks');
    }
}
