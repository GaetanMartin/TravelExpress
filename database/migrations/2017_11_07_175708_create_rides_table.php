<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRidesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rides', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');

            $table->integer('car_id')->unsigned();
            $table->foreign('car_id')->references('id')->on('cars')->onDelete('cascade');

            $table->dateTimeTz('start_time');

            $table->integer('source_city_id')->unsigned();
            $table->foreign('source_city_id')->references('id')->on('cities');

            $table->integer('dest_city_id')->unsigned();
            $table->foreign('dest_city_id')->references('id')->on('cities');

            $table->integer('nb_seats_offered')->unsigned();
            
            $table->decimal('price')->unsigned();
            
            $table->integer('luggage_size')->unsigned();

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
        Schema::dropIfExists('rides');
    }
}
