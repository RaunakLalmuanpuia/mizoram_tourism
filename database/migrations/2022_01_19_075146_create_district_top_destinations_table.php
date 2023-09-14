<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateDistrictTopDestinationsTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('district_top_destinations', function (Blueprint $table) {
      $table->id();

      $table->unsignedBigInteger("district_meta_data_id");
      $table->string("destination_name")->nullable();
      $table->string("distance")->nullable();
      $table->longText("description")->nullable();
      $table->string("destination_banner")->nullable();
      $table->string("latlng")->nullable();
      $table->string("latitude")->nullable();
      $table->string("longitude")->nullable();

      $table->string("altitude")->nullable();
      $table->string("nearest_tourist_lodge_distance")->nullable();
      $table->string("walking_distance")->nullable();

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

      $table->foreign('district_meta_data_id')->references('id')->on('district_meta_data');

      $table->softDeletes();
      $table->timestamps();
    });
    DB::statement(
      'ALTER TABLE district_top_destinations ADD FULLTEXT fulltext_index(destination_name)'
    );
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::dropIfExists('district_top_destinations');
  }
}
