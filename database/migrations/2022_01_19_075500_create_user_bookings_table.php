<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserBookingsTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('user_bookings', function (Blueprint $table) {
      $table->id();

      $table->unsignedBigInteger("lodge_room_data_id");
      $table->unsignedBigInteger("users_id");

      $table->string("number_of_room_require")->nullable();
      $table->string("check_in")->nullable();
      $table->string("check_out")->nullable();
      $table->string("status")->nullable();
      $table->boolean("checked_in")->nullable();
      $table->string('order_id')->nullable();

      $table->string("param1")->nullable(); //PARAM1 FOR CHECKOUT STATUS
      $table->string("param2")->nullable();
      $table->string("param3")->nullable();
      $table->string("param4")->nullable();
      $table->string("param5")->nullable();
      $table->string("param6")->nullable();
      $table->string("param7")->nullable();
      $table->string("param8")->nullable();
      $table->string("param9")->nullable();
      $table->string("param10")->nullable();

      $table->foreign('lodge_room_data_id')->references('id')->on('lodge_room_data');
      $table->foreign('users_id')->references('id')->on('users');

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
    Schema::dropIfExists('user_bookings');
  }
}
