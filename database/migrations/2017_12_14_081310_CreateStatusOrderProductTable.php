<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStatusOrderProductTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ORER_PRODUCT', function (Blueprint $table) {
            $table->integer('ID_ORDER')->unsigned();
            $table->integer('VENDOR_CODE')->unsigned();

            $table->foreign('ID_ORDER')->references('ID_ORDER')->on('ORDER');
            $table->foreign('VENDOR_CODE')->references('VENDOR_CODE')->on('PRODUCT');
            //$table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ORER_PRODUCT');
    }
}
