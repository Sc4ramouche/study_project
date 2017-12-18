<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeAllCharacteristicsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ALLCHARACTERISTICS', function (Blueprint $table) {
            $table->increments("ID_ALLCHARACTERISTICS");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('ALLCHARACTERISTICS', function (Blueprint $table) {
            $table->dropColumn('ID_ALLCHARACTERISTICS');
        });
    }
}
