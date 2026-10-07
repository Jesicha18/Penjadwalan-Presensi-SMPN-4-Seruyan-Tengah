<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id('id_user'); // Sesuai class diagram: id_user
            $table->string('name'); // Tambahan kolom nama lengkap
            $table->string('email')->unique(); // Sesuai class diagram: username
            $table->string('password'); // Sesuai class diagram: password
            $table->string('role'); // Sesuai class diagram: role (admin/guru/siswa)
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};