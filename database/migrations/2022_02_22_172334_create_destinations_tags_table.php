<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDestinationsTagsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('destinations_tags', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("district_top_destinations_id");
            $table->unsignedBigInteger("tags_id");

            $table->foreign('district_top_destinations_id')->references('id')->on('district_top_destinations')->onDelete('cascade');
            $table->foreign('tags_id')->references('id')->on('tags')->onDelete('cascade');
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
        Schema::dropIfExists('destinations_tags');
    }
}
