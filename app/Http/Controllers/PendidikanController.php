<?php

namespace App\Http\Controllers;

use App\Models\Pendidikan;
use Illuminate\Http\Request;

class PendidikanController extends Controller
{
    /**
     * Tampilkan semua data pendidikan
     */
    public function index()
    {
        $data = Pendidikan::latest()->get();
        return view('admin.pendidikan', compact('data')); 
        // View: resources/views/admin/pendidikan/index.blade.php
    }

    /**
     * Simpan data pendidikan baru
     */
    public function store(Request $request)
    {
        $request->validate([
            'isi_pendidikan' => 'required|string',
        ]);

        Pendidikan::create([
            'isi_pendidikan' => $request->isi_pendidikan,
        ]);

        return redirect()->route('admin.pendidikan.index')
            ->with('success', 'Data pendidikan berhasil ditambahkan.');
    }

    /**
     * Update data pendidikan
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'isi_pendidikan' => 'required|string',
        ]);

        $item = Pendidikan::findOrFail($id);
        $item->update([
            'isi_pendidikan' => $request->isi_pendidikan,
        ]);

        return redirect()->route('admin.pendidikan.index')
            ->with('success', 'Data pendidikan berhasil diperbarui.');
    }

    /**
     * Hapus data pendidikan
     */
    public function destroy($id)
    {
        $item = Pendidikan::findOrFail($id);
        $item->delete();

        return redirect()->route('admin.pendidikan.index')
            ->with('success', 'Data pendidikan berhasil dihapus.');
    }
}
