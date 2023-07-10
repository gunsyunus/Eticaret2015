<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCouponToOrderTable extends Migration
{
    /**
     * Run add coupon to order migrations.
     *
     * @return void
     */         
    public function up()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->string('coupon_code', 50)->default('-')->after('device');
            $table->decimal('discount_amount', 12, 2)->after('shipment_amount');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn('coupon_code');
            $table->dropColumn('discount_amount');
        });
    }
}
