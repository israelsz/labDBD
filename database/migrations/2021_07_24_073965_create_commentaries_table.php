<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommentariesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('commentaries', function (Blueprint $table) {
            $table->id();
            $table->string('contenido');
            $table->softDeletes(); //Soft delete
            #Llave foranea usuario autor
            $table->unsignedBigInteger('id_usuario');
            $table->foreign('id_usuario')->references('id')->on('users');
            #Llave foranea video
            $table->unsignedBigInteger('id_video');
            $table->foreign('id_video')->references('id')->on('videos');
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
        Schema::dropIfExists('commentaries');
    }
}
