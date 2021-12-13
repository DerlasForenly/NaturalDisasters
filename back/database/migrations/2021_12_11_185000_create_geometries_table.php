<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGeometriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('geometries', function (Blueprint $table) {
            $table->id();
            $table->string('date');
            $table->string('type');
            $table->string('lng'); //0
            $table->string('lat'); //1

            $table->unsignedBigInteger('natural_disaster_id');
            $table->foreign('natural_disaster_id')->references('id')->on('natural_disasters')->onDelete('cascade');

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
        Schema::dropIfExists('geometries');
    }
}
