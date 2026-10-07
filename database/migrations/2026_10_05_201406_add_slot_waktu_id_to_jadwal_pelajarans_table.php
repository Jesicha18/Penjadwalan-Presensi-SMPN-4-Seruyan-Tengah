<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('jadwal_pelajarans', function (Blueprint $table) {
            $table->unsignedBigInteger('slot_waktu_id')->nullable()->after('mata_pelajaran_id');
            // Jika mau langsung di-relasikan ke tabel slot_waktus:
            // $table->foreign('slot_waktu_id')->references('id')->on('slot_waktus')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::table('jadwal_pelajarans', function (Blueprint $table) {
            $table->dropColumn('slot_waktu_id');
        });
    }
};
