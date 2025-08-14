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
        return view('visi_misi.index', compact('data'));
    }

    /**
     * Form tambah visi misi
     */
    public function create()
    {
        return view('visi_misi.create');
    }

    /**
     * Simpan data visi misi baru
     */
    public function store(Request $request)
    {
        $request->validate([
            'visi' => 'required|string|max:255',
            'misi' => 'required|string|max:255',
        ]);

        VisiMisi::create($request->all());

        return redirect()->route('visi-misi.index')->with('success', 'Visi & Misi berhasil ditambahkan.');
    }

    /**
     * Form edit visi misi
     */
    public function edit($id)
    {
        $item = VisiMisi::findOrFail($id);
        return view('visi_misi.edit', compact('item'));
    }

    /**
     * Update data visi misi
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'visi' => 'required|string|max:255',
            'misi' => 'required|string|max:255',
        ]);

        $item = VisiMisi::findOrFail($id);
        $item->update($request->all());

        return redirect()->route('visi-misi.index')->with('success', 'Visi & Misi berhasil diperbarui.');
    }

    /**
     * Hapus data visi misi
     */
    public function destroy($id)
    {
        $item = VisiMisi::findOrFail($id);
        $item->delete();

        return redirect()->route('visi-misi.index')->with('success', 'Visi & Misi berhasil dihapus.');
    }
}
