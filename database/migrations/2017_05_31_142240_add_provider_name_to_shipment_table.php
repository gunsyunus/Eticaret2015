<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddProviderNameToShipmentTable extends Migration
{
    /**
     * Run add provider name to shipment migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('shipments', function (Blueprint $table) {
            $table->string('provider_name', 20)->default('Tanımsız')->after('name');
            $table->string('provider_service_url', 250)->after('provider_name');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('shipments', function (Blueprint $table) {
            $table->dropColumn('provider_name');
            $table->dropColumn('provider_service_url');
        });
    }
}
