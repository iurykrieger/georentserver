<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user', function (Blueprint $table) {
            $table->increments('idUser')->unsigned();
            $table->string('name',100);
            $table->date('birthDate');
            $table->string('email',100);
            $table->string('phone',11);
            $table->string('password',20);
            $table->decimal('credits',10,2);
            $table->integer('type');
            $table->integer('distance');
            $table->integer('idPreference')->unsigned();
            $table->integer('idCity')->unsigned();
            $table->integer('profileImage')->unsigned()->nullable()->default(null);
            $table->timestamps();
        });

        Schema::table('user', function($table) {
           $table->foreign('idCity')->references('idCity')->on('city');
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
        Schema::dropIfExists('user');
    }
}
