<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('antrian', function (Blueprint $table) {
            $table->id();
            $table->string('no_antrian', 20)->unique();
            $table->string('no_rm', 50);
            $table->foreignId('jadwal_dokter_id')->constrained('jadwal_dokter')->onDelete('cascade');
            $table->date('tanggal_kunjungan');
            $table->foreignId('penjamin_id')->constrained('master_penjamins')->onDelete('cascade');
            $table->enum('status', ['menunggu', 'dipanggil', 'selesai', 'batal'])->default('menunggu');
            $table->timestamps();

            $table->foreign('no_rm')->references('no_rm')->on('pasiens')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('antrian');
    }
};
