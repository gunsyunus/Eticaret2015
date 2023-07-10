<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserSocialAccountTable extends Migration
{
    /**
     * Run user social accounts migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users_social_account', function (Blueprint $table) {
            $table->increments('id_account');
            $table->string('provider', 16);
            $table->string('provider_user_id', 64);
            $table->integer('user_id');
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
        Schema::drop('users_social_account');
    }
}
