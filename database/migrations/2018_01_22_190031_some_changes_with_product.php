<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SomeChangesWithProduct extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ALLCHARACTERISTICS', function(Blueprint $table) {
            $table->unsignedInteger("VENDOR_CODE");
        });

        Schema::table('PRODUCT', function(Blueprint $table) {
            $table->text("Description")->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        
    }
}
