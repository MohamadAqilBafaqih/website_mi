<?php

namespace App\Http\Controllers;

use App\Models\GaleriKegiatan;
use Illuminate\Http\Request;

class GaleriKegiatanController extends Controller
{
    /**
     * Tampilkan semua galeri kegiatan
     */
    public function index()
    {
        $data = GaleriKegiatan::latest()->get();
        return view('admin.galerikegiatan', compact('data'));
        // View: resources/views/admin/galeri_kegiatan.blade.php
    }

    /**
     * Simpan galeri kegiatan baru
     */
    public function store(Request $request)
    {
        $request->validate([
            'judul_kegiatan' => 'required|string|max:150',
            'deskripsi' => 'nullable|string',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:10240',
            'tanggal' => 'nullable|date',
        ]);

        $data = $request->all();

        if ($request->hasFile('foto')) {
            $fileName = time() . '.' . $request->foto->extension();
            $request->foto->move(public_path('uploads/galeri_kegiatan'), $fileName);
            $data['foto'] = $fileName;
        }

        GaleriKegiatan::create($data);

        return redirect()->route('admin.galerikegiatan.index')
            ->with('success', 'Galeri kegiatan berhasil ditambahkan.');
    }

    /**
     * Edit galeri kegiatan
     */
    public function edit($id)
    {
        $galeri = GaleriKegiatan::findOrFail($id);
        $data = GaleriKegiatan::latest()->get(); // Untuk daftar di tabel
        return view('admin.galerikegiatan', compact('galeri', 'data'));
    }

    /**
     * Update galeri kegiatan
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'judul_kegiatan' => 'required|string|max:150',
            'deskripsi' => 'nullable|string',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:10240',
            'tanggal' => 'nullable|date',
        ]);

        $galeri = GaleriKegiatan::findOrFail($id);
        $updateData = $request->all();

        if ($request->hasFile('foto')) {
            if ($galeri->foto && file_exists(public_path('uploads/galeri_kegiatan/' . $galeri->foto))) {
                unlink(public_path('uploads/galeri_kegiatan/' . $galeri->foto));
            }
            $fileName = time() . '.' . $request->foto->extension();
            $request->foto->move(public_path('uploads/galeri_kegiatan'), $fileName);
            $updateData['foto'] = $fileName;
        }

        $galeri->update($updateData);

        return redirect()->route('admin.galerikegiatan.index')
            ->with('success', 'Galeri kegiatan berhasil diperbarui.');
    }

    /**
     * Hapus galeri kegiatan
     */
    public function destroy($id)
    {
        $galeri = GaleriKegiatan::findOrFail($id);

        if ($galeri->foto && file_exists(public_path('uploads/galeri_kegiatan/' . $galeri->foto))) {
            unlink(public_path('uploads/galeri_kegiatan/' . $galeri->foto));
        }

        $galeri->delete();

        return redirect()->route('admin.galerikegiatan.index')
            ->with('success', 'Galeri kegiatan berhasil dihapus.');
    }

    /**
     * Tampilkan semua galeri kegiatan di halaman frontend (pengguna)
     */
    public function showAll()
    {
        $galeri = GaleriKegiatan::latest()->paginate(9); // tampilkan 9 per halaman
        return view('pengguna.galeri.index', compact('galeri'));
        // View: resources/views/pengguna/galeri/index.blade.php
    }

    /**
     * Tampilkan detail galeri kegiatan
     */
    public function show($id)
    {
        $galeri = GaleriKegiatan::findOrFail($id);
        return view('pengguna.galeri.detail', compact('galeri'));
        // View: resources/views/pengguna/galeri/detail.blade.php
    }
}
