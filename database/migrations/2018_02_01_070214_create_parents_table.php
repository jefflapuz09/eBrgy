<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateParentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('parents', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('residentId')->unsigned();	
            $table->foreign('residentId')->references('id')->on('residents');
            $table->string('motherfirstName');
            $table->string('mothermiddleName')->nullable();
            $table->string('motherlastName');
            $table->string('fatherfirstName');
            $table->string('fathermiddleName')->nullable();
            $table->string('fatherlastName');
            $table->boolean('isActive')->default(1);
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
        Schema::dropIfExists('parents');
    }
}
