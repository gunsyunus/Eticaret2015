<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserTable extends Migration
{
    /**
     * Run user migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users_a', function (Blueprint $table) {
            $table->increments('id_user');
            $table->string('email', 75);
            $table->string('password', 100);
            $table->string('name', 50);
            $table->string('surname', 50);
            $table->smallInteger('role')->default('2');
            $table->timestamps();
            $table->rememberToken();
        });
    }
    
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('users_a');
    }
}
