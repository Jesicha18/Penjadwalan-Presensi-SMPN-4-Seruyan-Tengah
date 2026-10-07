<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('mapping_pengampus', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('guru_id');
            $table->unsignedBigInteger('mata_pelajaran_id');
            $table->unsignedBigInteger('kelas_id');
            $table->integer('jumlah_jp');
            $table->timestamps();

            // Sengaja tidak pakai ->foreign(...) agar terhindar dari error errno: 150.
            // Relasi tetap akan kita atur melalui Model Laravel.
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('mapping_pengampus');
    }
};
