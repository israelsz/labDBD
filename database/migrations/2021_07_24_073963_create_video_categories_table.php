<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVideoCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('video_categories', function (Blueprint $table) {
            $table->id();
            //Llave forania de id_video
            $table->unsignedBigInteger('id_video')->nullable();
            $table->foreign('id_video')->references('id')->on('videos');

            //Llave forania de  id_categoria
            $table->unsignedBigInteger('id_categoria')->nullable();
            $table->foreign('id_categoria')->references('id')->on('categories');
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
        Schema::dropIfExists('video_categories');
    }
}
