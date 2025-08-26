<?php

namespace App\Http\Controllers;

use App\Models\Sejarah;
use Illuminate\Http\Request;

class SejarahController extends Controller
{
    /**
     * Tampilkan semua data sejarah
     */
    public function index()
    {
        $data = Sejarah::latest()->get();
        return view('admin.sejarah', compact('data')); // View: resources/views/admin/sejarah.blade.php
    }

    /**
     * Simpan data sejarah baru
     */
    public function store(Request $request)
    {
        $request->validate([
            'isi_sejarah' => 'required|string',
        ]);

        Sejarah::create([
            'isi_sejarah' => $request->isi_sejarah,
        ]);

        return redirect()->route('admin.sejarah.index')->with('success', 'Sejarah berhasil ditambahkan.');
    }

    /**
     * Update data sejarah
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'isi_sejarah' => 'required|string',
        ]);

        $item = Sejarah::findOrFail($id);
        $item->update([
            'isi_sejarah' => $request->isi_sejarah,
        ]);

        return redirect()->route('admin.sejarah.index')->with('success', 'Sejarah berhasil diperbarui.');
    }

    /**
     * Hapus data sejarah
     */
    public function destroy($id)
    {
        $item = Sejarah::findOrFail($id);
        $item->delete();

        return redirect()->route('admin.sejarah.index')->with('success', 'Sejarah berhasil dihapus.');
    }

    /**
     * Tampilkan sejarah di halaman pengguna
     */
    public function showSejarah()
    {
        $data = Sejarah::latest()->get();
        return view('pengguna.profil.sejarah', compact('data'));
    }
}
