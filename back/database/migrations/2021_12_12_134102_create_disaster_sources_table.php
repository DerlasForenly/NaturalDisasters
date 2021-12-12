<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDisasterSourcesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('disaster_sources', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('natural_disaster_id');
            $table->foreign('natural_disaster_id')->references('id')->on('natural_disasters')->onDelete('cascade');
            $table->unsignedBigInteger('source_id');
            $table->foreign('source_id')->references('id')->on('sources')->onDelete('cascade');

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
        Schema::dropIfExists('disaster_sources');
    }
}
