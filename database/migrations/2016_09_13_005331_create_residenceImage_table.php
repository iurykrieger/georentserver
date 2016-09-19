<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateResidenceImageTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('residenceImage', function (Blueprint $table) {
            $table->increments('idResidenceImage')->unsigned();
            $table->integer('idResidence')->unsigned();
            $table->longText('path');
            $table->integer('resource');
            $table->integer('order');
            $table->timestamps();
        });

        Schema::table('residenceImage', function($table) {
           $table->foreign('idResidence')->references('idResidence')->on('residence');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('residenceImage');
    }
}
