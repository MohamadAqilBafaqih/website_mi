<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Testimoni extends Model
{
    use HasFactory;

    // Nama tabel (opsional, kalau tidak sesuai konvensi jamak)
    protected $table = 'testimoni';

    // Kolom yang boleh diisi (mass assignment)
    protected $fillable = [
        'nama',
        'sebagai',
        'testimoni',
        'foto',
        'status',
    ];
}
