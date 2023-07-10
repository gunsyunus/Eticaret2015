<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddElementToBannerTable extends Migration
{
    /**
     * Run add element to banner migrations.
     *
     * @return void
     */     
    public function up()
    {
        Schema::table('banners', function (Blueprint $table) {
            $table->integer('delay')->default('5')->after('sort');
            $table->text('elements')->after('delay');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('banners', function (Blueprint $table) {
            $table->dropColumn('delay');
            $table->dropColumn('elements');
        });
    }
}
