<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBannersElementTable extends Migration
{
    /**
     * Run banner elements migrations.
     *
     * @return void
     */      
    public function up()
    {
        Schema::create('banners_element', function (Blueprint $table) {
            $table->increments('id_element');
            $table->string('name', 50);
            $table->string('xleft', 10);
            $table->string('xtop', 10);
            $table->string('bg_color', 10);
            $table->string('text', 175);
            $table->string('text_color', 10);
            $table->string('text_size', 3);
            $table->integer('delay');
            $table->string('effect', 10);
            $table->integer('effect_delay');
            $table->string('video_url', 175);
            $table->string('image', 175);
            $table->string('type', 10);
            $table->integer('banner_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('banners_element');
    }
}
