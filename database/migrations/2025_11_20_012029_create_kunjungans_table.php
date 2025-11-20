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
        Schema::create('kunjungans', function (Blueprint $table) {
            $table->id();
            $table->string('no_registrasi_kunjungan')->unique();
            $table->string('no_rm');
            $table->foreign('no_rm')->references('no_rm')->on('pasiens')->onDelete('cascade');
            $table->date('tanggal_kunjungan');
            $table->string('kode_dokter');
            $table->foreign('kode_dokter')->references('kode_dokter')->on('master_dokters')->onDelete('cascade');
            $table->string('poli');
            $table->foreign('poli')->references('kode_poli')->on('master_polis')->onDelete('cascade');
            $table->enum('instalasi', ['Rawat Jalan', 'IGD', 'Rawat Inap']);
            $table->foreignId('penjamin_id')->constrained('master_penjamins')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kunjungans');
    }
};
