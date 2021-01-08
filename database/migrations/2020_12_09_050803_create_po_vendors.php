<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePoVendors extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchase_request', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('purchase_request_no', 100)->nullable();
            $table->string('sjno', 100)->nullable();
            $table->bigInteger('purchase_order_id')->nullable();
            $table->bigInteger('vendor_id')->nullable();
            $table->date('date_send')->nullable();
            $table->date('date_recive')->nullable();
            $table->integer('dp_amount')->unsigned()->nullable()->default(12);
            $table->integer('total_cost_amount')->unsigned()->nullable()->default(12);
            $table->integer('sc_statuspo')->unsigned()->nullable()->default(12);
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
        Schema::dropIfExists('po_vendors');
    }
}
