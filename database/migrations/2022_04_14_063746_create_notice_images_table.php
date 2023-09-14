<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNoticeImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notice_images', function (Blueprint $table) {
            $table->id();
            
            $table->unsignedBigInteger("notices_id");
            $table->unsignedBigInteger("images_id");
      
            $table->foreign('notices_id')->references('id')->on('notices')->onDelete('cascade');
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
        Schema::dropIfExists('notice_images');
    }
}
