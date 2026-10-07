<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MataPelajaran extends Model
{
    use HasFactory;

    protected $table = 'mata_pelajaran';
    protected $primaryKey = 'id_mata_pelajaran';
    

    protected $fillable = [
        'kode_mapel',
        'nama_mapel',
        'prioritas_jam_pagi',
    ];
}