<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDistrictImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('district_images', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger("district_meta_data_id");
            $table->unsignedBigInteger("images_id");
      
            $table->foreign('district_meta_data_id')->references('id')->on('district_meta_data')->onDelete('cascade');
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
        Schema::dropIfExists('district_images');
    }
}
