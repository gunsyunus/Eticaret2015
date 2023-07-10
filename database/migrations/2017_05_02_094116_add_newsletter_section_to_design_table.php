<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddNewsletterSectionToDesignTable extends Migration
{
    /**
     * Run add newsletter section to design migrations.
     *
     * @return void
     */         
    public function up()
    {
        Schema::table('designs', function (Blueprint $table) {
            $table->text('newsletter_section');
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
            $table->dropColumn('newsletter_section');
        });
    }
}
