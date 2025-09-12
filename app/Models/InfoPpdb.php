<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InfoPpdb extends Model
{
    use HasFactory;

    // Tabel yang digunakan
    protected $table = 'infoppdb';

    // Kolom yang bisa diisi
    protected $fillable = [
        'jadwal',
        'syarat',
        'biaya',
        'link',
        'kalender_akademik',
        'brosur',
    ];
}
