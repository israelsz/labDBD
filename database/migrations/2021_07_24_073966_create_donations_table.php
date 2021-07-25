<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDonationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('donations', function (Blueprint $table) {
            $table->id();
            $table->float('monto',8,2);
            $table->date('fecha_donacion');
            
            //Lave forania de donador
            $table->unsignedBigInteger('id_donador');
            $table->foreign('id_donador')->references('id')->on('user_types');
            //Lave forania de receptor
            $table->unsignedBigInteger('id_receptor')->nullable();
            $table->foreign('id_receptor')->references('id')->on('user_types');
            //Llave forania metodo pago
            $table->unsignedBigInteger('id_metodo_pago')->nullable();
            $table->foreign('id_metodo_pago')->references('id')->on('payment_methods');
            //Llave forania playlist
            $table->unsignedBigInteger('id_playlist')->nullable();
            $table->foreign('id_playlist')->references('id')->on('playlists');
            //Llave forania video
            $table->unsignedBigInteger('id_video')->nullable();
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
        Schema::dropIfExists('donations');
    }
}
