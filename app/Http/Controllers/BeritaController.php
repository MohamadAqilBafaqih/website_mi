<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use Illuminate\Http\Request;

class BeritaController extends Controller
{
    /**
     * Tampilkan semua berita
     */
    public function index()
    {
        $data = Berita::latest()->get();
        return view('admin.berita', compact('data'));
        // View: resources/views/admin/berita.blade.php
    }

    /**
     * Simpan berita baru
     */
    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'nullable|string|max:150',
            'isi' => 'required|string',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:10240',
            'penulis' => 'nullable|string|max:100',
            'tanggal' => 'nullable|date',
        ]);

        $data = $request->all();

        if ($request->hasFile('foto')) {
            $fileName = time() . '.' . $request->foto->extension();
            $request->foto->move(public_path('uploads/berita'), $fileName);
            $data['foto'] = $fileName;
        }

        Berita::create($data);

        return redirect()->route('admin.berita.index')
            ->with('success', 'Berita berhasil ditambahkan.');
    }

    public function edit($id)
    {
        // Ambil data berita sesuai ID
        $berita = Berita::findOrFail($id);

        // Kirim data ke view yang sama, gunakan variabel $berita untuk form edit
        $data = Berita::latest()->get(); // Untuk daftar berita di tabel bawah
        return view('admin.berita', compact('berita', 'data'));
    }


    /**
     * Update berita
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'judul' => 'nullable|string|max:150',
            'isi' => 'required|string',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'penulis' => 'nullable|string|max:100',
            'tanggal' => 'nullable|date',
        ]);

        $berita = Berita::findOrFail($id);
        $updateData = $request->all();

        if ($request->hasFile('foto')) {
            if ($berita->foto && file_exists(public_path('uploads/berita/' . $berita->foto))) {
                unlink(public_path('uploads/berita/' . $berita->foto));
            }
            $fileName = time() . '.' . $request->foto->extension();
            $request->foto->move(public_path('uploads/berita'), $fileName);
            $updateData['foto'] = $fileName;
        }

        $berita->update($updateData);

        return redirect()->route('admin.berita.index')
            ->with('success', 'Berita berhasil diperbarui.');
    }

    /**
     * Hapus berita
     */
    public function destroy($id)
    {
        $berita = Berita::findOrFail($id);

        if ($berita->foto && file_exists(public_path('uploads/berita/' . $berita->foto))) {
            unlink(public_path('uploads/berita/' . $berita->foto));
        }

        $berita->delete();

        return redirect()->route('admin.berita.index')
            ->with('success', 'Berita berhasil dihapus.');
    }


    public function showAll()
    {
        $data = Berita::latest()->paginate(6);
        return view('pengguna.berita.index', compact('data'));
        // View: resources/views/pengguna/berita/index.blade.php
    }

    public function show($id)
    {
        $berita = Berita::findOrFail($id);
        return view('pengguna.berita.detail', compact('berita'));
        // View: resources/views/pengguna/berita/detail.blade.php
    }
}
