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
        Schema::table('vehiculos', function (Blueprint $table) {
            $table->string('area')->nullable();                
            $table->date('fecha_parte')->nullable();           
            $table->string('tipo_v')->nullable();
            $table->string('origen')->nullable();
            $table->string('municipio')->nullable();
            $table->string('calle')->nullable();
            $table->date('fecha_robo')->nullable();
            $table->boolean('rec_mismo_dia')->nullable();
            $table->boolean('alt_rem')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('vehiculos', function (Blueprint $table) {
            $table->dropColumn([
                'area',
                'fecha_parte',
                'tipo_v',
                'origen',
                'municipio',
                'calle',
                'fecha_robo',
                'rec_mismo_dia',
                'alt_rem',
            ]);
        });
    }
};
