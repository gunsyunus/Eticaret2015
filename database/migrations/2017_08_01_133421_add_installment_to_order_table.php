<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddInstallmentToOrderTable extends Migration
{
    /**
     * Run add installment to order migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->string('installment', 2)->after('coupon_code');
            $table->decimal('installment_rate', 12, 2)->after('installment');
            $table->decimal('installment_amount', 12, 2)->after('installment_rate');
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
            $table->dropColumn('installment');
            $table->dropColumn('installment_rate');
            $table->dropColumn('installment_amount');
        });
    }
}
