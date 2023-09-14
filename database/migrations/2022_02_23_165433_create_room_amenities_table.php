<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRoomAmenitiesTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('room_amenities', function (Blueprint $table) {
      $table->id();

      $table->unsignedBigInteger("lodge_room_data_id");
      $table->unsignedBigInteger("amenities_id");

      $table->foreign('lodge_room_data_id')->references('id')->on('lodge_room_data')->onDelete('cascade');
      $table->foreign('amenities_id')->references('id')->on('amenities')->onDelete('cascade');

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
    Schema::dropIfExists('room_amenities');
  }
}
