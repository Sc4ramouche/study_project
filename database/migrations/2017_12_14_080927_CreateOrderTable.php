<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ORDER', function (Blueprint $table) {
            $table->increments('ID_ORDER');
            $table->string('email');
            $table->integer('ID_STATUSORDER')->unsigned();

            $table->foreign('email')->references('email')->on('users');
            $table->foreign('ID_STATUSORDER')->references('ID_STATUSORDER')->on('STATUSORDER');
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
        Schema::dropIfExists('ORDER');
    }
}
