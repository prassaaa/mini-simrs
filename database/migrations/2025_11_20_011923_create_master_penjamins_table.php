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
        Schema::create('master_penjamins', function (Blueprint $table) {
            $table->id();
            $table->string('kode_penjamin')->unique();
            $table->string('nama_penjamin');
            $table->enum('jenis', ['BPJS', 'Umum', 'Asuransi']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('master_penjamins');
    }
};
