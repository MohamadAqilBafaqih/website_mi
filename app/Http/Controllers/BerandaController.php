<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Berita;
use App\Models\GaleriKegiatan;

class BerandaController extends Controller
{
    /**
     * Tampilkan halaman beranda utama.
     */
    public function index()
    {
        // Ambil 3 berita terbaru
        $beritaTerbaru = Berita::latest()->take(3)->get();

        // Ambil 8 foto terbaru
        $galeriFoto = GaleriKegiatan::latest()->take(8)->get();

        return view('pengguna.beranda', compact('beritaTerbaru', 'galeriFoto'));
    }
}
