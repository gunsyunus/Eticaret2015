<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoryTable extends Migration
{
    /**
     * Run product category migrations.
     *
     * @return void
     */     
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->increments('id_category');
            $table->string('name', 100);
            $table->string('sef_url', 175);
            $table->smallInteger('sort')->default('9999');
            $table->string('title', 70);
            $table->string('keyword', 260);
            $table->string('description', 160);
            $table->integer('parent_id')->nullable()->index();
            $table->integer('lft')->nullable()->index();
            $table->integer('rgt')->nullable()->index();
            $table->integer('depth')->nullable();
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
        Schema::drop('categories');
    }
}
