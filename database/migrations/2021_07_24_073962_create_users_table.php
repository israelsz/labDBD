<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('username');
            $table->string('password');
            $table->date('fecha_nacimiento');
            $table->float('monedero',8,2);
            $table->string('email')->unique();
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
            //Llave foranea id_comuna
            $table->unsignedBigInteger('id_comuna')->nullable();
            $table->foreign('id_comuna')->references('id')->on('communes');
            //Llave foranea id_tipo_usuario
            $table->unsignedBigInteger('id_tipo_usuario')->nullable();
            $table->foreign('id_tipo_usuario')->references('id')->on('user_types');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
