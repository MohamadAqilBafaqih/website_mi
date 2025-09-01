<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Berita;
use App\Models\GaleriKegiatan;
use App\Models\PrestasiSiswa;

class BerandaController extends Controller
{
    /**
     * Tampilkan halaman beranda utama.
     */
    public function index()
    {
        // Ambil 3 berita terbaru
        $beritaTerbaru = Berita::orderBy('created_at', 'desc')
            ->take(3)
            ->get();

        // Ambil 8 foto terbaru dari galeri
        $galeriFoto = GaleriKegiatan::orderBy('created_at', 'desc')
            ->take(8)
            ->get();

        // Ambil 6 prestasi terbaru
        $prestasiTerbaru = PrestasiSiswa::orderBy('created_at', 'desc')
            ->take(6)
            ->get();

        return view('pengguna.beranda', compact(
            'beritaTerbaru',
            'galeriFoto',
            'prestasiTerbaru'
        ));
    }
}
