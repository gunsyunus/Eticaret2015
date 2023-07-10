<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrderStatusTable extends Migration
{
    /**
     * Run order status migrations.
     *
     * @return void
     */     
    public function up()
    {
        Schema::create('orders_status', function (Blueprint $table) {
            $table->increments('id_status');
            $table->string('name', 75);
            $table->smallInteger('sort');
            $table->string('color', 10)->default('default');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('orders_status');
    }
}
