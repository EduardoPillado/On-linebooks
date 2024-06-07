<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('usuario', function (Blueprint $table) {
            $table->id('pk_usuario')->autoIncrement();
            $table->string('nombre_usuario');
            $table->string('correo');
            $table->string('contraseña');
            $table->unsignedBigInteger('fk_tipo_usuario');
            $table->string('token');
            $table->smallInteger('estatus_usuario');

            $table->foreign('fk_tipo_usuario')
                ->references('pk_tipo_usuario')
                ->on('tipo_usuario');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('usuario');
    }
};
