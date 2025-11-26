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
        Schema::create('odontogram_gigi', function (Blueprint $table) {
            $table->id();
            $table->foreignId('odontogram_id')->constrained('odontograms')->onDelete('cascade');
            $table->string('nomor_gigi', 10)->comment('Nomor gigi FDI: 11-48 (dewasa), 51-85 (susu)');
            $table->string('kondisi', 20)->default('sou')->comment('Kode kondisi gigi: sou, car, amf, poc, mis, dll');
            $table->enum('dinding_atas', ['normal', 'bermasalah'])->nullable();
            $table->enum('dinding_bawah', ['normal', 'bermasalah'])->nullable();
            $table->enum('dinding_kiri', ['normal', 'bermasalah'])->nullable();
            $table->enum('dinding_kanan', ['normal', 'bermasalah'])->nullable();
            $table->enum('dinding_tengah', ['normal', 'bermasalah'])->nullable();
            $table->text('keterangan')->nullable();
            $table->timestamps();

            // Index untuk pencarian cepat
            $table->index(['odontogram_id', 'nomor_gigi']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('odontogram_gigi');
    }
};
