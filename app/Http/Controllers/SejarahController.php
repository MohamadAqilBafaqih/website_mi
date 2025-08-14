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
        return view('sejarah.index', compact('data'));
    }

    /**
     * Form tambah sejarah
     */
    public function create()
    {
        return view('sejarah.create');
    }

    /**
     * Simpan data sejarah baru
     */
    public function store(Request $request)
    {
        $request->validate([
            'isi_sejarah' => 'required|string',
        ]);

        Sejarah::create($request->all());

        return redirect()->route('sejarah.index')->with('success', 'Data sejarah berhasil ditambahkan.');
    }

    /**
     * Form edit sejarah
     */
    public function edit($id)
    {
        $item = Sejarah::findOrFail($id);
        return view('sejarah.edit', compact('item'));
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
        $item->update($request->all());

        return redirect()->route('sejarah.index')->with('success', 'Data sejarah berhasil diperbarui.');
    }

    /**
     * Hapus data sejarah
     */
    public function destroy($id)
    {
        $item = Sejarah::findOrFail($id);
        $item->delete();

        return redirect()->route('sejarah.index')->with('success', 'Data sejarah berhasil dihapus.');
    }
}
