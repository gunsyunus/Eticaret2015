<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddAgreementToSettingTable extends Migration
{
    /**
     * Run add agreement cancel url to setting migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('settings', function (Blueprint $table) {
            $table->string('agreement_cancel_url', 150)->default('#')->after('agreement_user_url');
            $table->string('agreement_order_title', 70)->after('bank_transfer_url');
            $table->text('agreement_order_content')->after('agreement_order_title');
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
            $table->dropColumn('agreement_cancel_url');
            $table->dropColumn('agreement_order_title');
            $table->dropColumn('agreement_order_content');
        });
    }
}
