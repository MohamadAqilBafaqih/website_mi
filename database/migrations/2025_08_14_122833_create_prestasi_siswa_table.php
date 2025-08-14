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
        Schema::create('prestasi_siswa', function (Blueprint $table) {
            $table->id();
            $table->string('nama_siswa', 50);
            $table->string('nama_prestasi', 150);
            $table->enum('tingkat', ['Sekolah','Kecamatan','Kabupaten','Provinsi','Nasional','Internasional']);
            $table->enum('jenis_prestasi', ['Akademik','Non Akademik']);
            $table->string('penyelenggara', 150)->nullable();
            $table->year('tahun')->nullable();
            $table->text('keterangan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('prestasi_siswa');
    }
};
