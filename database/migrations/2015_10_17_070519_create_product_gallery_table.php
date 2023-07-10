<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductGalleryTable extends Migration
{
    /**
     * Run product image gallery migrations.
     *
     * @return void
     */     
    public function up()
    {
        Schema::create('products_gallery', function (Blueprint $table) {
            $table->increments('id_gallery');
            $table->string('image_small', 175);
            $table->string('image_big', 175);
            $table->string('product_id', 6);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('products_gallery');
    }
}
