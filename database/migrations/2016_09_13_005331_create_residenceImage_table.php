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
            $table->integer('orderImage');
            $table->timestamps();
        });

        Schema::table('residenceImage', function($table) {
           $table->foreign('idResidence')->references('idResidence')->on('residence');
        });

        //foi feito pois na ordem a residenceImage é criada depois da residencia, logo não tem como referenciar uma chave que não existe, este foi o unico modo.
        Schema::table('residence', function($table) {
           $table->foreign('profileImage')->references('idResidenceImage')->on('residenceImage');
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
