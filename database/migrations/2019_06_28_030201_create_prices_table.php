<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePricesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('prices', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('polyline_id');

            $table->double('average_price',12, 2);
            $table->double('minimum_price',12, 2);
            $table->double('maximum_price',12, 2)->nullable();

            $table->double('corner_average_price',12, 2);
            $table->double('corner_minimum_price',12, 2);
            $table->double('corner_maximum_price',12, 2);

            $table->date('date_price')->nullable();
            $table->integer('priced_by')->nullable()->unsigned();

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
        Schema::dropIfExists('prices');
    }
}
