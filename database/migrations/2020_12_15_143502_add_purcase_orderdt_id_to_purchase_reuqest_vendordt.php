<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddPurcaseOrderdtIdToPurchaseReuqestVendordt extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('purchase_request_vendordt', function (Blueprint $table) {
            //
            $table->bigInteger('purchase_orderdt_id')->after('purchase_request_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('purchase_request_vendordt', function (Blueprint $table) {
            //
        });
    }
}
