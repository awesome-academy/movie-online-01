<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFilmsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('films', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('user_id');
            $table->string('title_en')->nullable();
            $table->string('title_vn')->nullable();
            $table->string('thumb')->nullable();
            $table->string('director')->nullable();
            $table->unsignedInteger('country_id');
            $table->text('year')->nullable();
            $table->text('duration')->nullable();
            $table->text('description')->nullable();
            $table->string('trailer')->nullable();
            $table->string('slug')->nullable();
            $table->string('language')->nullable();
            $table->string('quality')->nullable();
            $table->integer('viewed_day')->default(0);
            $table->integer('viewed_week')->default(0);
            $table->integer('viewed_month')->default(0);
            $table->integer('viewed_year')->default(0);
            $table->integer('viewed_total')->default(0);
            $table->timestamp('deleted_at')->nullable();
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
        Schema::dropIfExists('films');
    }
}
