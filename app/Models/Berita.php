<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Berita extends Model
{
    use HasFactory;

    protected $table = 'berita';

    protected $fillable = [
        'judul',
        'isi',
        'foto',
        'penulis',
        'tanggal'
    ];

    protected $casts = [
        'tanggal' => 'datetime:Y-m-d', // otomatis menjadi Carbon
    ];
}
