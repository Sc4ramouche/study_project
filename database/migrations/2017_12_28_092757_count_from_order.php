<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CountFromOrder extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ORER_PRODUCT', function (Blueprint $table) {
            $table->unsignedInteger("Count");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('ORER_PRODUCT', function (Blueprint $table) {
            $table->dropColumn('Count');
        });
    }
}
