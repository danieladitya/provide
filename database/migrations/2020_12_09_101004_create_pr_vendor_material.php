<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePrVendorMaterial extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pr_vendor_material', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('material_id')->nullable()->default(12);
            $table->Integer('material_quantity')->nullable()->default(12);
            $table->Integer('sc_unitid')->nullable()->default(12);
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
        Schema::dropIfExists('pr_vendor_material');
    }
}
