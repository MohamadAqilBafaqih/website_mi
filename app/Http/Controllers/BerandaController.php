<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Berita;
use App\Models\GaleriKegiatan;
use App\Models\PrestasiSiswa;
use App\Models\Pengumuman;
use App\Models\Sambutan;
use App\Models\Testimoni;
use App\Models\InfoPpdb;

class BerandaController extends Controller
{
    /**
     * Tampilkan halaman beranda utama.
     */
    public function index()
    {
        // Ambil 3 berita terbaru
        $beritaTerbaru = Berita::orderBy('created_at', 'desc')->take(3)->get();

        // Ambil 8 foto terbaru dari galeri
        $galeriFoto = GaleriKegiatan::orderBy('created_at', 'desc')->take(8)->get();

        // Ambil 6 prestasi terbaru
        $prestasiTerbaru = PrestasiSiswa::orderBy('created_at', 'desc')->take(6)->get();

        // Ambil pengumuman terbaru (hero banner)
        $pengumuman = Pengumuman::orderBy('created_at', 'desc')->first();

        // Ambil sambutan kepala sekolah terbaru
        $kepalaSekolah = Sambutan::orderBy('created_at', 'desc')->first();

        $testimoni = Testimoni::where('status', 'diterima')->latest()->take(6)->get();
        $data = InfoPpdb::latest()->get();

        return view('pengguna.beranda', compact(
            'beritaTerbaru',
            'galeriFoto',
            'prestasiTerbaru',
            'pengumuman',
            'kepalaSekolah',
            'testimoni',
            'data'
        ));
    }
}
