<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('jadwal_dokter', function (Blueprint $table) {
            $table->id();
            $table->string('kode_dokter');
            $table->string('kode_poli');
            $table->enum('hari', ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu']);
            $table->time('jam_mulai');
            $table->time('jam_selesai');
            $table->integer('kuota')->default(20);
            $table->enum('status', ['aktif', 'tidak_aktif'])->default('aktif');
            $table->timestamps();

            $table->foreign('kode_dokter')->references('kode_dokter')->on('master_dokters')->onDelete('cascade');
            $table->foreign('kode_poli')->references('kode_poli')->on('master_polis')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('jadwal_dokter');
    }
};
