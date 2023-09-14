<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAgentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('agents', function (Blueprint $table) {
            $table->id();
            $table->string("name")->nullable();
            $table->string("license")->nullable();
            $table->string("address")->nullable();
            $table->unsignedBigInteger("district_meta_data_id");

            $table->string("phone_one")->nullable();
            $table->string("phone_two")->nullable();
            $table->string("email")->nullable();
            $table->longText("description")->nullable();

            $table->string("average_ratings")->default(0);
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
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('agents');
    }
}
