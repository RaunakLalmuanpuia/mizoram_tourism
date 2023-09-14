<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateDistrictMetaDataTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('district_meta_data', function (Blueprint $table) {
      $table->id();

      $table->string("district_name")->nullable();
      $table->string("altitude")->nullable();
      $table->string("population")->nullable();
      $table->string("area")->nullable();
      $table->string("airport")->nullable();
      $table->string("weather_forecast")->nullable();
      $table->string("latlng")->nullable();
      $table->string("latitude")->nullable();
      $table->string("longitude")->nullable();
      $table->string("quote")->nullable();
      $table->string("banner_image")->nullable();

      $table->longText("description")->nullable();

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

      $table->softDeletes();
      $table->timestamps();
    });

    DB::statement(
      'ALTER TABLE district_meta_data ADD FULLTEXT fulltext_index(district_name)'
    );
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::dropIfExists('district_meta_data');
  }
}
