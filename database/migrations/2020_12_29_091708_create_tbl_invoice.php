<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTblInvoice extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('inv_no', 100);
            $table->date('inv_date')->nullable();
            $table->bigInteger("purchase_order_id");
            $table->date('date_payment')->nullable();
            $table->string("bank_name")->nullable();
            $table->string("rek_no")->nullable();
            $table->string("ref_no")->nullable();
            $table->integer('total_payment')->unsigned()->nullable();
            $table->string("notes")->nullable();
            $table->bigInteger('sc_statuspayment');
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
        Schema::dropIfExists('tbl_invoice');
    }
}
