<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateShipmentTable extends Migration
{
    /**
     * Run shipment migrations.
     *
     * @return void
     */     
    public function up()
    {
        Schema::create('shipments', function (Blueprint $table) {
            $table->increments('id_shipment');
            $table->string('name', 75);
            $table->smallInteger('sort');
            $table->string('status', 1)->default('0');
            $table->string('image', 175);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('shipments');
    }
}
