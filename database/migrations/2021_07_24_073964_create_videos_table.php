<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVideosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('videos', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('direccion_video');
            $table->string('titulo_video');
            $table->integer('visitas');
            $table->integer('restriccion_edad');
            $table->float('popularidad', 8, 2);
            $table->integer('cantidad_temporadas');
            $table->string('descripcion');
            //Falta Llave foranea con usuario
            $table->unsignedBigInteger('id_usuario_autor');
            $table->foreign('id_usuario_autor')->references('id')->on('users');
            //Llave foranea con Comuna
            $table->unsignedBigInteger('id_comuna');
            $table->foreign('id_comuna')->references('id')->on('communes');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('videos');
    }
}
