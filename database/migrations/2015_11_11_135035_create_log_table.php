<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLogTable extends Migration
{
    /**
     * Run user log migrations.
     *
     * @return void
     */     
    public function up()
    {
        Schema::create('users_log', function (Blueprint $table) {
            $table->increments('id_log');
            $table->string('ip', 64);
            $table->string('process_text', 200);
            $table->string('user_email', 50);
            $table->integer('user_id');
            $table->timestamp('process_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('users_log');
    }
}
