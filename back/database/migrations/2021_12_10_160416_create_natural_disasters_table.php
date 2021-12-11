<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNaturalDisastersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('natural_disasters', function (Blueprint $table) {
            $table->id();
            $table->string('nasa_id')->unique();
            $table->string('title');
            $table->string('description')->nullable();
            $table->string('nasa_link');
            //$table->string('status');
            //$table->string('categories'); //array
            //$table->string('geometries'); //array
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
        Schema::dropIfExists('natural_disasters');
    }
}
