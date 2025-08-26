<?php

namespace App\Http\Controllers;

use App\Models\SaranaPrasarana;
use Illuminate\Http\Request;

class SaranaPrasaranaController extends Controller
{
    /**
     * Tampilkan semua sarana & prasarana
     */
    public function index()
    {
        $data = SaranaPrasarana::latest()->get();
        return view('admin.saranaprasarana', compact('data'));
        // View: resources/views/admin/sarana_prasarana.blade.php
    }

    /**
     * Simpan sarana/prasarana baru
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_fasilitas' => 'required|string|max:150',
            'jenis_fasilitas' => 'nullable|string|max:100',
            'deskripsi' => 'nullable|string',
            'kondisi' => 'nullable|string|max:50',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:10240',
            'tahun_pengadaan' => 'nullable|date_format:Y',
        ]);

        $data = $request->all();

        if ($request->hasFile('foto')) {
            $fileName = time() . '.' . $request->foto->extension();
            $request->foto->move(public_path('uploads/sarana_prasarana'), $fileName);
            $data['foto'] = $fileName;
        }

        SaranaPrasarana::create($data);

        return redirect()->route('admin.saranaprasarana.index')
            ->with('success', 'Sarana & prasarana berhasil ditambahkan.');
    }

    /**
     * Form edit sarana/prasarana
     */
    public function edit($id)
    {
        $sarana = SaranaPrasarana::findOrFail($id);
        $data = SaranaPrasarana::latest()->get(); // untuk daftar di tabel
        return view('admin.saranaprasarana', compact('sarana', 'data'));
    }

    /**
     * Update sarana/prasarana
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_fasilitas' => 'required|string|max:150',
            'jenis_fasilitas' => 'nullable|string|max:100',
            'deskripsi' => 'nullable|string',
            'kondisi' => 'nullable|string|max:50',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:10240',
            'tahun_pengadaan' => 'nullable|date_format:Y',
        ]);

        $sarana = SaranaPrasarana::findOrFail($id);
        $updateData = $request->all();

        if ($request->hasFile('foto')) {
            if ($sarana->foto && file_exists(public_path('uploads/sarana_prasarana/' . $sarana->foto))) {
                unlink(public_path('uploads/saranaprasarana/' . $sarana->foto));
            }
            $fileName = time() . '.' . $request->foto->extension();
            $request->foto->move(public_path('uploads/sarana_prasarana'), $fileName);
            $updateData['foto'] = $fileName;
        }

        $sarana->update($updateData);

        return redirect()->route('admin.saranaprasarana.index')
            ->with('success', 'Sarana & prasarana berhasil diperbarui.');
    }

    /**
     * Hapus sarana/prasarana
     */
    public function destroy($id)
    {
        $sarana = SaranaPrasarana::findOrFail($id);

        if ($sarana->foto && file_exists(public_path('uploads/sarana_prasarana/' . $sarana->foto))) {
            unlink(public_path('uploads/sarana_prasarana/' . $sarana->foto));
        }

        $sarana->delete();

        return redirect()->route('admin.saranaprasarana.index')
            ->with('success', 'Sarana & prasarana berhasil dihapus.');
    }

    /**
     * Tampilkan data sarana & prasarana untuk pengguna (frontend)
     */
    public function showSaranaPrasarana()
    {
        $data = SaranaPrasarana::latest()->get();
        // View: resources/views/pengguna/profil/sarana-prasarana.blade.php
        return view('pengguna.profil.saranaprasarana', compact('data'));
    }
}
