<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SomeChangesForOrder2 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('PaymentMethod', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
        });

        Schema::create('DeliveryMethod', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
        });

         Schema::table('ORDER', function(Blueprint $table) {
            $table->integer('ID_PaymentMethod')->unsigned();
            $table->foreign('ID_PaymentMethod')->references('id')->on('PaymentMethod');

            $table->integer('ID_DeliveryMethod')->unsigned();
            $table->foreign('ID_DeliveryMethod')->references('id')->on('DeliveryMethod');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
