<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePurchaseOrderDt extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchase_order_dt', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('purchase_order_id')->nullable()->default(12);
            $table->integer('product_id')->nullable()->default(12);
            $table->integer('sc_colorid')->unsigned()->nullable()->default(12);
            $table->integer('quantity_request')->unsigned()->nullable()->default(12);
            $table->integer('perunit_amount')->nullable()->default(12);
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
        Schema::dropIfExists('purchase_order_dt');
    }
}
