<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSslToSettingTable extends Migration
{
    /**
     * Run add ssl to setting migrations.
     *
     * @return void
     */         
    public function up()
    {
        Schema::table('settings', function (Blueprint $table) {
            $table->string('ssl_status', 1)->default('0');
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
            $table->dropColumn('ssl_status');
        });
    }
}
