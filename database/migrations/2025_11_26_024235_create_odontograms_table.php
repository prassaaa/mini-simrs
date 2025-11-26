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
        Schema::create('odontograms', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kunjungan_id')->constrained('kunjungans')->onDelete('cascade');
            $table->text('pemeriksaan_ekstra_oral')->nullable();
            $table->text('pemeriksaan_intra_oral')->nullable();
            $table->enum('occlusi', ['normal_bite', 'cross_bite', 'steep_bite'])->default('normal_bite');
            $table->enum('torus_palatinus', ['tidak_ada', 'kecil', 'sedang', 'besar', 'multiple'])->default('tidak_ada');
            $table->enum('torus_mandibularis', ['tidak_ada', 'kiri', 'kanan', 'kedua'])->default('tidak_ada');
            $table->enum('palatum', ['dalam', 'sedang', 'rendah'])->default('sedang');
            $table->boolean('diastema')->default(false);
            $table->boolean('gigi_anomali')->default(false);
            $table->integer('status_d')->default(0)->comment('Decay');
            $table->integer('status_m')->default(0)->comment('Missing');
            $table->integer('status_f')->default(0)->comment('Filled');
            $table->text('hasil_pemeriksaan_penunjang')->nullable();
            $table->text('diagnosa')->nullable();
            $table->text('planning')->nullable();
            $table->text('edukasi')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('odontograms');
    }
};
