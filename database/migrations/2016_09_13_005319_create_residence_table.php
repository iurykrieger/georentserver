<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateResidenceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('residence', function (Blueprint $table) {
            $table->increments('idResidence')->unsigned();
            $table->integer('idLocation')->unsigned();
            $table->integer('idUser')->unsigned();
            $table->integer('idPreference')->unsigned();
            $table->timestamps();
        });

        Schema::table('residence', function($table) {
           $table->foreign('idLocation')->references('idLocation')->on('location');
           $table->foreign('idPreference')->references('idPreference')->on('preference');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('residence');
    }
}
