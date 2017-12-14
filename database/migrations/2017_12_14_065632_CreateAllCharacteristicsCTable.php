<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAllCharacteristicsCTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ALLCHARACTERISTICS', function (Blueprint $table) {
            $table->integer('ID_SUBCATEGORY')->unsigned();
            $table->integer('ID_CHARACTERISTICSUBC')->unsigned();
            $table->integer('ID_VALUESUBC')->unsigned();


            $table->foreign('ID_SUBCATEGORY')->references('ID_SUBCATEGORY')->on('SUBCATEGORY');
            $table->foreign('ID_CHARACTERISTICSUBC')->references('ID_CHARACTERISTICSUBC')->on('CHARACTERISTICSUBC');
            $table->foreign('ID_VALUESUBC')->references('ID_VALUESUBC')->on('VALUESUBC');
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
        Schema::dropIfExists('ALLCHARACTERISTICS');
    }
}
