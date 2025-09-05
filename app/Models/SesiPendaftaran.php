<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SesiPendaftaran extends Model
{
    use HasFactory;

    protected $table = 'sesi_pendaftaran';

    protected $fillable = [
        'nama_sesi',
        'tahun_ajaran',
        'tanggal_mulai',
        'tanggal_selesai',
        'status',
    ];

    protected $casts = [
        'tanggal_mulai'   => 'date',
        'tanggal_selesai' => 'date',
    ];

    public static function sesiAktif()
    {
        return self::where('status', 'aktif')
            ->whereDate('tanggal_mulai', '<=', now())
            ->whereDate('tanggal_selesai', '>=', now())
            ->first();
    }

    public function calonSiswa()
    {
        return $this->hasMany(CalonSiswa::class, 'sesi_id');
    }
}
