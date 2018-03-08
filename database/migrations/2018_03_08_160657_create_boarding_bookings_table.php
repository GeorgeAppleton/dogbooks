<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBoardingBookingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('boarding_bookings', function (Blueprint $table) {//in future we may use polymorphic relationships to point to booking for training or boarding
            $table->increments('id');
            $table->integer('dog_id')->unsigned();
            $table->foreign('dog_id')->references('id')->on('dogs')->onDelete('cascade');
            $table->dateTime('arrival');
            $table->dateTime('departure');
            $table->boolean('train');
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
        Schema::dropIfExists('boarding_bookings');
    }
}
