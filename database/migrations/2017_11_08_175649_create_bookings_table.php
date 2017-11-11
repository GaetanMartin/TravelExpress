<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBookingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');

            $table->integer('requester_id')->unsigned();
            $table->foreign('requester_id')->references('id')->on('users');

            $table->integer('ride_id')->unsigned();
            $table->foreign('ride_id')->references('id')->on('rides');

            $table->integer('nb_seats_booked')->unsigned();
            
            $table->enum('status', ['messages.pending', 'messages.accepted', 'messages.denied', 'messages.confirmed']);

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
        Schema::dropIfExists('bookings');
    }
}
