<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAboutImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('about_images', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger("abouts_id");
            $table->unsignedBigInteger("images_id");
      
            $table->foreign('abouts_id')->references('id')->on('abouts')->onDelete('cascade');
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
        Schema::dropIfExists('about_images');
    }
}
