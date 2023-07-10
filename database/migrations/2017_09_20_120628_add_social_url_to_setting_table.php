<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSocialUrlToSettingTable extends Migration
{
    /**
     * Run add social url to setting migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('settings', function (Blueprint $table) {
            $table->string('social_instagram_url', 150)->default('#')->after('social_youtube_url');
            $table->string('social_pinterest_url', 150)->default('#')->after('social_instagram_url');
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
            $table->dropColumn('social_instagram_url');
            $table->dropColumn('social_pinterest_url');
        });
    }
}
