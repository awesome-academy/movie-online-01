<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DropMenuFilmTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('menu_film');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::create('menu_film', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('film_id');
            $table->unsignedInteger('menu_id');
            $table->timestamps();
        });
    }
}
