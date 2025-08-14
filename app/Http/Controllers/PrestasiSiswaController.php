<?php

namespace App\Http\Controllers;

use App\Models\PrestasiSiswa;
use Illuminate\Http\Request;

class PrestasiSiswaController extends Controller
{
    /**
     * Tampilkan semua data prestasi siswa
     */
    public function index()
    {
        $data = PrestasiSiswa::latest()->get();
        return view('prestasi_siswa.index', compact('data'));
    }

    /**
     * Form tambah prestasi siswa
     */
    public function create()
    {
        return view('prestasi_siswa.create');
    }

    /**
     * Simpan data prestasi siswa baru
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_siswa' => 'required|string|max:50',
            'nama_prestasi' => 'required|string|max:150',
            'tingkat' => 'required|in:Sekolah,Kecamatan,Kabupaten,Provinsi,Nasional,Internasional',
            'jenis_prestasi' => 'required|in:Akademik,Non Akademik',
            'penyelenggara' => 'nullable|string|max:150',
            'tahun' => 'nullable|digits:4|integer|min:1900|max:' . date('Y'),
            'keterangan' => 'nullable|string'
        ]);

        PrestasiSiswa::create($request->all());

        return redirect()->route('prestasi-siswa.index')->with('success', 'Prestasi siswa berhasil ditambahkan.');
    }

    /**
     * Form edit prestasi siswa
     */
    public function edit($id)
    {
        $item = PrestasiSiswa::findOrFail($id);
        return view('prestasi_siswa.edit', compact('item'));
    }

    /**
     * Update data prestasi siswa
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_siswa' => 'required|string|max:50',
            'nama_prestasi' => 'required|string|max:150',
            'tingkat' => 'required|in:Sekolah,Kecamatan,Kabupaten,Provinsi,Nasional,Internasional',
            'jenis_prestasi' => 'required|in:Akademik,Non Akademik',
            'penyelenggara' => 'nullable|string|max:150',
            'tahun' => 'nullable|digits:4|integer|min:1900|max:' . date('Y'),
            'keterangan' => 'nullable|string'
        ]);

        $item = PrestasiSiswa::findOrFail($id);
        $item->update($request->all());

        return redirect()->route('prestasi-siswa.index')->with('success', 'Prestasi siswa berhasil diperbarui.');
    }

    /**
     * Hapus data prestasi siswa
     */
    public function destroy($id)
    {
        $item = PrestasiSiswa::findOrFail($id);
        $item->delete();

        return redirect()->route('prestasi-siswa.index')->with('success', 'Prestasi siswa berhasil dihapus.');
    }
}
