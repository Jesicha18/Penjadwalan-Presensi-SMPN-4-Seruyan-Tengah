<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    use HasFactory;

    protected $table = 'siswa';
    
    protected $guarded = ['id']; 
    
    protected $fillable = [
        'nis',
        'nisn',
        'nama',
        'jenis_kelamin',
        'kelas_id', 
        'status',   
    ];

    // Relasi ke model Kelas (Setiap siswa milik satu kelas)
    public function kelas()
    {
        return $this->belongsTo(Kelas::class, 'kelas_id', 'id_kelas');
    }
}