<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSendOrderPoDt extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('send_order_po_dt', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('send_order_po_id');
            $table->string('name_product', 100)->nullable();
            $table->bigInteger('purchase_order_dt_id')->nullable();
            $table->integer('quantity_item')->nullable();
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
        Schema::dropIfExists('send_order_po_dt');
    }
}
