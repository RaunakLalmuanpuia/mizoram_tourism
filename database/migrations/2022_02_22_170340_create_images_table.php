<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('images', function (Blueprint $table) {
            $table->id();
            $table->string("model")->nullable();
            $table->string("model_id")->nullable();
            $table->string("district_id")->nullable();

            $table->string("name")->nullable();
            $table->string("alt")->nullable();

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
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('images');
    }
}
