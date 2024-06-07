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
        Schema::create('libro_autor', function (Blueprint $table) {
            $table->id('pk_libro_autor')->autoIncrement();
            $table->unsignedBigInteger('fk_libro');
            $table->unsignedBigInteger('fk_autor');

            $table->foreign('fk_libro')
                ->references('pk_libro')
                ->on('libro');
            
            $table->foreign('fk_autor')
                ->references('pk_autor')
                ->on('autor');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('libro_autor');
    }
};
