<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMessageTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('message', function (Blueprint $table) {
            $table->increments('idMessage')->unsigned();
            $table->integer('idFrom')->unsigned();
            $table->integer('idTo')->unsigned();
            $table->string('message',500);
            $table->timestamp('dateTime');
            $table->integer('resource');
            $table->longText('path');
            $table->timestamps();
        });

        Schema::table('message', function($table) {
           $table->foreign('idFrom')->references('idUser')->on('user');
           $table->foreign('idTo')->references('idUser')->on('user');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('message');
    }
}
