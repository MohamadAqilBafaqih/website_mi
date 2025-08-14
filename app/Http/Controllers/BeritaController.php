<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use Illuminate\Http\Request;

class BeritaController extends Controller
{
    public function index()
    {
        $data = Berita::latest()->get();
        return view('admin.berita.index', compact('data'));
    }

    public function create()
    {
        return view('admin.berita.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'nullable|string|max:150',
            'isi' => 'required|string',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'penulis' => 'nullable|string|max:100',
            'tanggal' => 'nullable|date'
        ]);

        $data = $request->all();

        if ($request->hasFile('foto')) {
            $fileName = time() . '.' . $request->foto->extension();
            $request->foto->move(public_path('uploads/berita'), $fileName);
            $data['foto'] = $fileName;
        }

        Berita::create($data);

        return redirect()->route('berita.index')->with('success', 'Berita berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $data = Berita::findOrFail($id);
        return view('admin.berita.edit', compact('data'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'judul' => 'nullable|string|max:150',
            'isi' => 'required|string',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'penulis' => 'nullable|string|max:100',
            'tanggal' => 'nullable|date'
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

        return redirect()->route('berita.index')->with('success', 'Berita berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $berita = Berita::findOrFail($id);

        if ($berita->foto && file_exists(public_path('uploads/berita/' . $berita->foto))) {
            unlink(public_path('uploads/berita/' . $berita->foto));
        }

        $berita->delete();

        return redirect()->route('berita.index')->with('success', 'Berita berhasil dihapus.');
    }
}
