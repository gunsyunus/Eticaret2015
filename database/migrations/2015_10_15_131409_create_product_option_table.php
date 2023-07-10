<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductOptionTable extends Migration
{
    /**
     * Run product options migrations.
     *
     * @return void
     */     
    public function up()
    {
        Schema::create('products_option', function (Blueprint $table) {
            $table->increments('id_option');
            $table->string('name', 175);
            $table->string('code', 100);
            $table->decimal('price', 12, 2);
            $table->integer('stock');
            $table->string('shelf_code', 50);
            $table->string('barcode_ean', 13);
            $table->string('barcode_upc', 12);
            $table->string('barcode_jan', 13);
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
        Schema::drop('products_option');
    }
}
