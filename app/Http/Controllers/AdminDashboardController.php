<?php

namespace App\Http\Controllers;

use App\Models\CalonSiswa;
use App\Models\DataGuru;
use App\Models\PrestasiSiswa;
use App\Models\KritikSaran;
use App\Models\Testimoni;
use Illuminate\Http\Request;

class AdminDashboardController extends Controller
{
    public function index()
    {
        return view('admin.dashboard'); 
    }

    public function dashboardContent()
    {
        // Statistik umum
        $totalSiswa = CalonSiswa::where('status_pendaftaran', 'Diterima')->count();
        $totalGuru = DataGuru::count();
        $totalPrestasi = PrestasiSiswa::count();

        $jumlahLaki = CalonSiswa::where('jenis_kelamin', 'Laki-laki')->count();
        $jumlahPerempuan = CalonSiswa::where('jenis_kelamin', 'Perempuan')->count();
        $totalPendaftar = $jumlahLaki + $jumlahPerempuan;

        $persenLaki = $totalPendaftar ? round(($jumlahLaki / $totalPendaftar) * 100) : 0;
        $persenPerempuan = $totalPendaftar ? round(($jumlahPerempuan / $totalPendaftar) * 100) : 0;
        $persenDiterima = $totalPendaftar ? round(($totalSiswa / $totalPendaftar) * 100) : 0;

        // Ambil 5 aktivitas terbaru
        $pendaftaran = CalonSiswa::latest()->take(5)->get();
        $kritikSaran = KritikSaran::latest()->take(5)->get();
        $testimoni = testimoni::latest()->take(5)->get();

        // Gabungkan semua aktivitas
        $aktivitas = collect();

        foreach ($pendaftaran as $p) {
            $aktivitas->push([
                'type' => 'pendaftaran',
                'judul' => 'Pendaftaran Baru',
                'pesan' => $p->nama . ' mendaftar sebagai siswa baru',
                'waktu' => $p->created_at
            ]);
        }

        foreach ($kritikSaran as $k) {
            $aktivitas->push([
                'type' => 'kritik',
                'judul' => 'Kritik & Saran',
                'pesan' => $k->nama . ' mengirim masukan',
                'waktu' => $k->created_at
            ]);
        }

        foreach ($testimoni as $t) {
            $aktivitas->push([
                'type' => 'testimoni',
                'judul' => 'Testimoni',
                'pesan' => $t->nama . ' memberikan testimoni',
                'waktu' => $t->created_at
            ]);
        }

        // Urutkan berdasarkan waktu terbaru dan ambil 5 aktivitas terbaru
        $aktivitas = $aktivitas->sortByDesc('waktu')->take(5);

        return view('admin.dashboard-content', compact(
            'totalSiswa',
            'totalGuru',
            'totalPrestasi',
            'jumlahLaki',
            'jumlahPerempuan',
            'persenLaki',
            'persenPerempuan',
            'persenDiterima',
            'aktivitas'
        ));
    }
}
