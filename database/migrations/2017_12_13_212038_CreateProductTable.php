<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('PRODUCT', function (Blueprint $table) {
            
            $table->integer('VENDOR_CODE')->unsigned();
            $table->integer('ID_SUBCATEGORY')->unsigned();
            $table->integer('ID_BREND')->unsigned();
            $table->integer('ID_MODEL')->unsigned();
            $table->integer('ID_COUNTRY')->unsigned();

            $table->primary('VENDOR_CODE');
            $table->foreign('ID_SUBCATEGORY')->references('ID_SUBCATEGORY')->on('SUBCATEGORY');
            $table->foreign('ID_BREND')->references('ID_BREND')->on('BREND');
            $table->foreign('ID_MODEL')->references('ID_MODEL')->on('MODEL');
            $table->foreign('ID_COUNTRY')->references('ID_COUNTRY')->on('COUNTRY');
            
            $table->integer('VENDOR_CODE_PROVIDER'); //код поставщика
            $table->double('Width');    //ширина
            $table->double('Height');   //высота
            $table->double('length');   //длина
            $table->double('Weight');   //вес
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
        Schema::dropIfExists('PRODUCT');
    }
}
