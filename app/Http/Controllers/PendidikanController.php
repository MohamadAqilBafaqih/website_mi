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
        return view('pendidikan.index', compact('data'));
    }

    /**
     * Form tambah pendidikan
     */
    public function create()
    {
        return view('pendidikan.create');
    }

    /**
     * Simpan data pendidikan baru
     */
    public function store(Request $request)
    {
        $request->validate([
            'isi_pendidikan' => 'required|string',
        ]);

        Pendidikan::create($request->all());

        return redirect()->route('pendidikan.index')->with('success', 'Data pendidikan berhasil ditambahkan.');
    }

    /**
     * Form edit pendidikan
     */
    public function edit($id)
    {
        $item = Pendidikan::findOrFail($id);
        return view('pendidikan.edit', compact('item'));
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
        $item->update($request->all());

        return redirect()->route('pendidikan.index')->with('success', 'Data pendidikan berhasil diperbarui.');
    }

    /**
     * Hapus data pendidikan
     */
    public function destroy($id)
    {
        $item = Pendidikan::findOrFail($id);
        $item->delete();

        return redirect()->route('pendidikan.index')->with('success', 'Data pendidikan berhasil dihapus.');
    }
}
