<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('infoppdb', function (Blueprint $table) {
            $table->renameColumn('faq', 'link');
        });
    }

    public function down(): void
    {
        Schema::table('infoppdb', function (Blueprint $table) {
            $table->renameColumn('link', 'faq');
        });
    }
};
