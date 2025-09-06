<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('prestasi_siswa', function (Blueprint $table) {
            $table->string('juara')->nullable()->after('jenis_prestasi');
        });
    }

    public function down(): void
    {
        Schema::table('prestasi_siswa', function (Blueprint $table) {
            $table->dropColumn('juara');
        });
    }
};
