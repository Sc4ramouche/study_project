<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSubcategoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('SUBCATEGORY', function (Blueprint $table) {
            $table->increments('ID_SUBCATEGORY');
            $table->integer('ID_CATEGORY')->unsigned();
            $table->string('Name');

            $table->foreign('ID_CATEGORY')->references('ID_CATEGORY')->on('CATEGORY');
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
        Schema::dropIfExists('SUBCATEGORY');
    }
}
