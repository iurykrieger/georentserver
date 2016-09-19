<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePreferenceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('preference', function (Blueprint $table) {
            $table->increments('idPreference')->unsigned();
            $table->boolean('sponsor')->nullable();
            $table->integer('room')->nullable();
            $table->integer('bathroom')->nullable();
            $table->integer('vacancy')->nullable();
            $table->boolean('laundry')->nullable();
            $table->decimal('income',10,2)->nullable();
            $table->boolean('condominium')->nullable();
            $table->boolean('child')->nullable();
            $table->integer('stay')->nullable();
            $table->boolean('pet')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('preference');
    }
}
