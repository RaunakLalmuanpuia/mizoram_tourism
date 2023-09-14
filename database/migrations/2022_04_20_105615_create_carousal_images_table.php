<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCarousalImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('carousal_images', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger("carousals_id");
            $table->unsignedBigInteger("images_id");
      
            $table->foreign('carousals_id')->references('id')->on('carousals')->onDelete('cascade');
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
        Schema::dropIfExists('carousal_images');
    }
}
