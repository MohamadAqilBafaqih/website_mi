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
        Schema::create('sarana_prasarana', function (Blueprint $table) {
            $table->id();
            $table->string('nama_fasilitas', 100);
            $table->enum('jenis_fasilitas', ['Sarana', 'Prasarana']);
            $table->text('deskripsi')->nullable();
            $table->enum('kondisi', ['Baik', 'Rusak_ringan', 'Rusak_berat'])->default('Baik');
            $table->string('foto')->nullable();
            $table->year('tahun_pengadaan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sarana_prasarana');
    }
};
