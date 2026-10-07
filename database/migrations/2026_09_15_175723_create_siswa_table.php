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
        Schema::create('siswa', function (Blueprint $table) {
            $table->id();
            $table->string('nis')->unique();
            $table->string('nama');
            
            // Ubah bagian ini agar terhubung ke tabel kelas dan aktifkan cascade
            $table->unsignedBigInteger('kelas_id')->nullable();
            
            // Hubungkan foreign key dengan onDelete('cascade')
            $table->foreign('kelas_id')
                  ->references('id_kelas') // Sesuaikan dengan primary key di tabel kelas kamu (bisa 'id' atau 'id_kelas')
                  ->on('kelas')
                  ->onDelete('cascade');

            $table->enum('jenis_kelamin', ['L', 'P']);
            $table->string('status')->default('Aktif');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('siswa');
    }
};
