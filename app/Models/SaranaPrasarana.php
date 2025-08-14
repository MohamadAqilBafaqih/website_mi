<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SaranaPrasarana extends Model
{
    use HasFactory;

    protected $table = 'sarana_prasarana';
    protected $fillable = [
        'nama_fasilitas',
        'jenis_fasilitas',
        'deskripsi',
        'kondisi',
        'foto',
        'tahun_pengadaan'
    ];
}
