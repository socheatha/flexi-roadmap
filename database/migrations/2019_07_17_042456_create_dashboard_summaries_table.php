<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDashboardSummariesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dashboard_summaries', function (Blueprint $table) {
            $table->Increments('district_id');
            $table->string('district_name');
            $table->text('communes');
            $table->integer('added')->default('0');
            $table->integer('updated')->default('0');
            $table->integer('alive')->default('0');
            $table->integer('almost_die')->default('0');
            $table->integer('died')->default('0');
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
        Schema::dropIfExists('dashboard_summaries');
    }
}
