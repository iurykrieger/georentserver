<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserImageTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('userImage', function (Blueprint $table) {
            $table->increments('idUserImage')->unsigned();
            $table->integer('idUser')->unsigned();
            $table->longText('path');
            $table->integer('resource');
            $table->integer('orderImage');
            $table->timestamps();
        });

        Schema::table('userImage', function($table) {
           $table->foreign('idUser')->references('idUser')->on('user');
        });

        //foi feito pois na ordem a residenceImage é criada depois da residencia, logo não tem como referenciar uma chave que não existe, este foi o unico modo.
        Schema::table('user', function($table) {
           $table->foreign('profileImage')->references('idUserImage')->on('userImage');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('userImage');
    }
}
