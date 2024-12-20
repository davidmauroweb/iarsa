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
        Schema::create('equipos', function (Blueprint $table) {
            $table->id();
            $table->string('marca', length: 30);
            $table->string('codigo', length: 6);
            $table->string('tipo', length: 20);
            $table->string('modelo', length: 20);
            $table->string('potencia', length:10);
            $table->string('patente', length:10);
            $table->boolean('activo')->default(1);
            $table->unsignedSmallInteger('max');
            $table->unsignedSmallInteger('control');
            $table->unique('codigo');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('equipos');
    }
};
