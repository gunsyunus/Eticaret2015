<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBankTable extends Migration
{
    /**
     * Run bank migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('banks', function (Blueprint $table) {
            $table->increments('id_bank');
            $table->string('name', 50);
            $table->string('customer_text', 30);
            $table->string('customer_number', 50);
            $table->string('merchant_text', 30);
            $table->string('merchant_number', 50);
            $table->string('username_text', 30);
            $table->string('username', 75);
            $table->string('password_text', 30);
            $table->string('password', 75);
            $table->string('secure_verify_status', 1)->default('0');
            $table->string('status', 1)->default('0');
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
        Schema::drop('banks');
    }
}
