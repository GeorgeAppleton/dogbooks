<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDogSizesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dog_sizes', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('dog_id')->unsigned();
            $table->foreign('dog_id')->references('id')->on('dogs')->onDelete('cascade');
            $table->string('size');
            $table->decimal('rate_night', 5, 2);
            $table->decimal('rate_day', 5, 2);
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
        Schema::dropIfExists('dog_sizes');
    }
}
