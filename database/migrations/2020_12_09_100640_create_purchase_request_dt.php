<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePurchaseRequestDt extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchase_request_dt', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('purchase_request_id')->nullable()->default(12);
            $table->bigInteger('product_id')->nullable()->default(12);
            $table->Integer('sc_colorid')->nullable()->default(12);
            $table->Integer('request_quantity')->nullable()->default(12);
            $table->Integer('receive_quantiy')->nullable()->default(12);
            $table->Integer('perunit_amount')->nullable()->default(12);
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('purchase_request_dt');
    }
}
