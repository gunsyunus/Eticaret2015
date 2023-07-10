<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddBannerToDesignTable extends Migration
{
    /**
     * Run add banner to design migrations.
     *
     * @return void
     */         
    public function up()
    {
        Schema::table('designs', function (Blueprint $table) {
            $table->smallInteger('banner_width')->default('1920');
            $table->smallInteger('banner_height')->default('410');
            $table->smallInteger('banner_scene_width')->default('1150');
            $table->string('banner_effect_type', 10)->default('basic');
            $table->string('banner_buttons', 25)->default('default');
            $table->boolean('banner_arrows');
            $table->boolean('banner_timebar');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('designs', function (Blueprint $table) {
            $table->dropColumn('banner_width');
            $table->dropColumn('banner_height');
            $table->dropColumn('banner_scene_width');
            $table->dropColumn('banner_effect_type');
            $table->dropColumn('banner_buttons');
            $table->dropColumn('banner_arrows');
            $table->dropColumn('banner_timebar');
        });
    }
}
