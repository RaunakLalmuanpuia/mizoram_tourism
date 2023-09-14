<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOccupancyDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('occupancy_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("occupancies_id");

            $table->string("date")->nullable();
            $table->string("suite")->nullable();
            $table->string("deluxe")->nullable();
            $table->string("double_room")->nullable();
            $table->string("single_room")->nullable();
            $table->string("dormitory")->nullable();
            $table->string("conference_hall")->nullable();
            $table->string("convention_hall")->nullable();

            $table->string("param1")->nullable();
            $table->string("param2")->nullable();
            $table->string("param3")->nullable();
            $table->string("param4")->nullable();
            $table->string("param5")->nullable();
            $table->string("param6")->nullable();
            $table->string("param7")->nullable();
            $table->string("param8")->nullable();
            $table->string("param9")->nullable();
            $table->string("param10")->nullable();
            $table->foreign('occupancies_id')->references('id')->on('occupancies');

            $table->softDeletes();
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
        Schema::dropIfExists('occupancy_details');
    }
}
