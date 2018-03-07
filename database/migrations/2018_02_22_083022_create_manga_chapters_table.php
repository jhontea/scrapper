<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMangaChaptersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('manga_chapter', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('manga_id')->unsigned();
            $table->foreign('manga_id')
                    ->references('id')->on('mangas')
                    ->onDelete('cascade');
            $table->string('chapter');
            $table->string('image');
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
        Schema::dropIfExists('manga_chapter');
    }
}
