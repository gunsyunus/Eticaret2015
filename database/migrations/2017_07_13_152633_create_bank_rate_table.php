<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBankRateTable extends Migration
{
    /**
     * Run bank rate migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('banks_rate', function (Blueprint $table) {
            $table->increments('id_rate');
            $table->integer('installment');
            $table->decimal('rate', 12, 2);
            $table->integer('group_id');
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
        Schema::drop('banks_rate');
    }
}
