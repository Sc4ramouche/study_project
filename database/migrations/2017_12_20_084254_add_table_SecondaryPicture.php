<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTableSecondaryPicture extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('SECONDPICTURE', function (Blueprint $table) {
            $table->increments('ID_SECONDPICTURE');
            $table->unsignedInteger('VENDOR_CODE');
            $table->string('Name');

            $table->foreign('VENDOR_CODE')->references('VENDOR_CODE')->on('PRODUCT');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('SECONDPICTURE');
    }
}
