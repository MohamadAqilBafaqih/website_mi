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
            $table->string('nik', 20);
            $table->enum('jenis_kelamin', ['Laki-laki', 'Perempuan']);
            $table->string('tempat_lahir', 50);
            $table->date('tanggal_lahir');
            $table->text('alamat');
            $table->string('kelurahan', 50);
            $table->string('kecamatan', 50);
            $table->string('kabupaten', 50);
            $table->string('provinsi', 50);
            $table->string('kode_pos', 10);
            $table->string('no_hp', 20);
            $table->string('email', 100);
            $table->string('asal_sekolah', 100);
            $table->year('tahun_lulus');

            // Data Ayah
            $table->string('nama_ayah', 100);
            $table->string('pekerjaan_ayah', 50);
            $table->string('pendidikan_ayah', 50);
            $table->string('penghasilan_ayah', 50);

            // Data Ibu
            $table->string('nama_ibu', 100);
            $table->string('pekerjaan_ibu', 50);
            $table->string('pendidikan_ibu', 50);
            $table->string('penghasilan_ibu', 50);

            // Upload file (wajib diisi)
            $table->string('akta_kelahiran', 255);
            $table->string('kartu_keluarga', 255);
            $table->string('foto_siswa', 255);

            // Data KIP (opsional)
            $table->string('no_kip', 50)->nullable();
            $table->string('foto_kip', 255)->nullable();

            // Status pendaftaran
            $table->enum('status_pendaftaran', ['Baru', 'Diterima', 'Ditolak'])->default('Baru');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('calon_siswa');
    }
};
