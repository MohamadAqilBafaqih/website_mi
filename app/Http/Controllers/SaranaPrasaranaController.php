<?php

namespace App\Http\Controllers;

use App\Models\SaranaPrasarana;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SaranaPrasaranaController extends Controller
{
    /**
     * Tampilkan semua data sarana prasarana
     */
    public function index()
    {
        $data = SaranaPrasarana::latest()->get();
        return view('sarana_prasarana.index', compact('data'));
    }

    /**
     * Form tambah sarana prasarana
     */
    public function create()
    {
        return view('sarana_prasarana.create');
    }

    /**
     * Simpan data sarana prasarana baru
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_fasilitas' => 'required|string|max:100',
            'jenis_fasilitas' => 'required|in:Sarana,Prasarana',
            'deskripsi' => 'nullable|string',
            'kondisi' => 'required|in:Baik,Cukup,Kurang',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'tahun_pengadaan' => 'nullable|digits:4|integer|min:1900|max:' . date('Y'),
        ]);

        $data = $request->all();

        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('foto_sarana', 'public');
        }

        SaranaPrasarana::create($data);

        return redirect()->route('sarana-prasarana.index')->with('success', 'Data sarana/prasarana berhasil ditambahkan.');
    }

    /**
     * Form edit sarana prasarana
     */
    public function edit($id)
    {
        $item = SaranaPrasarana::findOrFail($id);
        return view('sarana_prasarana.edit', compact('item'));
    }

    /**
     * Update data sarana prasarana
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_fasilitas' => 'required|string|max:100',
            'jenis_fasilitas' => 'required|in:Sarana,Prasarana',
            'deskripsi' => 'nullable|string',
            'kondisi' => 'required|in:Baik,Cukup,Kurang',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'tahun_pengadaan' => 'nullable|digits:4|integer|min:1900|max:' . date('Y'),
        ]);

        $item = SaranaPrasarana::findOrFail($id);
        $data = $request->all();

        if ($request->hasFile('foto')) {
            if ($item->foto && Storage::disk('public')->exists($item->foto)) {
                Storage::disk('public')->delete($item->foto);
            }
            $data['foto'] = $request->file('foto')->store('foto_sarana', 'public');
        }

        $item->update($data);

        return redirect()->route('sarana-prasarana.index')->with('success', 'Data sarana/prasarana berhasil diperbarui.');
    }

    /**
     * Hapus data sarana prasarana
     */
    public function destroy($id)
    {
        $item = SaranaPrasarana::findOrFail($id);

        if ($item->foto && Storage::disk('public')->exists($item->foto)) {
            Storage::disk('public')->delete($item->foto);
        }

        $item->delete();

        return redirect()->route('sarana-prasarana.index')->with('success', 'Data sarana/prasarana berhasil dihapus.');
    }
}
