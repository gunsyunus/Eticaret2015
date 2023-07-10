<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRateTable extends Migration
{
    /**
     * Run product rate migrations.
     *
     * @return void
     */     
    public function up()
    {
        Schema::create('rates', function (Blueprint $table) {
            $table->increments('id_rate');
            $table->string('name', 50);
            $table->decimal('amount', 12, 4);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('rates');
    }
}
