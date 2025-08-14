<?php

namespace App\Http\Controllers;

use App\Models\GaleriKegiatan;
use Illuminate\Http\Request;

class GaleriKegiatanController extends Controller
{
    // Tampilkan semua galeri
    public function index()
    {
        $data = GaleriKegiatan::latest()->get();
        return view('admin.galeri_kegiatan.index', compact('data'));
    }

    // Form tambah
    public function create()
    {
        return view('admin.galeri_kegiatan.create');
    }

    // Simpan data baru
    public function store(Request $request)
    {
        $request->validate([
            'judul_kegiatan' => 'required|string|max:150',
            'deskripsi' => 'nullable|string',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'tanggal' => 'nullable|date'
        ]);

        $data = $request->all();

        // Upload foto jika ada
        if ($request->hasFile('foto')) {
            $fileName = time() . '.' . $request->foto->extension();
            $request->foto->move(public_path('uploads/galeri'), $fileName);
            $data['foto'] = $fileName;
        }

        GaleriKegiatan::create($data);

        return redirect()->route('galeri-kegiatan.index')->with('success', 'Data berhasil ditambahkan.');
    }

    // Form edit
    public function edit($id)
    {
        $data = GaleriKegiatan::findOrFail($id);
        return view('admin.galeri_kegiatan.edit', compact('data'));
    }

    // Update data
    public function update(Request $request, $id)
    {
        $request->validate([
            'judul_kegiatan' => 'required|string|max:150',
            'deskripsi' => 'nullable|string',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'tanggal' => 'nullable|date'
        ]);

        $data = GaleriKegiatan::findOrFail($id);
        $updateData = $request->all();

        // Jika ganti foto
        if ($request->hasFile('foto')) {
            if ($data->foto && file_exists(public_path('uploads/galeri/' . $data->foto))) {
                unlink(public_path('uploads/galeri/' . $data->foto));
            }
            $fileName = time() . '.' . $request->foto->extension();
            $request->foto->move(public_path('uploads/galeri'), $fileName);
            $updateData['foto'] = $fileName;
        }

        $data->update($updateData);

        return redirect()->route('galeri-kegiatan.index')->with('success', 'Data berhasil diperbarui.');
    }

    // Hapus data
    public function destroy($id)
    {
        $data = GaleriKegiatan::findOrFail($id);
        if ($data->foto && file_exists(public_path('uploads/galeri/' . $data->foto))) {
            unlink(public_path('uploads/galeri/' . $data->foto));
        }
        $data->delete();

        return redirect()->route('galeri-kegiatan.index')->with('success', 'Data berhasil dihapus.');
    }
}
