<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserLodgesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_lodges', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger("users_id");
            $table->unsignedBigInteger("lodges_id");
      
            $table->foreign('users_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('lodges_id')->references('id')->on('lodges')->onDelete('cascade');


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
        Schema::dropIfExists('user_lodges');
    }
}
