<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomerTable extends Migration
{
    /**
     * Run customer migrations.
     *
     * @return void
     */    
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->increments('id_customer');
            $table->string('phone', 20);
            $table->string('phone_other', 20);
            $table->string('gender', 1);
            $table->string('newsletter_status', 1)->default('0');
            $table->string('register_device', 1)->default('W');
            $table->smallInteger('stock_order');
            $table->integer('city_id');
            $table->integer('user_id');
            $table->date('birth_at');
            $table->timestamp('login_at');
            $table->timestamp('order_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('customers');
    }
}
