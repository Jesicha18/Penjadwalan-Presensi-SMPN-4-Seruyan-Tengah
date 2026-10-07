<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    use HasFactory;

    protected $table = 'kelas';
    protected $primaryKey = 'id_kelas';

    protected $fillable = [
        'wali_kelas_id',
        'nama_kelas',
        'tingkat',
        'is_active',
    ];

    // Relasi ke model Guru
    public function guru()
    {
        return $this->belongsTo(Guru::class, 'wali_kelas_id', 'id');
    }

    public function waliKelas()
    {
        return $this->guru();
    }

    // Relasi ke model Siswa
    public function siswas()
    {
        return $this->hasMany(Siswa::class, 'kelas_id', 'id_kelas');
    }

    public function siswa()
    {
        return $this->siswas();
    }
    public function jadwalPelajarans()
    {
        return $this->hasMany(JadwalPelajaran::class, 'kelas_id', 'id_kelas');
    }
}