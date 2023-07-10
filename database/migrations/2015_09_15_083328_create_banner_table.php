<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBannerTable extends Migration
{
    /**
     * Run banner migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('banners', function (Blueprint $table) {
            $table->increments('id_banner');
            $table->string('title', 100);
            $table->string('image', 175);
            $table->string('url', 175)->default('#');
            $table->string('text', 200);
            $table->smallInteger('sort');
            $table->string('status', 1);
            $table->string('type', 25);
            $table->integer('category_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('banners');
    }
}
