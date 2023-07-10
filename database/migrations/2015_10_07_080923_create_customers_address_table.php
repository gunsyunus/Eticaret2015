<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomersAddressTable extends Migration
{
    /**
     * Run customer address migrations.
     *
     * @return void
     */     
    public function up()
    {
        Schema::create('customers_address', function (Blueprint $table) {
            $table->increments('id_address');
            $table->string('title', 50);
            $table->string('phone', 20);
            $table->string('address_1', 175);
            $table->string('address_2', 175);
            $table->integer('city_id');
            $table->integer('county_id');
            $table->integer('user_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('customers_address');
    }
}
