<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('gurus', function (Blueprint $table) {
            $table->string('status_kepegawaian')->nullable()->after('nama'); // Contoh: Sertifikasi, Honorer, dll
            $table->string('jabatan_struktural')->nullable()->after('status_kepegawaian'); // Contoh: Tidak Ada, Wakasek Kurikulum, dll
        });
    }

    public function down(): void
    {
        Schema::table('gurus', function (Blueprint $table) {
            $table->dropColumn(['status_kepegawaian', 'jabatan_struktural']);
        });
    }
};
