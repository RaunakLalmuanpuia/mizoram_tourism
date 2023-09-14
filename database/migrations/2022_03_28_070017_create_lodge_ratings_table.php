<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLodgeRatingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lodge_ratings', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger("lodges_id");
            $table->unsignedBigInteger("user_id");

            $table->string("vote")->nullable();
            $table->longText("review")->nullable();

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
            
            $table->foreign('lodges_id')->references('id')->on('lodges');
            $table->foreign('user_id')->references('id')->on('users');

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
        Schema::dropIfExists('lodge_ratings');
    }
}