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
        Schema::create('genero', function (Blueprint $table) {
            $table->id('pk_genero')->autoIncrement();
            $table->string('nombre_genero');
            $table->smallInteger('estatus_genero');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('genero');
    }
};
