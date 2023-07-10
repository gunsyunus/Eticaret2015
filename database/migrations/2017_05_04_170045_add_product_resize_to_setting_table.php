<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddProductResizeToSettingTable extends Migration
{
    /**
     * Run add product resize to setting migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('settings', function (Blueprint $table) {
            $table->smallInteger('product_small_width')->default('265');
            $table->smallInteger('product_small_height')->default('265');
            $table->smallInteger('product_big_width')->default('800');
            $table->smallInteger('product_big_height')->default('800');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('settings', function (Blueprint $table) {
            $table->dropColumn('product_small_width');
            $table->dropColumn('product_small_height');
            $table->dropColumn('product_big_width');
            $table->dropColumn('product_big_height');
        });
    }
}
