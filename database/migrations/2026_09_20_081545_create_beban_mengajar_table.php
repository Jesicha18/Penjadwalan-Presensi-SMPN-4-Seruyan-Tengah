<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('beban_mengajar', function (Blueprint $table) {
            $table->id('id_beban_mengajar');
            $table->unsignedBigInteger('guru_id');
            $table->unsignedBigInteger('kelas_id');
            $table->unsignedBigInteger('mata_pelajaran_id');
            $table->unsignedTinyInteger('jam_per_minggu');
            $table->timestamps();

            // 1 guru cuma boleh punya 1 baris beban mengajar untuk kombinasi kelas+mapel yang sama
            $table->unique(['guru_id', 'kelas_id', 'mata_pelajaran_id'], 'unik_beban_mengajar');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('beban_mengajar');
    }
};