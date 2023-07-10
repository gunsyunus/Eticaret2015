<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCouponTable extends Migration
{
    /**
     * Run campaign / coupon module migrations.
     *
     * @return void
     */    
    public function up()
    {
        Schema::create('coupons', function (Blueprint $table) {
            $table->increments('id_coupon');
            $table->string('code', 50);
            $table->decimal('total', 12, 2);
            $table->decimal('discount_money', 12, 2);
            $table->string('discount_percent', 2);
            $table->integer('stock');
            $table->string('type', 10);
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
        Schema::drop('coupons');
    }
}
