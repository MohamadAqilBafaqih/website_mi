<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('sesi_pendaftaran', function (Blueprint $table) {
            // Pastikan pakai InnoDB
            $table->engine = 'InnoDB';

            $table->id(); // BIGINT UNSIGNED AUTO_INCREMENT
            $table->string('nama_sesi', 100);
            $table->string('tahun_ajaran', 9); // contoh: 2025/2026
            $table->date('tanggal_mulai');
            $table->date('tanggal_selesai');
            $table->enum('status', ['aktif', 'nonaktif'])->default('aktif');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('sesi_pendaftaran');
    }
};
