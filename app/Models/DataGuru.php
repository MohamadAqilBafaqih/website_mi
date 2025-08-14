<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataGuru extends Model
{
    use HasFactory;

    protected $table = 'data_guru'; // Nama tabel
    protected $fillable = [
        'nama_lengkap',
        'jenis_kelamin',
        'jabatan',
        'mata_pelajaran',
        'pendidikan_terakhir',
        'foto',
        'email',
        'no_hp',
        'status'
    ];
}
