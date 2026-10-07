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
        Schema::create('presensi_gurus', function (Blueprint $table) {
            // Sesuai dengan id_presensi_guru : int pada class diagram
            $table->id('id_presensi_guru');
            
            // Sesuai dengan guru_id : int pada class diagram (berelasi ke tabel gurus)
            $table->unsignedBigInteger('guru_id');
            
            // Sesuai dengan tanggal : date
            $table->date('tanggal');
            
            // Sesuai dengan status_kehadiran : varchar
            $table->string('status_kehadiran');
            
            // Sesuai dengan created_at & updated_at : timestamp
            $table->timestamps();

            // Definisi Foreign Key ke tabel gurus (kolom id)
            $table->foreign('guru_id')->references('id')->on('gurus')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('presensi_gurus');
    }
};