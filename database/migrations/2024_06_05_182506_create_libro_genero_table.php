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
        Schema::create('libro_genero', function (Blueprint $table) {
            $table->id('pk_libro_genero')->autoIncrement();
            $table->unsignedBigInteger('fk_libro');
            $table->unsignedBigInteger('fk_genero');

            $table->foreign('fk_libro')
                ->references('pk_libro')
                ->on('libro');
            
            $table->foreign('fk_genero')
                ->references('pk_genero')
                ->on('genero');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('libro_genero');
    }
};
