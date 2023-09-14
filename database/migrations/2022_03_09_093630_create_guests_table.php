<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGuestsTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('guests', function (Blueprint $table) {
      $table->id();
      $table->unsignedBigInteger("users_id");

      $table->string("first_name")->nullable();
      $table->string("last_name")->nullable();
      $table->string("email")->nullable();
      $table->unsignedBigInteger('booking_id')->nullable();

      $table->string("phone")->nullable();
      $table->string("suggestion")->nullable();

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

      $table->foreign('booking_id')->references('id')->on('user_bookings');
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
    Schema::dropIfExists('guests');
  }
}
