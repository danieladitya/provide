<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStandardCodes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('standard_codes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('standard_code_name', 100)->nullable();
            $table->boolean('is_parent')->nullable()->default(false);
            $table->bigInteger('parent_id')->nullable()->default(12);
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
        Schema::dropIfExists('standard_codes');
    }
}
