<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLocationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('location' ,function (Blueprint $table) {
            $table->increments('idLocation');
            $table->double('latitude', 15,8);
            $table->double('longitude', 15,8);
            $table->integer('idCity')->unsigned();
            $table->rememberToken();
            $table->timestamps();
        });

        Schema::table('location', function($table) {
           $table->foreign('idCity')->references('idCity')->on('city');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('location');
    }
}
