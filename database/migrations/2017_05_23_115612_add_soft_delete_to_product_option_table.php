<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSoftDeleteToProductOptionTable extends Migration
{
    /**
     * Run add soft delete to product option migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('products_option', function (Blueprint $table) {
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('products_option', function (Blueprint $table) {
            $table->dropColumn('deleted_at');
        });
    }
}
