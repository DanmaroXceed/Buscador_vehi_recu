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
        Schema::create('vehiculos', function (Blueprint $table) {
            $table->id();

            $table->date('fecha_ingreso');
            $table->date('fecha_liberacion')->nullable()->default(null);
            $table->string('corporacion_asegura', 100);
            $table->string('elemento_asegura', 100);
            $table->string('grua', 100);
            $table->string('serie', 30);
            $table->string('placas', 10);
            $table->string('marca', 20);
            $table->string('submarca', 20);
            $table->string('modelo', 20);
            $table->string('color', 50);
            $table->string('mp', 50);
            $table->string('cui', 100);
            $table->text('observaciones')->nullable();
            $table->boolean('estado')->default(true);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('vehiculos');
    }
};