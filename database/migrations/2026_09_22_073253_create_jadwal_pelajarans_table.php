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
        Schema::create('jadwal_pelajarans', function (Blueprint $table) {
            $table->id();
            
            // Kolom periode untuk arsip tahun ajaran & semester
            $table->string('tahun_ajaran'); // Contoh: '2026/2027'
            $table->enum('semester', ['Ganjil', 'Genap']);
            
            // Foreign keys
            $table->unsignedBigInteger('guru_id');
            $table->foreign('guru_id')->references('id')->on('gurus')->onDelete('cascade');
            
            $table->unsignedBigInteger('kelas_id');
            $table->foreign('kelas_id')->references('id_kelas')->on('kelas')->onDelete('cascade');
            
            $table->unsignedBigInteger('mata_pelajaran_id');
            $table->foreign('mata_pelajaran_id')->references('id_mata_pelajaran')->on('mata_pelajaran')->onDelete('cascade');
            
            // Waktu sesuai ERD kamu
            $table->string('hari');
            $table->time('jam_mulai');
            $table->time('jam_selesai');
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jadwal_pelajarans');
    }
};
