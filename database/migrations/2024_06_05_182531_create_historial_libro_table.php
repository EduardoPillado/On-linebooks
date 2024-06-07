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
        Schema::create('historial_libro', function (Blueprint $table) {
            $table->id('pk_historial_libro')->autoIncrement();
            $table->unsignedBigInteger('fk_usuario');
            $table->unsignedBigInteger('fk_libro');

            $table->foreign('fk_usuario')
                ->references('pk_usuario')
                ->on('usuario');
            
            $table->foreign('fk_libro')
                ->references('pk_libro')
                ->on('libro');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('historial_libro');
    }
};
