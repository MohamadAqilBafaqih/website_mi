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
        Schema::create('infoppdb', function (Blueprint $table) {
            $table->id();
            $table->text('jadwal');                   // informasi jadwal PPDB
            $table->text('syarat');                   // syarat pendaftaran
            $table->text('biaya');                    // rincian biaya
            $table->text('faq');                      // pertanyaan yang sering diajukan
            $table->string('kalender_akademik')->nullable(); // path file kalender akademik
            $table->string('brosur')->nullable();     // path file brosur
            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('infoppdb');
    }
};
