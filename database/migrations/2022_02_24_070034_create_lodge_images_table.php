<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLodgeImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lodge_images', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger("lodges_id");
            $table->unsignedBigInteger("images_id");
      
            $table->foreign('lodges_id')->references('id')->on('lodges')->onDelete('cascade');
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
        Schema::dropIfExists('lodge_images');
    }
}
