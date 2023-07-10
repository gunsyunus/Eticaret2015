<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePageTable extends Migration
{
    /**
     * Run page migrations.
     *
     * @return void
     */     
    public function up()
    {
        Schema::create('pages', function (Blueprint $table) {
            $table->increments('id_page');
            $table->string('title', 70);
            $table->string('keyword', 260);
            $table->string('description', 160);
            $table->text('content');
            $table->smallInteger('sort');
            $table->string('status', 1)->default('0');
            $table->string('sef_url', 150);
            $table->string('section_id', 3);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('pages');
    }
}
