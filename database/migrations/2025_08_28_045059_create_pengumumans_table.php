<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Jalankan migrasi.
     */
    public function up(): void
    {
        Schema::create('pengumumans', function (Blueprint $table) {
            $table->id();
            $table->text('running_teks');      // Teks berjalan
            $table->string('foto_slide1')->nullable(); // Foto slide 1
            $table->string('foto_slide2')->nullable(); // Foto slide 2
            $table->string('foto_slide3')->nullable(); // Foto slide 3
            $table->timestamps();
        });
    }


    /**
     * Balikkan migrasi.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengumumans');
    }
};
