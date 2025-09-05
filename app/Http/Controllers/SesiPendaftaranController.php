<?php

namespace App\Http\Controllers;

use App\Models\SesiPendaftaran;
use Illuminate\Http\Request;

class SesiPendaftaranController extends Controller
{
    /**
     * Tampilkan semua sesi pendaftaran.
     */
    public function index()
    {
        // Update otomatis setiap kali halaman diakses
        SesiPendaftaran::where('tanggal_selesai', '<', now())
            ->where('status', 'aktif')
            ->update(['status' => 'nonaktif']);

        $data = SesiPendaftaran::latest()->get();
        return view('admin.sesipendaftaran', compact('data'));
    }

    /**
     * Form tambah sesi baru.
     */
    public function create()
    {
        return view('admin.sesipendaftaran.create');
    }



    /**
     * Simpan sesi baru ke database.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_sesi'      => 'required|string|max:100',
            'tahun_ajaran'   => 'required|string|max:9',
            'tanggal_mulai'  => 'required|date',
            'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
            'status'         => 'required|in:aktif,nonaktif',
        ]);

        SesiPendaftaran::create($request->all());

        return redirect()->route('admin.sesipendaftaran.index')
            ->with('success', 'Sesi pendaftaran berhasil ditambahkan.');
    }

    /**
     * Form edit sesi pendaftaran.
     */
    public function edit($id)
    {
        $sesi = SesiPendaftaran::findOrFail($id);
        return view('admin.sesipendaftaran.edit', compact('sesi'));
    }

    /**
     * Update sesi pendaftaran.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_sesi'      => 'required|string|max:100',
            'tahun_ajaran'   => 'required|string|max:9',
            'tanggal_mulai'  => 'required|date',
            'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
            'status'         => 'required|in:aktif,nonaktif',
        ]);

        $sesi = SesiPendaftaran::findOrFail($id);
        $sesi->update($request->all());

        return redirect()->route('admin.sesipendaftaran.index')
            ->with('success', 'Sesi pendaftaran berhasil diperbarui.');
    }

    /**
     * Hapus sesi pendaftaran.
     */
    public function destroy($id)
    {
        $sesi = SesiPendaftaran::findOrFail($id);
        $sesi->delete();

        return redirect()->route('admin.sesipendaftaran.index')
            ->with('success', 'Sesi pendaftaran berhasil dihapus.');
    }
}
