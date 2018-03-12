<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAnimeEpisodesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('anime_episodes', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('anime_id')->unsigned();
            $table->foreign('anime_id')
                    ->references('id')->on('anime')
                    ->onDelete('cascade');
            $table->string('episode');
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
        Schema::dropIfExists('anime_episodes');
    }
}
