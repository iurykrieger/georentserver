<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMatchTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('match', function (Blueprint $table) {
            $table->increments('idMatch')->unsigned();
            $table->integer('idResidence')->unsigned();
            $table->integer('idUser')->unsigned();
            $table->boolean('like');
            $table->timestamp('dateTime');
            $table->boolean('diamond');
            $table->timestamps();
        });

        Schema::table('match', function($table) {
           $table->foreign('idResidence')->references('idResidence')->on('residence');
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
        Schema::dropIfExists('match');
    }
}
