<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddThemeColorsToDesignTable extends Migration
{
    /**
     * Run add theme colors to design migrations.
     *
     * @return void
     */         
    public function up()
    {
        Schema::table('designs', function (Blueprint $table) {
            $table->text('theme_colors');
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
            $table->dropColumn('theme_colors');
        });
    }
}
