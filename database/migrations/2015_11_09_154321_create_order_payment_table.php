<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrderPaymentTable extends Migration
{
    /**
     * Run order payment migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders_payment', function (Blueprint $table) {
            $table->increments('id_payment');
            $table->string('name', 75);
            $table->smallInteger('sort');
            $table->string('status', 1)->default('0');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('orders_payment');
    }
}
