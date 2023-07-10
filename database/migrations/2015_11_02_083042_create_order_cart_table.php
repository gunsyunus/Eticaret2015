<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrderCartTable extends Migration
{
    /**
     * Run order cart migrations.
     *
     * @return void
     */      
    public function up()
    {
        Schema::create('orders_cart', function (Blueprint $table) {
            $table->increments('id_cart');
            $table->string('name', 175);
            $table->string('option_name', 175);
            $table->integer('stock');
            $table->decimal('price', 12, 2);
            $table->decimal('total', 12, 2);
            $table->smallInteger('tax');
            $table->string('created_time', 5);
            $table->string('status', 1)->default('0');
            $table->string('cart_number', 20);
            $table->integer('product_id');
            $table->integer('product_option_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('orders_cart');
    }
}
