<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
public function up()
{
    Schema::create('alokasi_mapels', function (Blueprint $table) {
        $table->id();
        
        // Relasi ke tabel kelas (menggunakan id_kelas)
        $table->unsignedBigInteger('kelas_id');
        $table->foreign('kelas_id')->references('id_kelas')->on('kelas')->onDelete('cascade');
        
        // Relasi ke tabel mata_pelajaran (menggunakan id_mata_pelajaran)
        $table->unsignedBigInteger('mata_pelajaran_id');
        $table->foreign('mata_pelajaran_id')->references('id_mata_pelajaran')->on('mata_pelajaran')->onDelete('cascade');
        
        $table->integer('jumlah_jam');
        $table->timestamps();
    });
}
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('alokasi_mapels');
    }
};
