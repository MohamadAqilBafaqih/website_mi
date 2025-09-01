<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class KontakController extends Controller
{
    /**
     * Menampilkan halaman kontak sekolah
     */
    public function index()
    {
        $googleMapsLink = "https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3956.118033464616!2d109.24006187400383!3d-7.452191992559039!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e655c314bf69a35%3A0x3e02c1596f06a38b!2sMI%20DIPONEGORO%2003%20Karangklesem!5e0!3m2!1sid!2sid!4v1756387696090!5m2!1sid!2sid"; // ganti dengan link embed yang asli
        // Karena halaman kontak bersifat statis, cukup return view
        return view('pengguna.kontak.infosekolah', compact('googleMapsLink'));
    }
}
