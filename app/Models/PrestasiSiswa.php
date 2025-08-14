<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PrestasiSiswa extends Model
{
    use HasFactory;

    protected $table = 'prestasi_siswa';
    protected $fillable = [
        'nama_siswa',
        'nama_prestasi',
        'tingkat',
        'jenis_prestasi',
        'penyelenggara',
        'tahun',
        'keterangan'
    ];
}
