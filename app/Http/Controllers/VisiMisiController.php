<?php

namespace App\Http\Controllers;

use App\Models\VisiMisi;
use Illuminate\Http\Request;

class VisiMisiController extends Controller
{
    /**
     * Tampilkan semua data visi misi
     */
    public function index()
    {
        $data = VisiMisi::latest()->get();
        return view('admin.visimisi', compact('data')); // View: resources/views/admin/visimisi.blade.php
    }

    /**
     * Simpan data visi misi baru
     */
    public function store(Request $request)
    {
        $request->validate([
            'visi' => 'required|string',
            'misi' => 'required|string',
        ]);

        VisiMisi::create([
            'visi' => $request->visi,
            'misi' => $request->misi,
        ]);

        return redirect()->route('admin.visimisi.index')->with('success', 'Visi & Misi berhasil ditambahkan.');
    }

    /**
     * Update data visi misi
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'visi' => 'required|string',
            'misi' => 'required|string',
        ]);

        $item = VisiMisi::findOrFail($id);
        $item->update([
            'visi' => $request->visi,
            'misi' => $request->misi,
        ]);

        return redirect()->route('admin.visimisi.index')->with('success', 'Visi & Misi berhasil diperbarui.');
    }

    /**
     * Hapus data visi misi
     */
    public function destroy($id)
    {
        $item = VisiMisi::findOrFail($id);
        $item->delete();

        return redirect()->route('admin.visimisi.index')->with('success', 'Visi & Misi berhasil dihapus.');
    }
}
