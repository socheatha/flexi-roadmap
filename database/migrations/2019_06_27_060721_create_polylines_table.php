<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePolylinesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('polylines', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('vta_code')->nullable();
            $table->string('address_id')->nullable();
            $table->integer('street_id')->unsigned()->nullable();
            $table->string('bounderies')->nullable();
            $table->string('starting_point_place',40)->nullable(); //latlong
            $table->string('ending_point_place',40)->nullable();//latlong
            $table->string('direction')->nullable();
            $table->string('direction_google')->nullable();
            $table->double('starting_point_coordinat',12,8)->nullable();
            $table->double('ending_point_coordinate',12,8)->nullable();

            $table->text('polylines')->nullable();
            $table->double('groud_length',8, 2)->nullable();

            $table->string('distance')->nullable();
            $table->string('from_distance')->nullable();
            $table->string('to_distance')->nullable();
            
            $table->double('average_price',12, 2)->nullable();
            $table->double('minimum_price',12, 2)->nullable();
            $table->double('maximum_price',12, 2)->nullable();
            $table->date('date_price')->nullable();
            $table->integer('priced_by')->nullable()->unsigned();

            $table->integer('added_by')->unsigned()->nullable();
            $table->date('added_at')->nullable();

            $table->integer('edited_by')->nullable()->unsigned();
            $table->date('edited_at')->nullable();

       //     $table->string('vta_code');
            $table->timestamps();
         //   $table->unique('starting_point_place', 'ending_point_place');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('polylines');
    }
}
