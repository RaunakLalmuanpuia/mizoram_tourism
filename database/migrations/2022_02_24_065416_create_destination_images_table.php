<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDestinationImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('destination_images', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger("district_top_destinations_id");
            $table->unsignedBigInteger("images_id");
      
            $table->foreign('district_top_destinations_id')->references('id')->on('district_top_destinations')->onDelete('cascade');
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
        Schema::dropIfExists('destination_images');
    }
}
