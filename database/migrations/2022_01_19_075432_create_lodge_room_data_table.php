<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLodgeRoomDataTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('lodge_room_data', function (Blueprint $table) {
      $table->id();

      $table->unsignedBigInteger("lodges_id");
      $table->unsignedBigInteger("district_meta_data_id");
      $table->unsignedBigInteger("lodge_room_types_id");
      $table->string("room_available")->nullable();
      $table->integer("price")->nullable();

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
      $table->foreign('district_meta_data_id')->references('id')->on('district_meta_data');
      $table->foreign('lodge_room_types_id')->references('id')->on('lodge_room_types');

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
    Schema::dropIfExists('lodge_room_data');
  }
}
