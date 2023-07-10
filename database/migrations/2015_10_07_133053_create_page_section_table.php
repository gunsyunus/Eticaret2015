<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePageSectionTable extends Migration
{
    /**
     * Run page section migrations.
     *
     * @return void
     */     
    public function up()
    {
        Schema::create('pages_section', function (Blueprint $table) {
            $table->increments('id_section');
            $table->string('name', 50);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('pages_section');
    }
}
