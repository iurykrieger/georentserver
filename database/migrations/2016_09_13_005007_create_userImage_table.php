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
