<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Guru extends Model
{
    use HasFactory;

    protected $table = 'gurus';
    protected $primaryKey = 'id'; 

    protected $fillable = [
        'user_id',
        'nip',
        'nama',
        'status_kepegawaian',
        'status_sertifikasi', // <-- Pastikan ini ada
        'jabatan_struktural',
    ];

    // Relasi ke User (Akun login guru)
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id_user');
    }

    // Relasi ke Kelas (Seorang guru bisa menjadi wali kelas di suatu kelas)
    public function kelas()
    {
        // Sesuaikan 'wali_kelas_id' karena di tabel kelas kolomnya bernama itu
        return $this->hasOne(Kelas::class, 'wali_kelas_id', 'id');
    }
}