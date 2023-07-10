<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCountiesTable extends Migration
{
    /**
     * Run county migrations.
     *
     * @return void
     */     
    public function up()
    {
        Schema::create('counties', function (Blueprint $table) {
            $table->increments('id_county');
            $table->string('name', 50);
            $table->string('city_id', 6);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('counties');
    }
}
