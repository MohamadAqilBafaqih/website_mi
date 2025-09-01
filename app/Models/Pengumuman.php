<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengumuman extends Model
{
    use HasFactory;

    // Nama tabel (opsional jika mengikuti konvensi Laravel)
    protected $table = 'pengumumans';

    // Kolom yang boleh diisi secara massal
    protected $fillable = [
        'running_teks',
        'foto_slide1',
        'foto_slide2',
        'foto_slide3',
    ];
}
