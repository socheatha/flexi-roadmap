<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTblRaw extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_raw', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('no_main')->nullable();
            $table->string('no_sub')->nullable();
            $table->string('vta_code')->nullable();
            $table->string('street_name')->nullable();
            $table->string('street_number')->nullable();
            $table->string('strech_range')->nullable();
            $table->string('boundery')->nullable();
            $table->string('starting_point_place')->nullable();
            $table->string('ending_point_place')->nullable();
            $table->string('direction')->nullable();
            $table->string('starting_point_coordinate')->nullable();
            $table->string('ending_point_coordinate')->nullable();
            $table->string('length')->nullable();
            $table->string('average')->nullable();
            $table->string('minimum')->nullable();
            $table->string('maximumin')->nullable();
            $table->string('commune')->nullable();
            $table->string('district')->nullable();
            $table->string('corner_average')->nullable();
            $table->string('corner_minimum')->nullable();
            $table->string('corner_mamaximumin')->nullable();
            $table->string('street_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tbl_raw');
    }
}
