<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MappingPengampu extends Model
{
    use HasFactory;
    
    protected $table = 'mapping_pengampus';

    // Tambahkan baris ini agar data dari form bisa disimpan ke database
    protected $fillable = [
        'guru_id',
        'mata_pelajaran_id',
        'kelas_id',
        'jumlah_jp',
    ];

public function guru()
{
    return $this->belongsTo(Guru::class, 'guru_id', 'id'); // Sesuaikan primary key tabel guru kamu (misal 'id' atau 'id_guru')
}

public function mataPelajaran()
{
    return $this->belongsTo(MataPelajaran::class, 'mata_pelajaran_id', 'id_mata_pelajaran');
}
public function kelas()
{
    return $this->belongsTo(Kelas::class, 'kelas_id', 'id_kelas');
}
}