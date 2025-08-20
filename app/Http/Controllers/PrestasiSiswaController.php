<?php

namespace App\Http\Controllers;

use App\Models\PrestasiSiswa;
use Illuminate\Http\Request;

class PrestasiSiswaController extends Controller
{
    /**
     * Tampilkan semua prestasi siswa
     */
    public function index()
    {
        $data = PrestasiSiswa::latest()->get();
        return view('admin.prestasisiswa', compact('data'));
        // View: resources/views/admin/prestasisiswa.blade.php
    }

    /**
     * Simpan prestasi siswa baru
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_siswa' => 'required|string|max:150',
            'nama_prestasi' => 'required|string|max:150',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:10240',
            'tingkat' => 'nullable|string|max:100',
            'jenis_prestasi' => 'nullable|string|max:100',
            'penyelenggara' => 'nullable|string|max:150',
            'tahun' => 'nullable|integer',
            'keterangan' => 'nullable|string',
        ]);

        $data = $request->all();

        if ($request->hasFile('foto')) {
            $fileName = time() . '.' . $request->foto->extension();
            $request->foto->move(public_path('uploads/prestasisiswa'), $fileName);
            $data['foto'] = $fileName;
        }

        PrestasiSiswa::create($data);

        return redirect()->route('admin.prestasisiswa.index')
            ->with('success', 'Prestasi siswa berhasil ditambahkan.');
    }

    /**
     * Form edit prestasi siswa
     */
    public function edit($id)
    {
        $prestasi = PrestasiSiswa::findOrFail($id);
        $data = PrestasiSiswa::latest()->get(); // Untuk tabel daftar prestasi
        return view('admin.prestasisiswa', compact('prestasi', 'data'));
    }

    /**
     * Update prestasi siswa
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_siswa' => 'required|string|max:150',
            'nama_prestasi' => 'required|string|max:150',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:10240',
            'tingkat' => 'nullable|string|max:100',
            'jenis_prestasi' => 'nullable|string|max:100',
            'penyelenggara' => 'nullable|string|max:150',
            'tahun' => 'nullable|integer',
            'keterangan' => 'nullable|string',
        ]);

        $prestasi = PrestasiSiswa::findOrFail($id);
        $updateData = $request->all();

        if ($request->hasFile('foto')) {
            if ($prestasi->foto && file_exists(public_path('uploads/prestasisiswa/' . $prestasi->foto))) {
                unlink(public_path('uploads/prestasisiswa/' . $prestasi->foto));
            }
            $fileName = time() . '.' . $request->foto->extension();
            $request->foto->move(public_path('uploads/prestasisiswa'), $fileName);
            $updateData['foto'] = $fileName;
        }

        $prestasi->update($updateData);

        return redirect()->route('admin.prestasisiswa.index')
            ->with('success', 'Prestasi siswa berhasil diperbarui.');
    }

    /**
     * Hapus prestasi siswa
     */
    public function destroy($id)
    {
        $prestasi = PrestasiSiswa::findOrFail($id);

        if ($prestasi->foto && file_exists(public_path('uploads/prestasisiswa/' . $prestasi->foto))) {
            unlink(public_path('uploads/prestasisiswa/' . $prestasi->foto));
        }

        $prestasi->delete();

        return redirect()->route('admin.prestasisiswa.index')
            ->with('success', 'Prestasi siswa berhasil dihapus.');
    }
}
