<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSchedulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('schedules', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('residentId')->unsigned();	
            $table->foreign('residentId')->references('id')->on('residents');
            $table->integer('officerId')->unsigned();	
            $table->foreign('officerId')->references('id')->on('officers');
            $table->date('date');
            $table->time('start');
            $table->time('end');
            $table->boolean('isActive',1)->default(1);
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
        Schema::dropIfExists('schedules');
    }
}
