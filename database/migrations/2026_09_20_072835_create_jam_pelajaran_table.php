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
        Schema::create('jam_pelajaran', function (Blueprint $table) {
            $table->id();
            $table->string('hari'); // Senin, Selasa, dst.
            $table->integer('jam_ke'); // Jam ke-1, 2, 3, dst.
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
        Schema::dropIfExists('jam_pelajaran');
    }
};
