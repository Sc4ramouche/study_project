<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddMaterialProduct extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('PRODUCT', function (Blueprint $table) {
            $table->integer('ID_MATERIAL')->unsigned();

            $table->foreign('ID_MATERIAL')->references('ID_MATERIAL')->on('MATERIAL');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('PRODUCT', function (Blueprint $table) {
            $table->dropColumn('ID_MATERIAL');
        });
    }
}
