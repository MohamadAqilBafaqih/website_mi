<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('calon_siswa', function (Blueprint $table) {
            $table->id();
            $table->string('nama_lengkap', 100);
            $table->string('nisn', 20)->nullable();
            $table->string('nik', 20)->nullable();
            $table->enum('jenis_kelamin', ['Laki-laki', 'Perempuan']);
            $table->string('tempat_lahir', 50)->nullable();
            $table->date('tanggal_lahir')->nullable();
            $table->string('agama', 20)->nullable();
            $table->text('alamat')->nullable();
            $table->string('kelurahan', 50)->nullable();
            $table->string('kecamatan', 50)->nullable();
            $table->string('kabupaten', 50)->nullable();
            $table->string('provinsi', 50)->nullable();
            $table->string('kode_pos', 10)->nullable();
            $table->string('no_hp', 20)->nullable();
            $table->string('email', 100)->nullable();
            $table->string('asal_sekolah', 100)->nullable();
            $table->year('tahun_lulus')->nullable();
            $table->string('nama_ayah', 100)->nullable();
            $table->string('nik_ayah', 20)->nullable();
            $table->string('pekerjaan_ayah', 50)->nullable();
            $table->string('pendidikan_ayah', 50)->nullable();
            $table->string('nama_ibu', 100)->nullable();
            $table->string('nik_ibu', 20)->nullable();
            $table->string('pekerjaan_ibu', 50)->nullable();
            $table->string('pendidikan_ibu', 50)->nullable();
            $table->string('penghasilan_ortu', 50)->nullable();
            $table->string('akta_kelahiran', 255)->nullable(); // file path akta
            $table->string('kartu_keluarga', 255)->nullable(); // file path KK
            $table->enum('status_pendaftaran', ['Baru', 'Diterima', 'Ditolak'])->default('Baru');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('calon_siswa');
    }
};
