<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrderTable extends Migration
{
    /**
     * Run order migrations.
     *
     * @return void
     */     
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->increments('id_order');
            $table->string('name', 50);
            $table->string('surname', 50);
            $table->string('email', 150);
            $table->string('phone', 20);
            $table->string('gender', 1);
            $table->string('day', 1);
            $table->string('message', 200);
            $table->string('admin_message', 200);
            $table->string('ref_number', 30);
            $table->string('cart_number', 20);
            $table->string('device', 1)->default('W');
            $table->decimal('shipment_amount', 12, 2);
            $table->decimal('total_amount', 12, 2);
            $table->string('barcode_ean', 13);
            $table->string('ip', 64);
            $table->string('user_agent', 260);
            $table->string('last_name_update', 100);
            $table->integer('customer_id');
            $table->integer('customer_group');
            $table->integer('city_id');
            $table->integer('county_id');
            $table->integer('shipping_address_id');
            $table->integer('billing_address_id');
            $table->smallInteger('status_id')->default('1');
            $table->smallInteger('shipment_id');
            $table->smallInteger('payment_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('orders');
    }
}
