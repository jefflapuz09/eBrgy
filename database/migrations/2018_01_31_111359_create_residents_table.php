<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateResidentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('residents', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('firstName');
            $table->string('middleName')->nullable();
            $table->string('lastName');
            $table->string('province')->nullable();
            $table->string('street');
            $table->string('brgy');
            $table->string('city');
            $table->string('citizenship');
            $table->string('religion');
            $table->string('dateCitizen')->nullable();
            $table->string('orderApproval')->nullable();
            $table->string('occupation')->nullable();
            $table->string('tinNo')->nullable();
            $table->string('isUnpleasant')->default('Good');
            $table->boolean('gender');
            $table->date('birthdate');
            $table->string('birthPlace');
            $table->string('civilStatus');
            $table->string('periodResidence');
            $table->string('image')->nullable();
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
        Schema::dropIfExists('residents');
    }
}
