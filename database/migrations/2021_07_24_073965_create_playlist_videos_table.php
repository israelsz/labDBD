<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlaylistVideosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */

     //TABLA INTERMEDIA PLAYLIST_VIDEO
    public function up()
    {
        Schema::create('playlist_videos', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->softDeletes(); //Soft delete
            //Llave foranea con Video
            $table->unsignedBigInteger('id_video');
            $table->foreign('id_video')->references('id')->on('videos');
            //Llave foranea con Playlist
            $table->unsignedBigInteger('id_playlist');
            $table->foreign('id_playlist')->references('id')->on('playlists');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('playlist_videos');
    }
}
