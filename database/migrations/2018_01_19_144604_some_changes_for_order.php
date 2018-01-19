<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SomeChangesForOrder extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ORDER', function(Blueprint $table) {
            $table->string('Telephone');
            $table->string('Name');
            $table->string('Adress');
        });


        Schema::table('users', function(Blueprint $table) {
            $table->string('Adress');
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
