<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBankRateGroupTable extends Migration
{
    /**
     * Run bank rate group migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('banks_rate_group', function (Blueprint $table) {
            $table->increments('id_group');
            $table->string('name', 75);
            $table->smallInteger('sort');
            $table->string('status', 1)->default('0');
            $table->string('image', 175);
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
        Schema::drop('banks_rate_group');
    }
}
