<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTblPurchaseOrders extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchase_orders', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('purchase_order_no', 100)->nullable();
            $table->integer('customer_id')->unsigned()->nullable()->default(12);
            $table->date('order_date')->nullable();
            $table->date('close_date')->nullable();
            $table->date('send_date')->nullable();
            $table->integer('sc_status_orderid')->unsigned()->nullable()->default(12);
            $table->integer('total_amount')->unsigned()->nullable()->default(12);
            $table->integer('total_cost_amount')->unsigned()->nullable()->default(12);
            $table->integer('createdbyid')->unsigned()->nullable()->default(12);
            $table->integer('updatedbyid')->unsigned()->nullable()->default(12);
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
        Schema::dropIfExists('tbl_purchase_orders');
    }
}
