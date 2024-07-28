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
        Schema::create('libro', function (Blueprint $table) {
            $table->id('pk_libro')->autoIncrement();
            $table->string('titulo');
            $table->text('descripcion')->nullable();
            $table->integer('año_publicacion', 4)->nullable();
            $table->text('imagen_portada')->nullable();
            $table->string('pdf_ruta');
            $table->smallInteger('estatus_libro');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('libro');
    }
};
