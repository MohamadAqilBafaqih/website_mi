<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('calon_siswa', function (Blueprint $table) {
            $table->unsignedBigInteger('sesi_id')->nullable()->after('id');

            $table->foreign('sesi_id')
                ->references('id')
                ->on('sesi_pendaftaran')
                ->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::table('calon_siswa', function (Blueprint $table) {
            $table->dropForeign(['sesi_id']);
            $table->dropColumn('sesi_id');
        });
    }
};
