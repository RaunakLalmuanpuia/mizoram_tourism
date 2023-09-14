<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFestivalImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('festival_images', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger("festivals_id");
            $table->unsignedBigInteger("images_id");
      
            $table->foreign('festivals_id')->references('id')->on('festivals')->onDelete('cascade');
            $table->foreign('images_id')->references('id')->on('images')->onDelete('cascade');

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
        Schema::dropIfExists('festival_images');
    }
}
