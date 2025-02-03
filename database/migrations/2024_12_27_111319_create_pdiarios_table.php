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
        Schema::create('pdiarios', function (Blueprint $table) {
            $table->id();
            $table->foreignId('usuario')->nullable('false');
            $table->foreignId('obra')->nullable('false');
            $table->foreignId('item')->nullable('false');
            $table->foreignId('equipo')->nullable('false');
            $table->date('fecha')->nullable('false');
            $table->unsignedTinyInteger('horas');
            $table->smallInteger('hist')->nullable('false');
            $table->unsignedSmallInteger('combustible');
            $table->unsignedTinyInteger('aceite');
            $table->unsignedTinyInteger('lubricante');
            $table->tinyText('obs');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pdiarios');
    }
};
